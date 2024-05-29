<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\CourseScope;
use Date;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    public $fillable = [
        'teacher_user_id',
        'student_user_id',
        'name',
        'date',
        'amount',
    ];

    /**
     * @return HasOne<User>
     */
    public function student(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_user_id');
    }

    /**
     * @return HasOne<Invoice>
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'course_id', 'id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CourseScope());
    }

    /**
     * @return Attribute<string, string>
     */
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn (string $date): string => Date::parse($date)->format('Y-m'),
            set: fn (string $date): string => Date::parse($date)->format('Y-m-d'),
        );
    }
}
