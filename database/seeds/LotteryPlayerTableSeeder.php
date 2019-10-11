<?php
use Illuminate\Database\Seeder;
use App\Models\Admin\LotteryPlayer;
use Faker\Factory;
class LotteryPlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $input = ['UK', 'Local'];
        LotteryPlayer::truncate();
        foreach(range(1, 100) as $i) {
            LotteryPlayer::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'draw_type' => $input[array_rand($input)]
            ]);
        }
    }
}