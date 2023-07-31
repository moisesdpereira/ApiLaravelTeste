<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Doctor;
use App\Models\DoctorPatient;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

//        City::factory(10)->create();
//
//        Patient::factory(10)->create();
//
//        Doctor::factory(10)->create();

        DoctorPatient::factory(10)->create();

         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'email_verified_at' => now(),
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
             'remember_token' => Str::random(10),
         ]);
    }
}
