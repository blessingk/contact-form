<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * @var Collection|Model
     */
    private $contacts;
    /**
     * @var Collection|Model
     */
    private $user;

    /**
     * ApplicationTestCase setup
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->contacts = Contact::factory()->count(5)->create();
        $this->user = User::factory()->create();
    }
    /**
     * Test get contacts
     *
     * @return void
     */
    public function test_get_contacts()
    {
        $response = $this->actingAs($this->user)->getJson('/api/contacts');
        $response->assertStatus(200);
        $this->assertCount(5, $this->contacts);
        $this->assertNotEmpty($response);
    }

    /**
     * Test getting single contact
     */
    public function test_get_single_contact()
    {
        $contact = $this->contacts->first();
        $response = $this->actingAs($this->user)->getJson('/api/contacts/'.$contact->id);
        $response->assertStatus(200);
        $this->assertNotEmpty($response);
        $response->assertJson([
            'data' => [
                'name' => $contact->name,
                'email' => $contact->email,
                'gender' => $contact->gender,
                'content' => $contact->content,
            ]
        ]);
    }

    /**
     * Test deleting contact
     */
    public function test_delete_contact()
    {
        $contact = $this->contacts->first();
        $response = $this->actingAs($this->user)->delete('/api/contacts/'.$contact->id);
        $response->assertStatus(204);
    }

    /**
     * Test creating a contact
     */
    public function test_create_contact()
    {
        $data = [
            'name' => 'Tats',
            'email' => 'tates@gmail.com',
            'gender' => 'Male',
            'content' => 'Testing content'
        ];
        $response = $this->actingAs($this->user)->postJson('/api/contacts/', $data);
        $response->assertStatus(201);
    }

    /**
     * Test updating contact
     */
    public function test_update_contact()
    {
        $data = [
            'name' => 'Tats1',
            'email' => 'tats1@gmail.com',
            'gender' => 'Female',
            'content' => 'Testing content 1'
        ];
        $contact = $this->contacts->first();
        $response = $this->actingAs($this->user)->putJson('/api/contacts/'.$contact->id, $data);
        $response->assertStatus(202);
    }

    /**
     * Test creating a contact
     */
    public function test_create_contact_validation()
    {

        $data = [
            'name' => 'Tats',
            'email' => 'tates@gmail.com',
            'gender' => 'Male',
        ];
        $response = $this->actingAs($this->user)->postJson('/api/contacts/', $data);
        $response->assertStatus(422);
    }
}
