<?php

namespace Tests\Hubspot;

use App\Hubspot\Contact;
use Tests\TestCase;

class HubspotContactTest extends TestCase
{
    /** @test */
    public function create_contact_on_hubspot()
    {
        $properties = [
            'company'   => 'NAK Test',
            'email'     => 'nak@testing.com',
            'firstname' => 'NAK',
            'lastname'  => 'Test',
            'phone'     => '9978883355',
            'website'   => 'naktesting.com',
        ];

        $hubspotContact = Contact::make()->create($properties);

        $this->assertEquals($hubspotContact->properties->email->value, $properties['email']);

        $response = Contact::make()->delete(data_get($hubspotContact, 'vid'));

        $this->assertTrue(data_get($response, 'deleted'));
    }

    /** @test */
    public function find_contact_on_hubspot()
    {
        $properties = [
            'company'   => 'NAK Test',
            'email'     => 'nak.find@testing.com',
            'firstname' => 'NAK',
            'lastname'  => 'Test',
        ];

        $hubspotContact = Contact::make()->create($properties);
        $this->assertEquals($hubspotContact->properties->email->value, $properties['email']);

        $response = Contact::make()->delete(data_get($hubspotContact, 'vid'));
        $this->assertTrue(data_get($response, 'deleted'));
    }

    /** @test */
    public function update_contact_on_hubspot()
    {
        $properties = [
            'company'   => 'NAK Test',
            'email'     => 'nak.find@testing.com',
            'firstname' => 'NAK',
            'lastname'  => 'Test',
        ];

        $hubspotContact = Contact::make()->create($properties);
        $this->assertEquals($hubspotContact->properties->firstname->value, $properties['firstname']);

        $properties = [
            'firstname' => 'NAK edit',
        ];

        $response = Contact::make()->update(data_get($hubspotContact, 'vid'), $properties);
        $this->assertNull($response);

        $hubspotContact = Contact::make()->find(data_get($hubspotContact, 'vid'));
        $this->assertEquals($hubspotContact->properties->firstname->value, $properties['firstname']);

        $response = Contact::make()->delete(data_get($hubspotContact, 'vid'));
        $this->assertTrue(data_get($response, 'deleted'));
    }

    /** @test */
    public function update_or_create_contact_on_hubspot()
    {
        $properties = [
            'company'   => 'NAK Test',
            'email'     => 'nak@testing.com',
            'firstname' => 'NAK',
            'lastname'  => 'Test',
            'phone'     => '9978883355',
            'website'   => 'naktesting.com',
        ];

        $response = Contact::make()->updateOrCreate($properties['email'], $properties);
        $this->assertNotNull(data_get($response, 'vid'));

        $response = Contact::make()->delete(data_get($response, 'vid'));

        $this->assertTrue(data_get($response, 'deleted'));
    }
}
