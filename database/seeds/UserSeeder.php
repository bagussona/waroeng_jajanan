<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@waroengjajanan.com',
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('adminadmin'),
            'nohape' => '082128796431',
            'gender' => 'Pria'
        ]);

        $admin->assignRole('admin');

        $staff = User::create([
            'name' => 'Bagus Sonarangga',
            'email' => 'bsona@waroengjajanan.com',
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('Baguzt3aa'),
            'nohape' => '082128796431',
            'gender' => 'Pria'
        ]);

        $staff->assignRole('staff');
    }
}
