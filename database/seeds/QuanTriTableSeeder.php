<?php

use Illuminate\Database\Seeder;

class QuanTriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('vi_VN');
    	DB::table('QuanTri')->insert([
    		'qt_ma'=>'QT100',
    		'qt_hoTen'=>$faker->lastName.' '.$faker->firstName,
    		'qt_ngaySinh'=>$faker->date,
    		'qt_phai'=>$faker->randomElement($array = array(0,1)),
    		'qt_diaChi'=>$faker->address,
    		'qt_email'=>$faker->email,
    		'qt_dienThoai'=>'0'.$faker->numberBetween(100000000,999999999)
    	]);
    }
}
