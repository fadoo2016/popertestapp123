<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const TYPE_DEFAULT = 0;
    public const TYPE_STUDENT = 1;
    public const TYPE_TEACHER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function findForPassport(string $username): self
    {
        $user = $this->where('username', $username)->firstOrFail();

        if (in_array($user->type, [static::TYPE_TEACHER, static::TYPE_STUDENT], true)) {
            return $user;
        } else {
            abort(Response::HTTP_FORBIDDEN, 'Just teacher and student are allowed to login.');
        }
    }

    public function validateForPassportPasswordGrant(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    public function isTeacher(): bool
    {
        return $this->type === self::TYPE_TEACHER;
    }

    public function isStudent(): bool
    {
        return $this->type === self::TYPE_STUDENT;
    }
}
