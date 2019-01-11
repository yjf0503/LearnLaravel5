<?php

use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('papers')->delete();

        for($i=0;$i<10;$i++){
        	\App\Paper::create([
        		'title' => 'Title '.$i,
        		'body' => 'Body '.$i,
        		'User_id' => 1,
        	]);
        }
    }
}
