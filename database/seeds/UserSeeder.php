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

        $staff1 = User::create([
            'name' => 'Bagus Sonarangga',
            'email' => 'bsona@waroengjajanan.com',
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('Baguzt3aa'),
            'nohape' => '082128796431',
            'gender' => 'Pria'
        ]);

        $staff1->assignRole('staff');

        $staff2 = User::create([
            'name' => 'Putra Krishna',
            'email' => 'putra.krishna@reform14.com',
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('Uzii332'),
            'nohape' => '081234525425',
            'gender' => 'Pria'
        ]);

        $staff2->assignRole('staff');
    }
}
