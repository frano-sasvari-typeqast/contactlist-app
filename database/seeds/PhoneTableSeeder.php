<?php

use Illuminate\Support\Facades\DB;
use App\Model\Phone;

class PhoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone')->delete();

        $max = 150;

        $this->command->getOutput()->progressStart($max);

        factory(Phone::class, $max)->create()->each(function ($phone) {
            $phone->make();

            $this->command->getOutput()->progressAdvance();
        });

        $this->command->getOutput()->progressFinish();
    }
}
