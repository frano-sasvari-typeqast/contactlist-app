<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Contact;

class ContactDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactDeleteSuccess()
    {
        $contact = factory(Contact::class)->create();

        $response = $this->json('DELETE', 'contacts/'.$contact->id);

        $response
            ->assertStatus(200);
    }

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactDeleteError()
    {
        $response = $this->json('DELETE', 'contacts/123123123');

        $response
            ->assertStatus(404);
    }
}
