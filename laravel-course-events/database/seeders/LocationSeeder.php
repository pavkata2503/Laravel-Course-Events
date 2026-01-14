<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $cities = ['София', 'Пловдив', 'Варна', 'Бургас', 'Русе', 'Стара Загора'];

        foreach ($cities as $city) {
            Location::create(['city_name' => $city]);
        }
    }
}