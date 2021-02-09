<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <x-auth-card>
                        <x-slot name="logo">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </x-slot>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                            </div>

                            <!-- DOB -->
                            <div class="mt-4">
                                <x-label for="dob" :value="__('Date of birth')" />

                                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" value="{{ $user->dob }}" required />
                            </div>

                            <!-- Old Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Old password')" />

                                <x-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="new_password" :value="__('New Password')" />

                                <x-input id="new_password" class="block mt-1 w-full"
                                                type="password"
                                                name="new_password"
                                                required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="new_password_confirmation" :value="__('Confirm New Password')" />

                                <x-input id="new_password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="new_password_confirmation" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Update profile') }}
                                </x-button>
                            </div>
                        </form>
                    </x-auth-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>