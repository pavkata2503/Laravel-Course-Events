<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $orgs = [
            ['name' => 'SoftUni', 'address' => 'София, кв. Изгрев'],
            ['name' => 'IT Academy', 'address' => 'Пловдив, Център'],
            ['name' => 'Telerik Academy', 'address' => 'София, Младост'],
            ['name' => 'Технически Университет', 'address' => 'София, Студентски град'],
            ['name' => 'Code School', 'address' => 'Варна, Морска градина'],
        ];

        foreach ($orgs as $org) {
            Organization::create($org);
        }
    }
}