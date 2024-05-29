<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Student;

use Baijunyao\LaravelTestSupport\Restful\TestIndex;
use Database\Seeders\UserSeeder;

class CourseControllerTest extends TestCase
{
    use TestIndex;

    public function testStoreForbidden(): void
    {
        $this->postJson(
            route('courses.store'),
            [
                'student_user_id' => UserSeeder::USER_ID_STUDENT,
                'name'            => 'New Course',
                'date'            => '2024-05',
                'amount'          => 110,
            ]
        )
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'This action is unauthorized.',
            ]);
    }
}
