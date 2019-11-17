<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * 测试数据填充
     * php artisan make:seeder UsersTableSeeder
     * php artisan db:seed --class=UsersTableSeeder
     * */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\User::class, 20)->create();
    }
}
