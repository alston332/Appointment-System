<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$zZ2BIUSOWR2CSNlj0HRmAudaum9gqsnHN7Wp4IPsbIQI6Lioru5NC',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
