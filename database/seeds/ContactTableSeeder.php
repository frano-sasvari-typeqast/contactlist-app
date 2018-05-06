<?php

use Illuminate\Support\Facades\DB;
use App\Model\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->delete();

        $max = 30;

        $this->command->getOutput()->progressStart($max);

        factory(Contact::class, $max)->create()->each(function ($contact) {
            $contact->make();

            $this->command->getOutput()->progressAdvance();
        });

        $this->command->getOutput()->progressFinish();
    }
}
