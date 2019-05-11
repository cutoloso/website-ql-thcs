<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ToCMTableSeeder::class);
        $this->call(TietHocTableSeeder::class);
        $this->call(PhongTableSeeder::class);
        $this->call(ThuTableSeeder::class);
        $this->call(KhoaHocTableSeeder::class);
        $this->call(MonHocTableSeeder::class);
        $this->call(HocKyTableSeeder::class);
        $this->call(QuanTriTableSeeder::class);
        $this->call(GiaoVienTableSeeder::class);
        $this->call(LopTableSeeder::class);
        $this->call(PhuHuynhTableSeeder::class);
        $this->call(HocSinhTableSeeder::class);
        $this->call(KetQuaTableSeeder::class);
        // $this->call(ChuDe_GV_HSTableSeeder::class);
    }
}
