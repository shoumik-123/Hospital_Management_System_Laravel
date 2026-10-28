<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Seed demo data for the live preview.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'userType' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Demo Patient',
            'email' => 'user@demo.com',
            'userType' => 0,
            'password' => Hash::make('password'),
        ]);

        $doctors = [
            ['Dr. Ayesha Rahman', 'Cardiology', '101', '1712953045.jpg'],
            ['Dr. Tanvir Hasan', 'Neurology', '102', '1712953075.jpg'],
            ['Dr. Nusrat Jahan', 'Pediatrics', '103', '1713041199.jpg'],
            ['Dr. Imran Hossain', 'Orthopedics', '104', '1713041218.jpg'],
            ['Dr. Farzana Akter', 'Dermatology', '105', '1713042609.jpg'],
            ['Dr. Rafiq Ahmed', 'General Medicine', '106', '1713042755.jpg'],
        ];

        foreach ($doctors as $i => [$name, $speciality, $room, $image]) {
            Doctor::create([
                'name' => $name,
                'phone' => '0171100000'.$i,
                'speciality' => $speciality,
                'roomNumber' => $room,
                'image' => $image,
            ]);
        }
    }
}
