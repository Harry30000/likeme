<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TokenTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);

        $faker = Faker\Factory::create();

        $limit = 20;

        DB::table('users')->insert(array(
            'name' => 'Nguyễn Minh Phúc',
            'email' => 'minhphuc429@gmail.com',
            'password' => Hash::make('24041995'),
            //'facebook_id' => '505297493007927',
            //'avatar' => 'https://graph.facebook.com/v2.6/505297493007927/picture?type=normal',
            'created_at' => $faker->dateTimeThisYear($max = 'now'),
            'updated_at' => $faker->dateTimeThisYear($max = 'now'),
        ));

        $user = App\User::where('email', '=', 'minhphuc429@gmail.com')->first();

        $user->roles()->attach(1); // id only
        // add permissions to those Roles
        $role = App\Role::where('name', '=', 'admin')->first();
        $role->attachPermissions(array(1, 2, 3, 4));

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('12345678'),
                //'facebook_id' => $faker->unique()->ean13,
                //'avatar' => $faker->imageUrl(100, 100, 'people'),
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
                'updated_at' => $faker->dateTimeThisYear($max = 'now'),
            ]);
        }

        DB::table('prices')->insert(array(
            array('price' => '0', 'like_limit' => '50', 'comment_limit' => '10', 'like' => '500', 'comment' => '100'),
            array('price' => '150000', 'like_limit' => '150', 'comment_limit' => '150', 'like' => '63000', 'comment' => '63000'),
            array('price' => '250000', 'like_limit' => '300', 'comment_limit' => '300', 'like' => '126000', 'comment' => '126000'),
            array('price' => '450000', 'like_limit' => '500', 'comment_limit' => '500', 'like' => '210000', 'comment' => '210000'),
            array('price' => '650000', 'like_limit' => '700', 'comment_limit' => '700', 'like' => '294000', 'comment' => '294000'),
            array('price' => '800000', 'like_limit' => '1000', 'comment_limit' => '1000', 'like' => '420000', 'comment' => '420000'),
            array('price' => '1500000', 'like_limit' => '2000', 'comment_limit' => '2000', 'like' => '840000', 'comment' => '840000'),
        ));

        DB::table('vip_users')->insert(array(
            array('user_id' => '1', 'prices_id' => '6', 'like_available' => '840000', 'comment_available' => '840000', 'begin' => '2016-01-01', 'end' => '2016-12-31'),
        ));
    }
}
