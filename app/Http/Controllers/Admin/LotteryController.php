<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotterySetting;
use App\Http\Traits\LotteryTrait;

class LotteryController extends Controller
{
    use LotteryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotterySetting = LotterySetting::all();

        $data = [];

        foreach($lotterySetting as $setting) {
            $data[$setting->key] = $setting->value;
        }

        $data['draw_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['draw_date'])->format('d M Y');

        return View('admin.lottery.index')->with(['settings' => $data]);
    }

    public function draw()
    {
        $data = [];

        return View('admin.lottery.draw')->with($data);
    }

    public function additionalNumbers(Request $request)
    {
        $key = strtolower($request->input('type')) . '_ball_count';

        $lotterySetting = LotterySetting::where('key', $key)
            ->update(['value' => $request->input('new_total')]);

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
        $lotterySetting = LotterySetting::where('key', 'draw_date')
            ->update(['value' => $request->input('draw_date')]);

        return response()->json($lotterySetting, 200);
    }
}
