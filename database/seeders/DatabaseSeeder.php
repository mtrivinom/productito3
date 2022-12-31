<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call(UserSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(EnrollmentSeeder::class);
        $this->call(WorksSeeder::class);
        $this->call(ExamsSeeder::class);
        
    }

}
