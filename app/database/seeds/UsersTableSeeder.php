<?php
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::insert(array(
            array(
                'username' => 'mishora',
                'password' => Hash::make('123456'),
                'name' => 'Mihail',
                'last_name' => 'Kovachev',
                'email' => 'mishoria@gmail.com',
                'access' => 1,
                'ban' => 0
            )
        ));
    }
}