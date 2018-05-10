<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Contact;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contact index page
     *
     * @return void
     */
    public function testContactIndexPage()
    {
        factory(Contact::class, 50)->create();

        $contacts = Contact::paginate(20);

        $contact = $contacts->random();

        $response = $this->get('contacts');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'from' => 1,
                'to' => 20,
                'total' => $contacts->total(),
            ])
            ->assertJsonFragment([
                'firstname' => $contact->firstname,
                'lastname' => $contact->lastname,
            ]);
    }

    /**
     * Test contact index page on pagination page 3
     *
     * @return void
     */
    public function testContactIndexPageOnPaginationPage3()
    {
        factory(Contact::class, 50)->create();

        $contacts = Contact::paginate(20, ['*'], 'page', 3);

        $contact = $contacts->random();

        $response = $this->get('contacts?page=3');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'from' => 41,
                'to' => 50,
                'total' => $contacts->total(),
            ])
            ->assertJsonFragment([
                'firstname' => $contact->firstname,
                'lastname' => $contact->lastname,
            ]);
    }
}
