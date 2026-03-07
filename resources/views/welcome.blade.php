<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clock In | Welcome</title>

    <link rel="icon" type="image/png" href="{{ asset('images/Clock In logo small.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: radial-gradient(circle at top center, #1e3a8a 0%, #020617 80%);
        }
    </style>
</head>
<body class="gradient-bg text-gray-100 antialiased selection:bg-blue-500 selection:text-white">

<div class="relative flex flex-col items-center justify-center min-h-screen overflow-hidden">

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-blue-500/20 blur-[120px] rounded-full"></div>

    <main class="relative z-10 text-center px-6">

        <div class="mb-10 flex justify-center">
            <img src="{{ asset('images/Clock In logo small.svg') }}"
                 alt="Clock In Logo"
                 class="h-24 w-auto brightness-0 invert opacity-90 hover:opacity-100 hover:scale-105 transition-all duration-500">
        </div>

        <div class="mb-6">
            <span class="px-3 py-1 text-xs font-bold tracking-widest uppercase border border-blue-500/30 bg-blue-500/10 text-blue-400 rounded-full">
                Official Platform
            </span>
        </div>

        <h1 class="text-8xl md:text-9xl font-extrabold tracking-tighter mb-4 bg-clip-text text-transparent bg-gradient-to-b from-white to-blue-200/50">
            Clock In
        </h1>

        <p class="text-lg md:text-xl text-blue-100/60 max-w-md mx-auto mb-12 leading-relaxed">
            Welcome to Clock In.
        </p>

        <div class="flex flex-col items-center justify-center gap-6">
            <a href="{{ route('filament.admin.auth.login') }}"
               class="group relative px-10 py-4 bg-blue-500 text-blue-950 font-bold rounded-xl hover:bg-blue-400 transition-all duration-300 shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_35px_rgba(59,130,246,0.5)] transform hover:-translate-y-1">
                Log in to Clock In
            </a>
        </div>

    </main>

    <footer class="absolute bottom-8 w-full text-center text-blue-900 font-medium uppercase tracking-widest text-xs">
        &copy; {{ date('Y') }} Clock In Systems
    </footer>

</div>

</body>
</html>
