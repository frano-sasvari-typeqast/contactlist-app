<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ContactCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactCreateSuccess()
    {
        $uploadAvatar = str_slug($this->faker->word).'.jpg';

        $input = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'upload_avatar' => UploadedFile::fake()->image($uploadAvatar),
            'is_favorite' => 1,
        ];

        $response = $this->json('POST', 'contacts', $input);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
            ]);
    }

    /**
     * Test contact show page
     *
     * @return void
     */
    public function testContactCreateValidationErrorEmail()
    {
        $input = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => '',
            'upload_avatar' => null,
            'is_favorite' => 1,
        ];

        $response = $this->json('POST', 'contacts', $input);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }
}
