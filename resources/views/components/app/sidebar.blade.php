<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak></div>

    <!-- Sidebar -->
    <div
        id="sidebar"
        class="flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:-translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-20 lg:w-20 lg:sidebar-expanded:!w-72 shrink-0 bg-[#844a8a] dark:bg-gray-800 p-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200 dark:border-gray-700/60' : 'rounded-r-2xl shadow-sm' }}"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false">

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <!-- <a class="block" href="{{ route('dashboard') }}">
                <svg width="auto" height="128" viewBox="0 0 82 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M0 -0.00127178V12.4516C4.82053 12.4516 9.44362 14.3692 12.8523 17.7827C16.2609 21.1961 18.1758 25.8257 18.1758 30.653C18.1758 35.4804 16.2609 40.11 12.8523 43.5234C9.44362 46.9368 4.82053 48.8545 0 48.8545V61.2999C4.05962 61.3633 8.09128 60.6174 11.8603 59.1055C15.6292 57.5937 19.0603 55.3461 21.9535 52.4936C24.8468 49.6412 27.1444 46.2408 28.7128 42.4906C30.2812 38.7404 31.0889 34.7151 31.0889 30.6493C31.0889 26.5835 30.2812 22.5583 28.7128 18.808C27.1444 15.0578 24.8468 11.6574 21.9535 8.80496C19.0603 5.9525 15.6292 3.70492 11.8603 2.19306C8.09128 0.681207 4.05962 -0.0647211 0 -0.00127178Z" fill="white"></path>
                        <path d="M10.3628 79.9655V73.7465H13.4045V89.0662H10.3628V82.7651H3.04173V89.0662H0V73.7465H3.04173V79.9655H10.3628Z" fill="white"></path>
                        <path d="M16.1108 89.0662V73.7465H27.4204V76.5462H19.1526V79.9655H26.6078V82.7651H19.1526V86.2665H27.4204V89.0662H16.1108Z" fill="white"></path>
                        <path d="M43.2998 89.0662V73.7465H54.6169V76.5462H46.3415V79.9655H53.7968V82.7651H46.3415V86.2665H54.6169V89.0662H43.2998Z" fill="white"></path>
                        <path d="M30.1936 89.0662V73.7465H33.2353V86.2665H41.0782V89.0662H30.1936Z" fill="white"></path>
                        <path d="M60.2456 73.7465L68.1109 84.2732V73.7465H71.093V89.0662H68.2153L60.3649 78.5395V89.0662H57.3828V73.7465H60.2456Z" fill="white"></path>
                        <path d="M14.478 108.537V93.2172H25.7876V96.0168H17.5197V99.4361H24.975V102.236H17.5197V105.737H25.7951V108.537H14.478Z" fill="white"></path>
                        <path d="M54.8853 108.537V93.2172H66.1948V96.0168H57.9195V99.4361H65.3748V102.236H57.9195V105.737H66.1948V108.537H54.8853Z" fill="white"></path>
                        <path d="M28.613 108.537V93.2172H31.6846V105.737H39.5275V108.537H28.613Z" fill="white"></path>
                        <path d="M41.7493 108.537V93.2172H44.791V105.737H52.6339V108.537H41.7493Z" fill="white"></path>
                        <path d="M7.21665 99.996L13.9264 108.537H10.2435L5.18883 102.124L3.02682 104.416V108.537H0V93.2172H3.04918V100.466L9.89307 93.2172H13.6207L7.21665 99.996Z" fill="white"></path>
                        <path d="M78.3694 103.214C79.3738 102.86 80.2443 102.204 80.8611 101.335C81.4779 100.466 81.8107 99.4272 81.8137 98.361C81.8097 96.998 81.2673 95.6919 80.3048 94.7281C79.3424 93.7643 78.0382 93.2211 76.677 93.2172H69.0205V108.537H72.0697V103.505H75.186L78.5483 108.537H82.0075L78.3694 103.214ZM76.431 100.705H72.0697V96.0168H76.4161C76.7235 96.0168 77.0279 96.0774 77.3119 96.1953C77.596 96.3131 77.854 96.4857 78.0714 96.7034C78.2888 96.9211 78.4612 97.1795 78.5788 97.4639C78.6965 97.7484 78.7571 98.0532 78.7571 98.361C78.7571 98.6689 78.6965 98.9737 78.5788 99.2581C78.4612 99.5426 78.2888 99.801 78.0714 100.019C77.854 100.236 77.596 100.409 77.3119 100.527C77.0279 100.645 76.7235 100.705 76.4161 100.705H76.431Z" fill="white"></path>
                        <path d="M1.28975 127.993H0V112.688H1.28975V127.993Z" fill="white"></path>
                        <path d="M7.19437 112.688L17.4677 125.954V112.688H18.7276V127.993H17.5721L7.30619 114.733V127.993H6.03882V112.688H7.19437Z" fill="white"></path>
                        <path d="M33.7721 113.905H28.4118V127.993H27.122V113.905H21.7617V112.688H33.7721V113.905Z" fill="white"></path>
                        <path d="M36.8064 127.993V112.688H38.0887V126.768H46.9604V127.993H36.8064Z" fill="white"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="82" height="128" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </a> -->
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>

                <ul class="mt-3">
                    <!-- Dashboard -->

                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if(in_array(Request::segment(1), ['dashboard'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif">
                        <a class="block text-white dark:text-gray-100 truncate transition @if(!in_array(Request::segment(1), ['dashboard'])){{ 'hover:text-gray-500 dark:hover:text-white' }}@endif" href="{{ route('dashboard') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if(in_array(Request::segment(1), ['dashboard'])){{ 'text-white' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8 8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6 6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z" />
                                    <path d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1 0 0 0-1.414 1.414l3.775 3.775Z" />
                                </svg>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    @can('manage-data-entry')
                       <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if(in_array(Request::segment(1), ['district','role','permission'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['user','role','permission']) ? 1 : 0 }} }">
                        <a class="block text-white dark:text-gray-100 truncate transition @if(!in_array(Request::segment(1), ['user','role','permission'])){{ 'hover:text-[#f87c56] dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    
                                <svg class="shrink-0 fill-current @if(in_array(Request::segment(1), ['steplist'])){{ 'text-white' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path d="M12 0c-.553 0-1 .448-1 1v10h-10c-.552 0-1 .448-1 1s.448 1 1 1h10v10c0 .552.447 1 1 1s1-.448 1-1v-10h10c.552 0 1-.448 1-1s-.448-1-1-1h-10v-10c0-.552-.447-1-1-1z" />
                                </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Activity Entry</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 mr-2  lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if(in_array(Request::segment(1), ['steplist','districtactivities','provinceactivitis',''])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>                
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['user','role','permission'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                @can('manage-data-entryr')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('steplist.create')){{ '!text-[#f87c56]' }}@endif" href="{{ route('steplist.create') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">District</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('role.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('role.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Province</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('permission.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('permission.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Federal</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.ir')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.ir') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Intermediate Result</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.program')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.program') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Program management</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.finance')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.finance') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Finance and Operations</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.gid')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.gid') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">GID Plan</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.merl')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.merl') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">MMEL Plan</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.rsr')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.rsr') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">EPRR Plan
                                        </span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-data-entry')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.diverse')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.diverse') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Diverse Partnerships Plan
                                        </span>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                        </li>
                    @endif
                    @can('manage-user-configuration')
                    <!-- User Configuration -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if(in_array(Request::segment(1), ['user','role','permission'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['user','role','permission']) ? 1 : 0 }} }">
                        <a class="block text-white dark:text-gray-100 truncate transition @if(!in_array(Request::segment(1), ['user','role','permission'])){{ 'hover:text-[#f87c56] dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if(in_array(Request::segment(1), ['user','role','permission'])){{ 'text-white' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M9 6.855A3.502 3.502 0 0 0 8 0a3.5 3.5 0 0 0-1 6.855v1.656L5.534 9.65a3.5 3.5 0 1 0 1.229 1.578L8 10.267l1.238.962a3.5 3.5 0 1 0 1.229-1.578L9 8.511V6.855ZM6.5 3.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm4.803 8.095c.005-.005.01-.01.013-.016l.012-.016a1.5 1.5 0 1 1-.025.032ZM3.5 11c.474 0 .897.22 1.171.563l.013.016.013.017A1.5 1.5 0 1 1 3.5 11Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">User Configuration</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 mr-2  lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if(in_array(Request::segment(1), ['user','role','permission'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['user','role','permission'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                @can('manage-user')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('user.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('user.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Users</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-role')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('role.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('role.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Roles</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-permission')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('permission.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('permission.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Permissions</span>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </li>
                    @endif
                    @can('manage-system-configuration')
                    <!-- Community -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if(in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities']) ? 1 : 0 }} }">
                        <a class="block text-white dark:text-gray-100 truncate transition @if(!in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities'])){{ 'hover:text-[#f87c56] dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if(in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities'])){{ 'text-white' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M12 1a1 1 0 1 0-2 0v2a3 3 0 0 0 3 3h2a1 1 0 1 0 0-2h-2a1 1 0 0 1-1-1V1ZM1 10a1 1 0 1 0 0 2h2a1 1 0 0 1 1 1v2a1 1 0 1 0 2 0v-2a3 3 0 0 0-3-3H1ZM5 0a1 1 0 0 1 1 1v2a3 3 0 0 1-3 3H1a1 1 0 0 1 0-2h2a1 1 0 0 0 1-1V1a1 1 0 0 1 1-1ZM12 13a1 1 0 0 1 1-1h2a1 1 0 1 0 0-2h-2a3 3 0 0 0-3 3v2a1 1 0 1 0 2 0v-2Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">System Configuration</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 mr-2  lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if(in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['targetgroup','thematicarea','province','district','stages','questions','platforms','activities'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                @can('manage-target-groups')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('targetgroup.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('targetgroup.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Target Groups</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-thematic-areas')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('thematicarea.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('thematicarea.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Thematic Areas</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-province')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('province.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('province.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Province</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-district')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('district.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('district.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">District</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-stage')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('stages.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('stages.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Stages</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-question')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('question.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('question.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Questions</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-platforms')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('platform.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('platform.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Platforms</span>
                                    </a>
                                </li>
                                @endif
                                @can('manage-activities')
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.index')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.index') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Activities</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif
                    @can('manage-report')
                    <!-- Finance -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if(in_array(Request::segment(1), ['finance'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['finance']) ? 1 : 0 }} }">
                        <a class="block text-white dark:text-gray-100 truncate transition @if(!in_array(Request::segment(1), ['finance'])){{ 'hover:text-[#f87c56] dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if(in_array(Request::segment(1), ['finance'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M6 0a6 6 0 0 0-6 6c0 1.077.304 2.062.78 2.912a1 1 0 1 0 1.745-.976A3.945 3.945 0 0 1 2 6a4 4 0 0 1 4-4c.693 0 1.344.194 1.936.525A1 1 0 1 0 8.912.779 5.944 5.944 0 0 0 6 0Z" />
                                        <path d="M10 4a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm-4 6a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Reports</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 mr-2  lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if(in_array(Request::segment(1), ['finance'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if(!in_array(Request::segment(1), ['finance'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-white dark:text-gray-400 hover:text-[#f87c56] dark:hover:text-gray-200 transition truncate @if(Route::is('activities.workPlan')){{ '!text-[#f87c56]' }}@endif" href="{{ route('activities.workPlan') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Workplan</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex justify-end mt-auto">
            <div class="w-12 pl-4 pr-3 py-2">
                <button class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors" @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 sidebar-expanded:rotate-180" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>