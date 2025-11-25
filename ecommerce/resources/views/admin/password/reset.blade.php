<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Admin Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Reset Password</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded px-3 py-2" required autofocus>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">New Password</label>
                <input id="password" type="password" name="password"
                       class="w-full border rounded px-3 py-2" required>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit"
                    class="w-full bg-[rgb(193,146,43)] text-black py-2 rounded hover:bg-black hover:text-white transition">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>