<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
    public function testContactUpdateSuccessWithImage()
    {
        $contact = factory(Contact::class)->create();

        $uploadAvatar = str_slug($this->faker->word).'-new.jpg';

        $input = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $contact->email,
            'upload_avatar' => UploadedFile::fake()->image($uploadAvatar),
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
                'upload_avatar' => $contact->upload_avatar,
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
