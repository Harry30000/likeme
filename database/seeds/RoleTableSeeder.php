<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'User is allowed to manage and edit other users'
            ],
            [
                'name' => 'partner',
                'display_name' => 'Partner',
                'description' => 'Cộng Tác Viên'
            ],
            [
                'name' => 'subscriber',
                'display_name' => 'Subriber Member',
                'description' => 'Thành Viên Mua Vip'
            ],
            [
                'name' => 'free',
                'display_name' => 'Free Member',
                'description' => 'Thành Viên Xài Chùa'
            ]
        ];

        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }
}
