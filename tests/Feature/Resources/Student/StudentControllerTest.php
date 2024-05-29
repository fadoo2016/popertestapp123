<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Student;

class StudentControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->getJson(route('students.index'))
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'User is not a teacher.',
            ]);
    }
}
