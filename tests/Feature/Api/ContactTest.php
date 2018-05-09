<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * A test category success status response
     *
     * @return void
     */
    public function testResponseStatusSuccess()
    {
        $response = $this->get('contacts');

        $response->assertSuccessful();
    }
}
