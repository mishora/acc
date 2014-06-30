<?php
class CatsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('cats')->delete();
        Cat::insert(array(
            array(
                'name' => 'Sales',
                'type' => 0,
                'desc' => 'Sales',
                'access' => 3
            ),
            array(
                'name' => 'Purchases',
                'type' => 1,
                'desc' => 'Purchases',
                'access' => 3
            )
        ));
    }
}