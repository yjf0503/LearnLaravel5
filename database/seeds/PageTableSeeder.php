<?php
/**
 * Created by PhpStorm.
 * User: jiefuyang
 * Date: 1/10/16
 * Time: 10:52 AM
 */
use Illuminate\Database\Seeder;
use App\Page;

class PageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('pages')->delete();

        for ($i = 0; $i < 10; $i++) {
            Page::create([
                'title' => 'Title ' . $i,
                'slug' => 'first-page',
                'body' => 'Body ' . $i,
                'user_id' => 1,
            ]);
        }
    }
}
