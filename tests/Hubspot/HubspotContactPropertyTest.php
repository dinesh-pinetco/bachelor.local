<?php

namespace Tests\Hubspot;

use App\Hubspot\ContactProperty;
use Tests\TestCase;

class HubspotContactPropertyTest extends TestCase
{
    /** @test */
    public function get_contact_properties_from_hubspot()
    {
        $properties = ContactProperty::make()->get();

        $this->assertIsArray($properties);
    }

    /** @test */
    public function find_contact_properties_by_name_from_hubspot()
    {
        $property = ContactProperty::make()->findByName('firstname');

        $this->assertSame('firstname', $property->name);
    }

    /** @test */
    public function create_contact_property_on_hubspot()
    {
        $request_data = [
            'name' => 'test_property_by_nak',
            'label' => 'Test property for NAK',
            'description' => 'Test property for NAK',
            'groupName' => 'contactinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => true,
            'options' => [],
        ];

        $response = ContactProperty::make()->create($request_data);

        $this->assertSame($request_data['name'], $response->name);

        $response = ContactProperty::make()->delete($request_data['name']);
        $this->assertNull($response);
    }

    /** @test */
    public function check_contact_property_exists_on_hubspot()
    {
        $response = ContactProperty::make()->exists('firstname');

        $this->assertTrue($response);
    }

    /** @test */
    public function check_contact_property_not_exists_on_hubspot()
    {
        $response = ContactProperty::make()->exists(random_color().rand());

        $this->assertFalse($response);
    }
}
