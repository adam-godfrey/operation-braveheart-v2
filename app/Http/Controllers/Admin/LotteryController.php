<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotterySetting;
use App\Models\Admin\LotteryDraw;
use App\Models\Admin\LotteryPlayer;
use App\Http\Traits\LotteryTrait;
use DateTime;
use Image;

class LotteryController extends Controller
{
    use LotteryTrait;

    public function index()
    {
        $lotterySetting = LotterySetting::all();

        $data = [];

        foreach($lotterySetting as $setting) {
            $data[$setting->key] = $setting->value;
        }

        return View('admin.lottery.index')->with(['settings' => $data]);
    }

    public function settings()
    {
        $lotterySetting = LotterySetting::all();

        $data = [];

        foreach($lotterySetting as $setting) {
            $data[$setting->key] = $setting->value;
        }

        return View('admin.lottery.settings')->with(['settings' => $data]);
    }

    public function draw($draw)
    {
        $uk = [
            'draw_type' => 'UK',
            'color' => 'blue',
        ];

        $local = [
            'draw_type' => 'Local',
            'color' => 'green'
        ];

        $data = ${$draw};

        $draw_date = LotterySetting::select('value')
                ->where('key', 'draw_date')
                ->first()
                ->value;

        $data['draw_date'] = (new DateTime($draw_date))->format('d M Y');

        $lotterySettings = LotterySetting::where('key', 'like', strtolower($draw) . '%')
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
                ->where('draw_type', $draw)
                ->where('active', 1)
                ->first()->{$output[1]};

            $data['settings'][] = (object) [
                'prize' => $output[1],
                'abbr' =>  $nf->format($i) . ' Prize',
                'value' => $prize->value,
                'number' => $winning_number
            ];

            $color = ($draw == 'uk') ? 'blue' : 'green';

            $img = Image::make(\Storage::get('ball-' . $color . '.jpg'));  
            $img->text($winning_number, 137, 141, function($font) {  
                $font->file(public_path('fonts/open-sans.bold.ttf'));  
                $font->size(50);  
                $font->color('#212529');  
                $font->align('center');  
                $font->valign('center');  
            });  
            $img->save(public_path('images/ball-' . $color . '-' .  $nf->format($i) . '.jpg')); 

            $player = LotteryPlayer::where('lottery_number', $winning_number)
                ->first();

            $data['winners'][$output[1]] = (object) [
                'name' => !is_null($player) ? $player->name : '',
                'telephone' => !is_null($player) ? $player->telephone: ''
            ];
        }

        return View('admin.lottery.draw')->with($data);
    }

    public function additionalNumbers(Request $request)
    {
        $key = strtolower($request->input('type')) . '_ball_count';
        $draw_type = $request->input('type'); 

        $lotterySetting = LotterySetting::where('key', $key)
            ->update(['value' => $request->input('new_total')]);

        for($i = 0; $i < $request->input('extra_balls'); $i++) {
            $getNextNumber = LotteryBall::where('draw_type', $draw_type)
                                ->orderBy('lottery_number', 'desc')
                                ->first()
                                ->lottery_number + 1;

            $lotteryBall = new LotteryBall();

            $lotteryBall->lottery_number = $getNextNumber;
            $lotteryBall->draw_type = $draw_type;

            $lotteryBall->save();
        }

        return response()->json($lotterySetting, 200);
    }

    public function totalWinners(Request $request)
    {
        $lotterySetting = LotterySetting::where('key', 'uk_winners')
            ->update(['value' => $request->input('uk_total')]);

        $lotterySetting = LotterySetting::where('key', 'local_winners')
            ->update(['value' => $request->input('local_total')]);

        return response()->json($lotterySetting, 200);
    }

    public function updateDrawDate(Request $request)
    {
        $lotteryDraw = LotteryDraw::where('active', 1)
            ->update(['active' => 0]);

        LotteryDraw::insert([ 
            [
                'draw_date' => $request->input('draw_date'),
                'draw_type' => 'UK',
                'active' => 1
            ],
            [
                'draw_date' => $request->input('draw_date'),
                'draw_type' => 'Local',
                'active' => 1
            ]
        ]);

        $lotterySetting = LotterySetting::where('key', 'draw_date')
            ->update(['value' => $request->input('draw_date')]);

        return response()->json($lotterySetting, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'results.*.winner'  => 'required|gt:0',
        ],
        [
            'results.*.winner.required' => 'This field is required',
        ]);

        $draw_date = DateTime::createFromFormat('d M Y', $request->input('draw_date'));
        $draw_date = $draw_date->format('Y-m-d');

        $lotteryDraw = LotteryDraw::where('draw_date', $draw_date)
            ->where('draw_type', $request->input('draw_type'))
            ->where('active', 1)
            ->first();

        foreach($request->input('results') as $result) {
            $lotteryDraw->{$result['prize']} = $result['winner'];
        }

        $lotteryDraw->save();
    }

    public function updatePrizes(Request $request) 
    {
        $this->validate($request, [
            'uk_first_prize' => 'required|gt:0',
            'uk_second_prize' => 'required|gt:0',
            'uk_third_prize' => 'required|gt:0',
            'uk_fourth_prize' => 'sometimes|nullable|gt:0',
            'local_first_prize' => 'required|gt:0',
            'local_second_prize' => 'required|gt:0',
            'local_third_prize' => 'required|gt:0',
            'local_fourth_prize' => 'sometimes|nullable|gt:0',
        ]);

        $lotterySetting = LotterySetting::all();

        foreach($request->all() as $key => $prize) {
            $lotterySetting = LotterySetting::where('key', $key)
                ->update(['value' => $prize]);
        }

        return response()->json([], 200);
    }
}
