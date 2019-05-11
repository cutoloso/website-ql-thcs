<?php

use Illuminate\Database\Seeder;

class PhuHuynhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('vi_VN');
        $limit = 100;
        for ($i=0; $i < $limit; $i++) { 
        	DB::table('PhuHuynh')->insert([
        		'ph_ma'=>'PH'.(100+$i),
        		'ph_hoTen'=>$faker->lastName .' '. $faker->firstName,
        		'ph_ngaySinh'=>$faker->date('Y-m-d'),
        		'ph_phai'=>$faker->randomElement($array = array(0,1)),
        		'ph_diaChi'=>$faker->address,
        		'ph_email'=>$faker->unique()->email,
        		'ph_dienThoai'=>'0'.$faker->numberBetween(100000000,999999999)
        	]);
        }
    }
}
