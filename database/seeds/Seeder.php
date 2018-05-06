<?php

use Illuminate\Database\Seeder as BaseSeeder;

use Illuminate\Support\Facades\DB;

class Seeder extends BaseSeeder
{
    /**
     * Create new database seeder instance
     *
     * @return void
     */
    public function __construct()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

    /**
     * Destroy database seeder instance
     *
     * @return void
     */
    public function __destruct()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
