<?php

namespace Database\Seeders;

use App\Models\Ride;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class RideSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();
        
        // Generate 100 rides with dates ranging from the first month to the second month of the year
        for ($i = 0; $i < 100; $i++) {
            $randomDate = $this->faker->dateTimeBetween($startDate, $endDate);
            
            Ride::factory()->create([
                'time' => $randomDate->format('H:i:s'),
                'created_at' => $randomDate,  // Optionally set the created_at to the same random date
                'updated_at' => $randomDate,  // Optionally set the updated_at to the same random date
            ]);
        }
    }
}
