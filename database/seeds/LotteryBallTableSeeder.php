<?php
use Illuminate\Database\Seeder;
use App\Models\Admin\LotteryBall;
class LotteryBallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LotteryBall::truncate();
        foreach(range(1, 99) as $i) {
            LotteryBall::create([
                'lottery_number' => $i,
                'draw_type' => 'UK'
            ]);
            LotteryBall::create([
                'lottery_number' => $i,
                'draw_type' => 'Local'
            ]);
        }
    }
}