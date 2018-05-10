<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Contact;

class ContactUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactUpdateSuccess()
    {
        $contact = factory(Contact::class)->create();

        $input = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $contact->email,
        ];

        $response = $this->json('PUT', 'contacts/'.$contact->id, $input);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
            ])
            ->assertJsonMissing([
                'firstname' => $contact->firstname,
                'lastname' => $contact->lastname,
            ]);
    }

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactUpdateValidationErrorEmail()
    {
        $contact = factory(Contact::class)->create();

        $input = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => '',
        ];

        $response = $this->json('PUT', 'contacts/'.$contact->id, $input);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }
}
