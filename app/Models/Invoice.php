<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\InvoiceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    public const STATUS_CREATED         = 100;
    public const STATUS_PENDING_PAYMENT = 200;
    public const STATUS_PAID            = 300;

    public $fillable = [
        'teacher_user_id',
        'student_user_id',
        'course_id',
        'status',
        'omise_charge_id',
    ];

    /**
     * @return BelongsTo<User, Invoice>
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_user_id');
    }

    /**
     * @return BelongsTo<Course, Invoice>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new InvoiceScope());
    }
}
