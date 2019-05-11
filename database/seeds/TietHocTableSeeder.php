<?php

use Illuminate\Database\Seeder;

class TietHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('TietHoc')->insert([
        	['th_stt'=>1,'th_buoi'=>'s','th_gio'=>'07:00:00'],
        	['th_stt'=>2,'th_buoi'=>'s','th_gio'=>'07:50:00'],
        	['th_stt'=>3,'th_buoi'=>'s','th_gio'=>'08:45:00'],
        	['th_stt'=>4,'th_buoi'=>'s','th_gio'=>'09:35:00'],
        	['th_stt'=>5,'th_buoi'=>'s','th_gio'=>'10:25:00'],
        	['th_stt'=>1,'th_buoi'=>'c','th_gio'=>'13:30:00'],
        	['th_stt'=>2,'th_buoi'=>'c','th_gio'=>'14:20:00'],
        	['th_stt'=>3,'th_buoi'=>'c','th_gio'=>'15:15:00'],
        	['th_stt'=>4,'th_buoi'=>'c','th_gio'=>'16:05:00'],
        	['th_stt'=>5,'th_buoi'=>'c','th_gio'=>'16:55:00'],

        ]);
    }
}
