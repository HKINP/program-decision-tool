<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="mt-10">
            <div class="flex justify-between">
                <!-- Step 1 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a href="{{ route('steplist.create', ['did' => $districtprofile->id]) }}"
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-lg fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step List</h2>
                            <p class="text-xs text-gray-600">{{ $districtprofile->district }} </p>
                        </div>
                    </a>
                </div>
                <!-- Step 1 End -->

                <!-- Step 3 -->
                <div class="w-1/3 text-center mb-6">
                    <a
                        @if ($prioritystatus==1)
                        href="{{ route('priority.index', ['stageId' => 2, 'did' => $districtprofile->id]) }}"
                        @else
                        href="{{ route('dataentrystage.create', ['stageId' => 2, 'did' => $districtprofile->id]) }}"
                        @endif
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-lg fa-solid fa-arrow-right"></i>
                        </div>
                        <div class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-2 rounded-r-lg">
                            <h2 class="font-bold text-sm">Step 2</h2>
                            <p class="text-xs text-gray-600">Prioritize Indicators for Year 1</p>
                        </div>
                    </a>

                </div>
                <!-- Step 3 End -->
            </div>
        </div>


        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Step 1. District Context</h2>
            <a href="#"
                class="btn bg-[#844a8a] text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white px-4 py-2 flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span class="max-xs:sr-only">Edit</span>
            </a>
        </div>
        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                <p class="font-semibold text-md text-blue-600">Notes</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your notes here...">{{ $stepRemarks->notes ?? "" }}</textarea>
            </div>
        </div>
</x-app-layout>