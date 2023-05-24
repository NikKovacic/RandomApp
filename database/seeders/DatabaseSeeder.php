<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
//        User::factory()->create([
//            'name' => 'Nik Kovacic',
//            'email' => 'nik.kovacic10@gmail.com',
//        ]);
        LegalPerson::factory(10)->create();
        NaturalPerson::factory(10)->create();
    }
}
