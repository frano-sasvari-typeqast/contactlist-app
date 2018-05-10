<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Contact;

class ContactSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contact search page by "name" parameter
     *
     * @return void
     */
    public function testContactSearchByName()
    {
        factory(Contact::class, 20)->create();

        $contact = Contact::inRandomOrder()->first();

        $response = $this->get('contacts?keyword='.$contact->firstname);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'firstname' => $contact->firstname,
                'lastname' => $contact->lastname,
                'email' => $contact->email,
            ]);
    }

    /**
     * Test contact search page by "email" parameter
     *
     * @return void
     */
    public function testContactSearchByEmail()
    {
        factory(Contact::class, 20)->create();

        $contact = Contact::inRandomOrder()->first();

        $response = $this->get('contacts?keyword='.$contact->email);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'firstname' => $contact->firstname,
                'lastname' => $contact->lastname,
                'email' => $contact->email,
            ]);
    }
}
