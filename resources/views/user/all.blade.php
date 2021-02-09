<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    @if(count($users))
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="text-left">ID</th>
                                    <th class="text-left">{{ __('Name') }}</th>
                                    <th class="text-left">{{ __('E-mail') }}</th>
                                    <th class="text-left">{{ __('DOB') }}</th>
                                    <th class="text-left">{{ __('Role') }}</th>
                                    <th class="text-left">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->dob }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td><a href="{{ url('/user') }}/{{ $user->id }}/edit">Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>