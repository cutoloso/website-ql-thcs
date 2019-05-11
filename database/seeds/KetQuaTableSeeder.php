<?php

use Illuminate\Database\Seeder;
class KetQuaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	$ds_hs = DB::table('HocSinh')->where('kh_khoaHoc','2018')->where('l_ma','A')->get();
    	// $ds_toCM = DB::table('ToCM')->whereNotIn('cm_ma',['GT','HH'])->get(['cm_ma']);
        $ds_cm = array('T','VL','SH','CN','NV','LS','DL','CD','NN','TD','AN','MT','TH');
        foreach ($ds_hs as $hs) {
	        foreach ($ds_cm as $cm) {
    	        for ($i=1; $i < 3; $i++) { 
                    DB::table('KetQua')->insert([
                        'hs_ma'     => $hs->hs_ma,
                        'hk_hocKy'  => 1,
                        'hk_namHoc' => '2018-2019',
                        // 'mh_ma'      => ($cm->cm_ma).($this->getKhoi($hs->kh_khoaHoc)),
                        'mh_ma'     => $cm.'6',
                        'kq_lan'    => 1,
                        'kq_diem'   => $faker->randomFloat(2, 5, 10),
                        'kq_heSo'    => $i
                    ]);
                }
	        }
        }
    }
    protected function getKhoi($kh_khoaHoc){
    	$yearNow = date("Y");
    	$kh_khoaHoc = (int)$kh_khoaHoc;
    	switch ($kh_khoaHoc) {
    		case $yearNow:
    			return 6;
    		case $yearNow-1:
    			return 7;
    		case $yearNow-2:
    			return 8;
    		case $yearNow-3:
    			return 9;
    	}
    }
}
