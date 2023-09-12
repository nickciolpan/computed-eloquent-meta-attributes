<?php
use App\Models\LLC;
use App\Models\RealEstate;
use App\Models\Liability;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $llc = LLC::create(
                [
                'name' => "LLC $i",
                'value' => rand(100, 1000)
                ]
            );

            for ($j = 1; $j <= 3; $j++) {
                $realEstate = RealEstate::create(
                    [
                    'name' => "Real Estate $j of LLC $i",
                    'llc_id' => $llc->id,
                    'value' => rand(100, 1000)
                    ]
                );

                for ($k = 1; $k <= 3; $k++) {
                        Liability::create(
                            [
                            'name' => "Liability $k of Real Estate $j",
                            'real_estate_id' => $realEstate->id,
                            'value' => rand(100, 1000)
                            ]
                        );
                }
            }
        }
    }
}
