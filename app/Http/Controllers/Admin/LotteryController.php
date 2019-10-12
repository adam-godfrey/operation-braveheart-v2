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

        return View('admin.lottery.index')->with(['settings' => $data]);
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

            $data['settings'][] = (object) [
                'prize' => $output[1],
                'abbr' =>  $nf->format($i) . ' Prize',
                'value' => $prize->value,
            ];
        }

        $data['draw_date'] = (new \DateTime(
            LotterySetting::select('value')
                ->where('key', 'draw_date')
                ->first()
                ->value
        ))->format('d M Y');

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
