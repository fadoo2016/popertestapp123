<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Guest;

use Baijunyao\LaravelTestSupport\Restful\TestIndex;
use Baijunyao\LaravelTestSupport\Restful\TestStore;
use Database\Seeders\UserSeeder;

class CourseControllerTest extends TestCase
{
    use TestIndex;
    use TestStore;

    public array $storeData = [
        'student_user_id' => UserSeeder::USER_ID_STUDENT,
        'name'            => 'New Course',
        'date'            => '2024-05',
        'amount'          => 110,
    ];
}
