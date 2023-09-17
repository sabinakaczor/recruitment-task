<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShowingAddingEntriesFormTest extends TestCase
{
    private string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->route = route('formEntries.create');
    }

    public function testShouldShowFormEntriesForm(): void
    {
        $response = $this->get($this->route);

        $response->assertStatus(200)->assertSee('Add a new entry');
    }
}
