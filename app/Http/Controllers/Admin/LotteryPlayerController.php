<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryPlayer;
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotterySetting;
use App\Models\Admin\LotteryPayment;
use App\Models\Admin\LotteryDraw;
use App\Http\Traits\LotteryTrait;
use App\Rules\Telephone;

class LotteryPlayerController extends Controller
{
    use LotteryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = LotteryPlayer::orderBy('created_at', 'desc')->get();

        $data = [
            'players' => $players
        ];

        return View('admin.lottery.players.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  [
            
        ];

        return View('admin.lottery.players.add')->with($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'sometimes|email',
            'telephone' => ['sometimes', 'nullable', new Telephone],
            'lottery_number' => 'required|gt:0',
            'draw_type' => 'required',
        ],
            [ 'lottery_number.gt' => 'The :attribute is empty.'
        ]);

        $lotteryPlayer = new LotteryPlayer();

        $lotteryPlayer->name = $request->name;
        $lotteryPlayer->email = $request->email;
        $lotteryPlayer->telephone = $request->telephone;
        $lotteryPlayer->draw_type = $request->draw_type;

        $lotteryPlayer->save();

        $lotteryBall = LotteryBall::where('lottery_number', $request->lottery_number)
            ->where('draw_type', $request->draw_type)
            ->first();

        $lotteryBall->player_id = $lotteryPlayer->id;

        $lotteryBall->save();

        $lotteryPayment = new LotteryPayment();

        $lotteryPaymnent->player_id = $lotteryPlayer->id;
        $lotteryPaymnent->paid = 0;

        $lotteryPayment->save();

        return response()->json($request->all(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = LotteryPlayer::where('id', $id)->first();

        $data =  [
            'player' => $player
        ];

        return View('admin.lottery.players.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'sometimes|nullable|email',
            'telephone' => ['sometimes', 'nullable', new Telephone],
            'lottery_number' => 'required',
            'draw_type' => 'required',
        ]);

        $lotteryPlayer = LotteryPlayer::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'draw_type' => $request->draw_type,
            ]);

        $lotteryBall = LotteryBall::where('player_id', $id)
            ->update(['player_id' => null]);

        $lotteryBall = LotteryBall::where('lottery_number', $request->lottery_number)
            ->where('draw_type', $request->draw_type)
            ->first();

        $lotteryBall->player_id = $id;
        $lotteryBall->save();

        return response()->json($request->all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPlayers(Request $request)
    {
        if ( $request->input('showdata') ) {
            return LotteryPlayer::orderBy('created_at', 'desc')->get();
            
        }
        $columns = ['name', 'email', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); 
        $search_input = $request->input('search');
        $query = LotteryPlayer::select('name', 'email', 'created_at'); //->orderBy($columns[$column]);

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('name', 'like', '%' . $search_input . '%')
                ->orWhere('email', 'like', '%' . $search_input . '%')
                ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }

        $query->orderBy('lottery_number', 'asc')
            ->orderBy('draw_type', 'asc');

        $users = $query->paginate($length);

        return ['data' => $users];
    }

    public function deletePlayer(LotteryPlayer $player) {
        if($player) {
            $player->delete();
        }
        return 'user deleted';
    }

    public function getPaidPlayers(Request $request)
    {
        if ( $request->input('showdata') ) {

            $draw_date = $request->input('draw_date');

            $lotteryPlayers = LotteryPlayer::join('lottery-payments', 'lottery-players.id' , '=', 'lottery-payments.player_id')
                ->where('lottery-payments.draw_date', $draw_date)
                ->where('lottery-players.active', true)
                ->get();

            $lotteryPlayers->each(function ($item, $key) {
                $item->paid = $item->paid == 1 ? true : false;
            });

            return $lotteryPlayers;            
        }

        $columns = ['name', 'email', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); 
        $search_input = $request->input('search');

        $query = LotteryPlayer::join('lottery-payments', 'lottery-players.id' , '=', 'lottery-payments.player_id')
                ->where('lottery-payments.draw_date', $draw_date)
                ->where('lottery-players.active', true)
                ->orderBy('name', 'asc'); 

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('name', 'like', '%' . $search_input . '%');
            });
        }

        $query->orderBy('name', 'asc');

        $users = $query->paginate($length);

        return ['data' => $users];
    }

     public function updatePaidStatus(Request $request)
    {
        $player = $request->input('player');

        $lotteryPayment = LotteryPayment::where('id', $player['id'])
            ->update(['paid' => $player['paid'] === true ? 1 : 0]);

        /*
         * Income chart
         */
        $lotterySettings = LotterySetting::where('key', 'like', '%prize')
            ->get();

        $drawdates = LotteryDraw::select('draw_date')
            ->distinct()
            ->orderBy('draw_date', 'desc')
            ->limit(3)
            ->get();

        // get the total prizes for UK
        $uk_total_prize = $lotterySettings->filter(function($item) {
            return substr($item->key, -5) === 'prize' && substr($item->key, 0, 2) === 'uk' && $item->value != null;
        })->sum('value');
        // get the total prizes for Local
        $local_total_prize = $lotterySettings->filter(function($item) {
            return substr($item->key, -5) === 'prize' && substr($item->key, 0, 5) === 'local' && $item->value != null;
        })->sum('value');

        $dates = $drawdates->take(3)->reverse();

        $lotteryPayments = LotteryPayment::whereIn('draw_date', $dates->pluck('draw_date')->toArray())
            ->where('paid', 1)
            ->get();

        $uk_incomes = [];
        $local_incomes = [];

        foreach($dates as $date) {
            foreach(['UK', 'Local'] as $type) {
                // get the total income for UK
                ${strtolower($type) . '_income'}[] = $lotteryPayments->filter(function($item) use($date, $type) {
                    return $item->draw_date == $date->draw_date && $item->draw_type == $type;
                })->count() * 2;
            }
        }

        $incomedatasets = [
            (object) [
                'label' => 'UK Income',
                'backgroundColor' => '#4e73df',
                'stack' => 'Stack 0',
                'data' =>  [$uk_income[0], $uk_income[1], $uk_income[2]]
            ],
            (object) [
                'label' => 'UK Prizes',
                'backgroundColor' => '#2e59d9',
                'stack' => 'Stack 0',
                'data' =>  [ -$uk_total_prize,  -$uk_total_prize, -$uk_total_prize]
            ],
            (object) [
                'label' => 'Local Income',
                'backgroundColor' => '#1cc88a',
                'stack' => 'Stack 1',
                'data' =>  [$local_income[0], $local_income[1], $local_income[2]]
            ],
            (object) [
                'label' => 'Local Prizes',
                'backgroundColor' => '#17a673',
                'stack' => 'Stack 1',
                'data' =>  [-$local_total_prize, -$local_total_prize, -$local_total_prize]
            ],
        ];

        return response()->json(['income' => $incomedatasets], 200);
    }
}
