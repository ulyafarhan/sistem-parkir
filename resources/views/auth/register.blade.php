@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="bg-blue-600 text-white text-center py-4 rounded-t-lg">
                <h2 class="text-xl font-semibold">📝 Register Petugas Baru</h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Petugas --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">
                            Nama Petugas
                        </label>
                        <input id="name" type="text" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('name') border-red-500 @enderror" 
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">
                            Email
                        </label>
                        <input id="email" type="email" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">
                            Password
                        </label>
                        <input id="password" type="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password') border-red-500 @enderror" 
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-gray-700 font-medium mb-2">
                            Konfirmasi Password
                        </label>
                        <input id="password-confirm" type="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
