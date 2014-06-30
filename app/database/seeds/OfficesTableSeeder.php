<?php
class OfficesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('offices')->delete();
        Office::insert(array(
            array(
                'name' => 'Bulgaria',
                'desc' => 'Bulgarian office',
            ),
            array(
                'name' => 'Serbia',
                'desc' => 'Serbian office',
            ),
            array(
                'name' => 'Macedonia',
                'desc' => 'Macedonian office',
            )
        ));
    }
}