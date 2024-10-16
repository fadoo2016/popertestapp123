<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
	public function list()
	{
		$users = User::paginate(10);
        return view('user.list', compact("users"));
	}


	public function create()
	{
        return view('user.create');
	}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('user.list', absolute: false));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }
	
    /**
     * Update the user's profile information.
     */
    public function update(Request $request,User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

		$pwd = $request->input('password');
		if ($pwd != ""){
			$user->password = $pwd;
		}
        $user->fill($request->except(['_token','password']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        return redirect(route('user.list', absolute: false));
    }

    /**
     * Delete the user's account.
     */
    public function remove(User $user): RedirectResponse
    {
        $user->delete();

        return redirect(route('user.list', absolute: false));
    }
}
