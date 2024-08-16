<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Program Decision Tool') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Styles -->
    @livewireStyles

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }
    </script>

</head>

<body class="font-inter antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400">

    <main class="relative flex items-center justify-center min-h-screen">

        <!-- Full-width Background Image -->
        <img class="absolute inset-0 object-cover w-full h-full z-0" src="{{ asset('images/login-banner.jpg') }}" alt="Authentication image" />

        <!-- Content Section -->
        <div class="relative z-10 p-8 bg-white rounded-lg shadow-lg text-white max-w-lg w-full mx-auto text-center">

            <!-- Header with Logos -->
            <div class="flex justify-center space-x-4 mb-8">
                <img class="h-10 object-cover" src="{{ asset('images/USAID.jpg') }}" alt="USAID Logo" />
                <img class="h-8 object-cover" src="{{ asset('images/HKIntl.jpg') }}" alt="Helen Keller Intl Logo" />
            </div>

            <!-- Main Content (Slot) -->
            <div class="text-lg mb-8">
                {{ $slot }}
            </div>

            <!-- Footer with Additional Logos -->
            <div class="flex justify-center space-x-4">
                <img class="h-10 object-cover" src="{{ asset('images/FHI360.jpg') }}" alt="FHI360 Logo" />
                <img class="h-10 object-cover" src="{{ asset('images/CEAPRED.jpg') }}" alt="CEAPRED Logo" />
                <img class="h-10 object-cover" src="{{ asset('images/ENPHO.jpg') }}" alt="ENPHO Logo" />
                <img class="h-10 object-cover" src="{{ asset('images/NTAG.jpg') }}" alt="NTAG Logo" />
                <img class="h-6 object-cover" src="{{ asset('images/Kaboom.jpg') }}" alt="Kaboom Logo" />
            </div>
            
        </div>

        <div class="absolute inset-x-0 bottom-0 flex flex-col justify-end p-4 text-white bg-black bg-opacity-50 text-sm">
            <!-- Disclaimer -->
            <p class="text-center mb-2">
                This System is made possible by the generous support of the American people through the United States Agency for International Development (USAID). The contents are the responsibility of Helen Keller Intl and do not necessarily reflect the views of USAID or the United States government.
            </p>

            <!-- Copyright and Links -->
            <div class="flex justify-between items-center text-center">
                <p>&copy; {{ date('Y') }} Helen Keller Intl. All rights reserved.</p>
                <div class="space-x-4">
                    <a href="#" class="hover:underline">Terms of Service</a>
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Contact Us</a>
                </div>
            </div>
        </div>

    </main>

    @livewireScriptConfig
</body>

</html>
