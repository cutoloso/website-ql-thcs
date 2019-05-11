<?php

use Illuminate\Database\Seeder;

class ChuDe_GV_HSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $faker = Faker\Factory::create('vi_VN');
        $limit = 20;
        for ($i=0; $i < $limit; $i++) {
        	DB::table('ChuDe_GV_HS')->insert([
        		'cd_gvhs_ten'=>'Chủ đề '.$i
        	]); 
        }
    }
}
