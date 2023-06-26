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
            'company' => 'NAK Test',
            'email' => 'nak@testing.com',
            'firstname' => 'NAK',
            'lastname' => 'Test',
            'phone' => '9978883355',
            'website' => 'naktesting.com',
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
            'company' => 'NAK Test',
            'email' => 'nak.find@testing.com',
            'firstname' => 'NAK',
            'lastname' => 'Test',
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
            'company' => 'NAK Test',
            'email' => 'nak.find@testing.com',
            'firstname' => 'NAK',
            'lastname' => 'Test',
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
            'company' => 'NAK Test',
            'email' => 'nak@testing.com',
            'firstname' => 'NAK',
            'lastname' => 'Test',
            'phone' => '9978883355',
            'website' => 'naktesting.com',
        ];

        $response = Contact::make()->updateOrCreate($properties['email'], $properties);
        $this->assertNotNull(data_get($response, 'vid'));

        $response = Contact::make()->delete(data_get($response, 'vid'));

        $this->assertTrue(data_get($response, 'deleted'));
    }

    /** @test  */
    public function applicant_sync_data_to_hubspot()
    {
        $applicantDetailForHubspot = [
            'email' => 'nak@testing.com',
            'firstname' => 'NAK',
            'lastname' => 'Testcases',
            'phone' => null,
            'bachelor_desired_beginning' => 'October 2023',
            'bachelor_study_courses' => '1;2;3',
            'bachelor_registration_submitted' => 1678440162000,
            'bachelor_profile_information_completed' => 1678440316000,
            'bachelor_test_taken' => false,
            'bachelor_test_passed' => true,
            'bachelor_personal_data_completed' => true,
            'bachelor_consent_to_company_portal_bulletin_board' => true,
            'bachelor_approved_by_company_for_enrolment' => false,
            'bachelor_rejected_by_applicant' => false,
        ];

        $hubspotContact = Contact::make()->updateOrCreate($applicantDetailForHubspot['email'], $applicantDetailForHubspot);

        dd($hubspotContact);
    }
}
