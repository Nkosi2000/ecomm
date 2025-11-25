<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Admin Login — Buggxit Couture</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-black flex items-center justify-center font-[WalkwayRounded]">
    <div class="bg-white w-full max-w-md p-8 rounded-xl shadow-xl">
        <div class="text-center mb-6">
            <img src="{{ asset('logo.png') }}" alt="Buggxit Couture" class="h-12 mx-auto mb-2">
            <h1 class="text-2xl font-bold uppercase text-[rgb(193,146,43)]">Admin Login</h1>
        </div>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-[rgb(193,146,43)]">
            </div>
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center text-gray-700 text-sm">
                    <input type="checkbox" name="remember" class="mr-2"> Remember me
                </label>
                <a href="{{ route('admin.password.request') }}" class="text-sm text-[rgb(193,146,43)] hover:text-black">Forgot password?</a>
            </div>
            <button type="submit"
                    class="w-full bg-[rgb(193,146,43)] text-black py-2 rounded-lg hover:bg-black hover:text-white transition">
                Login
            </button>
        </form>
    </div>
</body>
</html>