<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListingFormEntriesTest extends TestCase
{
    private string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->route = route('formEntries.list');
    }

    public function testShouldForbidUnauthorisedUserToViewFormEntries(): void
    {
        $response = $this->get($this->route);

        $response->assertRedirect('/login');
    }

    public function testShouldListFormEntries(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get($this->route);

        $response->assertStatus(200)->assertSee('Form Entries');
    }
}
