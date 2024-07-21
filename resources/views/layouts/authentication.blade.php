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
            <div class="w-full md:w-1/2">

                <div class="min-h-[100dvh] h-full flex flex-col after:flex-1">

                    <!-- Header -->
                    <div class="flex-1">
                        <div class="flex items-center justify-between h-16 px-4 my-12 sm:px-6 lg:px-8">
                            <!-- Logo -->
                            <a class="block" href="{{ route('dashboard') }}">
                                <svg width="82" height="128" viewBox="0 0 82 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M0 -0.00127178V12.4516C4.82053 12.4516 9.44362 14.3692 12.8523 17.7827C16.2609 21.1961 18.1758 25.8257 18.1758 30.653C18.1758 35.4804 16.2609 40.11 12.8523 43.5234C9.44362 46.9368 4.82053 48.8545 0 48.8545V61.2999C4.05962 61.3633 8.09128 60.6174 11.8603 59.1055C15.6292 57.5937 19.0603 55.3461 21.9535 52.4936C24.8468 49.6412 27.1444 46.2408 28.7128 42.4906C30.2812 38.7404 31.0889 34.7151 31.0889 30.6493C31.0889 26.5835 30.2812 22.5583 28.7128 18.808C27.1444 15.0578 24.8468 11.6574 21.9535 8.80496C19.0603 5.9525 15.6292 3.70492 11.8603 2.19306C8.09128 0.681207 4.05962 -0.0647211 0 -0.00127178Z" fill="white" />
                                        <path d="M10.3628 79.9655V73.7465H13.4045V89.0662H10.3628V82.7651H3.04173V89.0662H0V73.7465H3.04173V79.9655H10.3628Z" fill="white" />
                                        <path d="M16.1108 89.0662V73.7465H27.4204V76.5462H19.1526V79.9655H26.6078V82.7651H19.1526V86.2665H27.4204V89.0662H16.1108Z" fill="white" />
                                        <path d="M43.2998 89.0662V73.7465H54.6169V76.5462H46.3415V79.9655H53.7968V82.7651H46.3415V86.2665H54.6169V89.0662H43.2998Z" fill="white" />
                                        <path d="M30.1936 89.0662V73.7465H33.2353V86.2665H41.0782V89.0662H30.1936Z" fill="white" />
                                        <path d="M60.2456 73.7465L68.1109 84.2732V73.7465H71.093V89.0662H68.2153L60.3649 78.5395V89.0662H57.3828V73.7465H60.2456Z" fill="white" />
                                        <path d="M14.478 108.537V93.2172H25.7876V96.0168H17.5197V99.4361H24.975V102.236H17.5197V105.737H25.7951V108.537H14.478Z" fill="white" />
                                        <path d="M54.8853 108.537V93.2172H66.1948V96.0168H57.9195V99.4361H65.3748V102.236H57.9195V105.737H66.1948V108.537H54.8853Z" fill="white" />
                                        <path d="M28.613 108.537V93.2172H31.6846V105.737H39.5275V108.537H28.613Z" fill="white" />
                                        <path d="M41.7493 108.537V93.2172H44.791V105.737H52.6339V108.537H41.7493Z" fill="white" />
                                        <path d="M7.21665 99.996L13.9264 108.537H10.2435L5.18883 102.124L3.02682 104.416V108.537H0V93.2172H3.04918V100.466L9.89307 93.2172H13.6207L7.21665 99.996Z" fill="white" />
                                        <path d="M78.3694 103.214C79.3738 102.86 80.2443 102.204 80.8611 101.335C81.4779 100.466 81.8107 99.4272 81.8137 98.361C81.8097 96.998 81.2673 95.6919 80.3048 94.7281C79.3424 93.7643 78.0382 93.2211 76.677 93.2172H69.0205V108.537H72.0697V103.505H75.186L78.5483 108.537H82.0075L78.3694 103.214ZM76.431 100.705H72.0697V96.0168H76.4161C76.7235 96.0168 77.0279 96.0774 77.3119 96.1953C77.596 96.3131 77.854 96.4857 78.0714 96.7034C78.2888 96.9211 78.4612 97.1795 78.5788 97.4639C78.6965 97.7484 78.7571 98.0532 78.7571 98.361C78.7571 98.6689 78.6965 98.9737 78.5788 99.2581C78.4612 99.5426 78.2888 99.801 78.0714 100.019C77.854 100.236 77.596 100.409 77.3119 100.527C77.0279 100.645 76.7235 100.705 76.4161 100.705H76.431Z" fill="white" />
                                        <path d="M1.28975 127.993H0V112.688H1.28975V127.993Z" fill="white" />
                                        <path d="M7.19437 112.688L17.4677 125.954V112.688H18.7276V127.993H17.5721L7.30619 114.733V127.993H6.03882V112.688H7.19437Z" fill="white" />
                                        <path d="M33.7721 113.905H28.4118V127.993H27.122V113.905H21.7617V112.688H33.7721V113.905Z" fill="white" />
                                        <path d="M36.8064 127.993V112.688H38.0887V126.768H46.9604V127.993H36.8064Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="82" height="128" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </a>
                        </div>
                    </div>

                    <div class="max-w-sm mx-auto w-full px-4 py-8">
                        {{ $slot }}
                    </div>

                </div>

            </div>

            <!-- Image -->
            <div class="hidden md:block absolute top-0 bottom-0 right-0 md:w-1/2" aria-hidden="true">
                <img class="object-cover object-center w-full h-full" src="{{ asset('images/login-banner.jpg') }}" width="760" height="1024" alt="Authentication image" />
            </div>

        </div>

    </main>

    @livewireScriptConfig
</body>

</html>