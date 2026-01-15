<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Organization;
use App\Models\Location;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Въведение в програмирането с PHP',
            'Основи на Laravel Framework',
            'Бази данни с MySQL',
            'Frontend с React.js',
            'Управление на IT проекти',
            'Киберсигурност за начинаещи',
            'Графичен дизайн с Photoshop',
            'Маркетинг в социалните мрежи'
        ];

        for ($i = 0; $i < 15; $i++) {
            Course::create([
                'title' => $titles[array_rand($titles)], 
                'start_date' => Carbon::now()->addDays(rand(1, 60)),
                'duration_hours' => rand(20, 120),
                'description' => 'Това е примерен курс, който ще ви даде основни познания в областта.',
                
                'lecturer_id' => Lecturer::inRandomOrder()->first()->id,
                'organization_id' => Organization::inRandomOrder()->first()->id,
                'location_id' => Location::inRandomOrder()->first()->id,
            ]);
        }
    }
}