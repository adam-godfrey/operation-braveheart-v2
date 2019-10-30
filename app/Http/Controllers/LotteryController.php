<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryDraw;
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotterySetting;
use App\Models\Admin\LotteryPlayer;
use App\Models\Admin\LotteryPayment;
use App\Rules\Telephone;
use DB;

class LotteryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        $lotteryDraw = LotteryDraw::where('active', 1)->get();

        $draw_date = LotterySetting::select('value')
                ->where('key', 'draw_date')
                ->first()
                ->value;

        foreach(['UK', 'Local'] as $draw_type) {
            $lotterySettings = LotterySetting::where('key', 'like', $draw_type . '%')
                ->get();

            $prizes = $lotterySettings->filter(function($item) {
                return substr($item->key, -5) === 'prize' && $item->value != null;
            }); 

            $winners = $lotterySettings->filter(function($item) {
                return substr($item->key, -7) === 'winners';
            })->first();

            $i = 0;
            foreach($prizes->take($winners->value) as $prize) {
                $i++;

                $locale = 'en_GB';
                $nf = new \NumberFormatter($locale, \NumberFormatter::ORDINAL);

                preg_match('~_(.*?)_~', $prize->key, $output);

                $winning_number = LotteryDraw::where('draw_date', $draw_date)
                    ->where('draw_type', $draw_type)
                    ->where('active', 1)
                    ->first()->{$output[1]};

                $player = LotteryPlayer::where('lottery_number', $winning_number)
                    ->where('draw_type', $draw_type)
                    ->first();

                $result[$draw_type][$output[1]] = (object) [
                    'winner' => ucwords(strtolower($player->name)),
                    'prize' => $prize->value,
                    'number' => $winning_number,
                    'image' => $nf->format($i)
                ];
            }
        }

        $data =  [
            'page' => (object) [
                'title' => 'Lottery',
                'description' => 'Have you won this month\'s lottery?'
            ],
            'lottery' => (object) $result
        ];

        return View('lottery.index')->with($data);
    }

    public function join()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Lottery',
                'description' => 'Have you won this month\'s lottery?'
            ],
        ];

        return View('lottery.join')->with($data);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|string',
            'email' => 'required|email',
            'telephone' => ['sometimes', new Telephone],
            'lotteries' => 'required'
        ]);

        DB::beginTransaction();
        try {
            foreach($request->input('lotteries') as $draw_type) {
                $lotteryPlayer = new LotteryPlayer();

                $lotteryPlayer->name = $request->input('contact');
                $lotteryPlayer->email = $request->input('email');
                $lotteryPlayer->telephone = $request->input('telephone');
                $lotteryPlayer->draw_type = $draw_type;

                $lotteryPlayer->save();

                $lotteryBall = LotteryBall::where('draw_type', $draw_type)
                    ->whereNull('player_id')
                    ->first();

                // we've run out of available numbers
                if(is_null($lotteryBall)) {

                    $getNextNumber = LotteryBall::where('draw_type', $draw_type)
                                        ->orderBy('lottery_number', 'desc')
                                        ->first()
                                        ->lottery_number + 1;

                    $lotteryBall = new LotteryBall();

                    $lotteryBall->lottery_number = $getNextNumber;
                    $lotteryBall->draw_type = $draw_type;
                    $lotteryBall->player_id = $lotteryPlayer->id;

                    $lotteryBall->save();

                    $lotterySettings = LotterySetting::where('key', strtolower($draw_type) . '_ball_count')
                        ->update(['value' => DB::raw('value+1')]);

                } else {
                    $getNextNumber = $lotteryBall->lottery_number; 
                    $lotteryBall->update(['player_id' => $lotteryPlayer->id]);
                }

                $lotteryPlayer->lottery_number = $getNextNumber;

                $lotteryPlayer->save();

                $lotteryPayment = new LotteryPayment();

                $lotteryPaymnent->player_id = $lotteryPlayer->id;
                $lotteryPaymnent->paid = 0

                $lotteryPayment->save();

                event(new SendLotteryRegistrationConfirmation($lotteryPlayer));

                event(new SendLotteryRegistrationConfirmationAdmin($lotteryPlayer));
            }
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return response()->json(['customer' => $lotteryPlayer->id], 200);
    }
}
