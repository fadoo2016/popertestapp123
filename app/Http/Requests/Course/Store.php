<?php

declare(strict_types=1);

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        return $user->isTeacher();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_user_id' => 'required|exists:users,id',
            'name'            => 'required|string|max:255',
            'date'            => 'required|date',
            'amount'          => 'required|numeric',
        ];
    }
}
