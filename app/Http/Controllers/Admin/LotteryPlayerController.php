<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryPlayer;
use App\Models\Admin\LotteryBall;
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
        return View('admin.lottery.players.index');
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
}
