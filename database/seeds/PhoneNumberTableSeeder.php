<?php

use Illuminate\Support\Facades\DB;
use App\Model\PhoneNumber;

class PhoneNumberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_number')->delete();
        DB::table('phone_number')->truncate();

        $max = 300;

        $this->command->getOutput()->progressStart($max);

        factory(PhoneNumber::class, $max)->create()->each(function ($phone) {
            $phone->make();

            $this->command->getOutput()->progressAdvance();
        });

        $this->command->getOutput()->progressFinish();
    }
}
