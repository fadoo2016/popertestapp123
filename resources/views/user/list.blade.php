<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('user list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
					<div><b><a href="{{ route('user.create') }}">Create New User</a></b></div>
					<hr/>
					<table style="width: 100%" cellspacing="1" align="center">
					<thead>
						<tr>
							<th>{{ __('User ID') }}</th>
							<th>{{ __('User Name') }}</th>
							<th>{{ __('Email') }}</th>
							<th>{{ __('User Role') }}</th>
							<th>{{ __('Operate') }}</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($users as $user)
						<tr>
							<td align="center">{{ $user->id }}</td>
							<td align="center">{{ $user->name }}</td>
							<td align="center">{{ $user->email }}</td>
							<td align="center">{{ $user->role }}</td>
							@if ($user->role === 'student')
							<td align="center">
								<b><a href="{{ route('user.edit',['user'=>$user->id]) }}">edit</a></b>
							</td>
							@endif
						</tr>
					@endforeach
					</tbody>
					</table>
					{{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
