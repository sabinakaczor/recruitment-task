<?php

namespace Tests\Feature;

use App\Models\FormEntry;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreatingFormEntriesTest extends TestCase
{
    private string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->route = route('formEntries.store');
    }

    /**
     * @dataProvider missingFieldProvider
     */
    public function testShouldReturnValidationErrorWhenFieldIsMissing(string $field): void
    {
        $data = Arr::except($this->getCorrectRequestData(), $field);
        
        $response = $this->postJson($this->route, $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrorFor($field);
    }

    /**
     * @dataProvider incorrectDataProvider
     */
    public function testShouldReturnValidationErrorWhenDataIsIncorrect(string $field, mixed $value): void
    {
        $data = $this->getCorrectRequestData();
        $data[$field] = $value;
        
        $response = $this->postJson($this->route, $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrorFor($field);
    }

    public function testShouldCreateFormEntry(): void
    {
        Storage::fake('public');

        $data = $this->getCorrectRequestData();
        
        $response = $this->postJson($this->route, $data);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                   'id',
                ]
            ]);

        /** @var FormEntry */
        $model = FormEntry::query()->find($response->json('data.id'));

        $this->assertNotNull($model);
        $this->assertEquals($data['first_name'], $model->first_name);
        $this->assertEquals($data['last_name'], $model->last_name);
        $filePath = substr($model->attachment, strlen('/storage'));
        Storage::disk('public')->assertExists($filePath);
    }

    /**
     * Returns cases in the format 'case1' => ['case1']
     */
    public static function missingFieldProvider(): array
    {
        $fields = [
            'first_name',
            'last_name',
            'attachment',
        ];

        return Arr::mapWithKeys($fields, fn (string $field) => [$field => [$field]]);
    }

    public static function incorrectDataProvider(): array
    {
        return [
            'empty first name' => [
                'first_name',
                '',
            ],
            'too long first name' => [
                'first_name',
                Str::random(101),
            ],
            'empty last name' => [
                'last_name',
                '',
            ],
            'too long last name' => [
                'last_name',
                Str::random(101),
            ],
            'too big attachment' => [
                'attachment',
                UploadedFile::fake()->image('example')->size(2049),
            ],
            'invalid attachment mimetype' => [
                'attachment',
                UploadedFile::fake()->create('example.pdf')->size(512),
            ],
        ];
    }

    private function getCorrectRequestData(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'attachment' => UploadedFile::fake()->image('example.jpg')->size(2048),
        ];
    }
}
