<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lecturer;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        $lecturers = [
            ['name' => 'Иван Иванов', 'email' => 'ivan@test.com', 'phone' => '0888111222'],
            ['name' => 'Петър Петров', 'email' => 'peter@test.com', 'phone' => '0888333444'],
            ['name' => 'Мария Димитрова', 'email' => 'maria@test.com', 'phone' => '0888555666'],
            ['name' => 'Георги Георгиев', 'email' => 'georgi@test.com', 'phone' => '0888777888'],
            ['name' => 'Елена Тодорова', 'email' => 'elena@test.com', 'phone' => '0888999000'],
        ];

        foreach ($lecturers as $l) {
            Lecturer::create($l);
        }
    }
}