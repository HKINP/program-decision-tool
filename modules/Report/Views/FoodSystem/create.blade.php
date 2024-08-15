<x-app-layout>
    <div class="px-4  sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8 rounded-lg w-full mb-5">
            <div class="flex items-center gap-4 text-2xl ">
                <!-- First Arrow -->
                <div class="border bg-white p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </div>

                <!-- Step Description -->
                <p class="font-semibold text-[24px]">Step 5. Food Systems Activities</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-base italic">
                <p>1) Ask participants what food systems-level barriers contribute to the indicators selected. Then identify platforms and how they can strengthen the platforms to help overcome the barriers.
                </p>
                <p class="mb-2">2) Once participants have identified activities for everyone in their district, consider how they might change for vulnerable populations. Given the year 1 implementation duration of 4-6 months, try to limit the number of activities to 5-7 for this
step. Select management-level activities as necessary.</p>
            </div>
        </div>
        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />
        <x-activities-add-form :stage-id="5" :district-profile="$districtprofile" :priorities="$priorities" :platforms="$platforms" />


    </div>
    
</x-app-layout>