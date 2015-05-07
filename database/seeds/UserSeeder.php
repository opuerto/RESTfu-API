<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = 
        [
            [
                'email'=>'fake@fake.com',
                'password'=>Hash::make('password')
            ],
            [
                'email'=>'oscar@fake.com',
                'password'=>Hash::make('password')
            ]

        ];

        foreach ($users as $user) {
            User::create($user);
        }

       
             
    }
}
