<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Password Reset</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Forgot Password</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded px-3 py-2" required autofocus>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-[rgb(193,146,43)] text-black py-2 rounded hover:bg-black hover:text-white transition">
                Send Reset Link
            </button>
        </form>
    </div>
</body>
</html>