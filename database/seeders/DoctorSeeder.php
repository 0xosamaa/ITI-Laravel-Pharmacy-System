<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $names = [
                'Oliver Jones', 'Amelia Martin', 'Ethan Walker', 'Isabella Taylor', 'Noah Anderson',
                'Sophia Thompson', 'Liam Baker', 'Charlotte Wilson', 'Aiden Green', 'Lucy Lee',
                'Carter Hall', 'Grace Parker', 'Mason Adams', 'Chloe Davis', 'Evelyn Brown',
                'Elijah Edwards', 'Mia Mitchell', 'Logan White', 'Harper Evans', 'Caleb Johnson',
                'Avery Clark', 'Abigail King', 'Benjamin Wright', 'Emily Scott', 'William Turner',
                'Madison Lewis', 'Michael Hill', 'Aria Cooper', 'James Reed', 'Sofia Bailey',
                'Alexander Morris', 'Ella Phillips', 'Owen Rogers', 'Aubrey Murphy', 'Gabriel Richardson',
                'Aaliyah Rogers', 'Lucas Nelson', 'Luna Sanders', 'Daniel Kim', 'Ellie Price',
                'Jackson Peterson', 'Lily Hayes', 'Henry Foster', 'Nora Reyes', 'Levi Ramirez',
                'Hazel Simpson', 'Ryan Morgan', 'Riley Coleman', 'Kaylee Brooks', 'Isaac Cole'
            ];

            $emails = array_map(function ($name) {
                $name_parts = explode(' ', $name);
                $first_name = strtolower($name_parts[0]);
                $last_name = strtolower($name_parts[1]);
                return $first_name . '_' . $last_name . '@doctor.com';
            }, $names);

            $directory = public_path('storage/images/doctors');
            $files = File::files($directory);
            File::delete($files);

            for ($i = 0; $i < 50; $i++) {
                $name = $names[$i];
                $email = $emails[$i];

                $users[] = [
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt('password')
                ];
            }

            $pharmacies = Pharmacy::all()->pluck('id');
            $national_id = 28204227480000;

            foreach ($users as $user) {
                $user = User::factory()->create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => \Carbon\Carbon::now(),
                    'password' => $user['password']
                ])->assignRole('doctor');
                $user_id = $user->id;

                $image_name = uniqid() . '.jpg';
                File::copy(
                    public_path('site/images/person_') . fake()->numberBetween(2, 4) . '.jpg',
                    $directory . '/' . $image_name
                );

                DB::table('doctors')->insert([
                    'user_id' => $user_id,
                    'national_id' => $national_id++,
                    'avatar_image' => $image_name,
                    'pharmacy_id' => $pharmacies->random(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                $user = \App\Models\User::find($user_id);
                $user->assignRole('doctor');
            }
        });
    }
}
