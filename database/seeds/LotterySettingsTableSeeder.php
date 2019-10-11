<?php
use Illuminate\Database\Seeder;
use App\Models\Admin\LotterySetting;
class LotterySettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LotterySetting::truncate();
        LotterySetting::create([
            'key' => 'draw_date',
            'value' => null,
        ]);
        LotterySetting::create([
            'key' => 'uk_winners',
            'value' => 3,
        ]);
        LotterySetting::create([
            'key' => 'local_winners',
            'value' => 4,
        ]);
        LotterySetting::create([
            'key' => 'uk_ball_count',
            'value' => 99,
        ]);
        LotterySetting::create([
            'key' => 'local_ball_count',
            'value' => 120,
        ]);
    }
}