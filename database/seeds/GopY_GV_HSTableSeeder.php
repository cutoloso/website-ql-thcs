<?php

use Illuminate\Database\Seeder;

class GopY_GV_HSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('vi_VN');
        $limit = 20;
        for ($i=0; $i < $limit; $i++) {
        	DB::table('GopY_GV_HS')->insert([
        		'cd_gvhs_ma':$i,
        		'gy_gvhs_tGian'=>$faker->dataTimeBetween('-1 years','now'),
        		'gy_gvhs_noiDung'=>$faker->text(200)
        	]); 
        }
    }
}
