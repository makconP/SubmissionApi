<?php

namespace Tests\Feature;

use App\Events\SubmissionSavedEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CreateSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_success(): void
    {
        Event::fake();

        $params = $this->getDefaultParams();
        $response = $this->request($params);

        Event::assertDispatched(SubmissionSavedEvent::class);

        $this->assertDatabaseHas('submissions', [
            'name' => $params['name'],
            'email' => $params['email'],
            'message' => $params['message'],
        ]);

        $response->assertStatus(200)
            ->assertExactJson([
                'message' => 'ok',
            ]);
    }

    /**
     * @param  array<string, mixed>  $params
     */
    private function request(array $params): TestResponse
    {
        return $this->postJson('/api/submissions/', $params);
    }

    /**
     * @return array<string, mixed>
     */
    private static function getDefaultParams(): array
    {
        return [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];
    }

    #[DataProvider('dataProviderForTestingValidation')]
    public function test_422(array $params): void
    {
        $this->request($params)
            ->assertStatus(422);
    }

    /**
     * @return array<string, mixed>
     */
    public static function dataProviderForTestingValidation(): array
    {
        $makeParams = function (array $replaces) {
            $params = self::getDefaultParams();
            foreach ($replaces as $key => $value) {
                data_set($params, $key, $value);
            }

            return $params;
        };

        return [
            'name is required' => [$makeParams(['name' => null])],
            'name is string' => [$makeParams(['name' => 123])],

            'email is required' => [$makeParams(['email' => null])],
            'email is valid rfc email' => [$makeParams(['email' => 'string'])],

            'message is required' => [$makeParams(['message' => null])],
            'message is string' => [$makeParams(['message' => 123])],
        ];
    }
}
