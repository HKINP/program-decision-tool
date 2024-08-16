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

    <main class="bg-[#7d3c80] dark:bg-gray-900">

        <div class="relative flex">

            <!-- Content -->
            <div class="h-full md:w-1/2">

                <div class="min-h-[100dvh] h-full flex flex-col justify-between">

                    <!-- Header -->
                    <div class="flex-1">
                        <div class="flex items-center justify-evenly h-16 px-4 py-12 sm:px-6 lg:px-8 bg-white">
                            <!-- Logos -->
                            <img class="object-cover object-center h-20" src="{{ asset('images/USAID.jpg') }}" alt="USAID Logo" />
                            <img class="object-cover object-center h-16" src="{{ asset('images/HKIntl.jpg') }}" alt="Helen Keller Intl Logo" />
                        </div>
                    </div>

                    <div class="max-w-sm mx-auto w-full px-4 py-8 grow">
                        {{ $slot }}
                    </div>

                    <div>
                        <div class="flex items-center justify-evenly h-16 px-4 py-12 sm:px-6 lg:px-8 bg-white">
                            <img class="object-cover object-center h-16" src="{{ asset('images/FHI360.jpg') }}" alt="FHI360 Logo" />
                            <img class="object-cover object-center h-16" src="{{ asset('images/CEAPRED.jpg') }}" alt="CEAPRED Logo" />
                            <img class="object-cover object-center h-16" src="{{ asset('images/ENPHO.jpg') }}" alt="ENPHO Logo" />
                            <img class="object-cover object-center h-16" src="{{ asset('images/NTAG.jpg') }}" alt="NTAG Logo" />
                            <img class="object-cover object-center h-8" src="{{ asset('images/Kaboom.jpg') }}" alt="Kaboom Logo" />
                        </div>
                    </div>

                </div>

            </div>

            <!-- Image Section with Overlay -->
            <div class="hidden md:block relative md:w-1/2">
                <img class="object-cover object-center w-full h-full" src="{{ asset('images/login-banner.jpg') }}" width="760" height="1024" alt="Authentication image" />
                <div class="absolute inset-0 flex flex-col justify-between p-8 text-white bg-black bg-opacity-50">
                    <!-- Title (top) -->
                    <h1 class="text-xl font-bold">USAID Integrated Nutrition Multisectoral Intervention Design Decision Tool
                    </h1>
                  
                </div>
                <!-- Footer Section with Copyright and Terms -->
                <div class="absolute inset-x-0 bottom-0 flex flex-col justify-end p-4 text-white bg-black bg-opacity-50 text-sm">
                    <!-- Disclaimer -->
                    <p class="text-left text-xs mb-4  ">
                        This System is made possible by the generous support of the American people through the United States Agency for International Development (USAID). The contents are the responsibility of Helen Keller Intl and do not necessarily reflect the views of USAID or the United States government.
                    </p>

                    <!-- Copyright and Links -->
                    <div class="flex justify-between items-center  text-center">
                        <p>&copy; {{ date('Y') }} Helen Keller Intl. All rights reserved.</p>
                        <div class="space-x-4">
                            <a href="#" class="hover:underline">Terms of Service</a>
                            <a href="#" class="hover:underline">Privacy Policy</a>
                            <a href="#" class="hover:underline">Contact Us</a>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    </main>

    @livewireScriptConfig
</body>

</html>