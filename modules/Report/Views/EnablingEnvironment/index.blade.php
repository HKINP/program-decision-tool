<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
       
        <div class="mt-10">
            <div class="flex justify-between">
                <!-- Step 1 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a href="{{ route('prioritizedActivities.index', ['stageId' => 5, 'did' => $districtprofile->id]) }}"
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-2x fa-solid fa-arrow-left"></i>
                        </div>
                        <div
                            class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step 5</h2>
                            <p class="text-xs text-gray-600">Food Systems Activities </p>
                        </div>
                    </a>
                </div>
                <!-- Step 1 End -->
                

                <!-- Step 3 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a href="{{ route('dataentrystage.create', ['stageId' => 7, 'did' => $districtprofile->id]) }}"
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                           <i class="text-white fa-2x fa-solid fa-arrow-right"></i>
                        </div>
                        <div
                            class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step 7.</h2>
                            <p class="text-xs text-gray-600">Compiled Workplan</p>
                        </div>
                    </a>
                </div>
                <!-- Step 3 End -->
            </div>
        </div>
          <!-- Heading and Edit Button -->
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Step 6. Enabling Environment Activities (IR4) </h2>
            <form action="{{ route('stages.resetStatus') }}" method="Post">
                @csrf
                <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                <input type="number" name="stage_id" value="6" hidden>
                <button type="submit"
                    class="btn bg-[#844a8a] text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white px-4 py-2 flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span class="max-xs:sr-only">Edit</span>
                </button>
            </form>
            
        </div>
       
        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />

            {{-- <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05
                    </p>
                    <p class="font-semibold text-md text-blue-600">Key Barriers</p>
                </div>

                <div class="space-y-2 text-xs italic">
                    <textarea id="key_barriers" name="key_barriers" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your notes here...">{{ $stepRemarks->key_barriers }}</textarea>

                </div>
            </div> --}}


            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06
                    </p>
                    <p class="font-semibold text-md text-blue-600">Activities</p>
                </div>

                <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                    <thead class="rounded-lg">
                        <tr>
                 
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Activities for Year 1</th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Delivery Platforms</th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="border border-gray-300 p-2 font-bold">All Children</td>
                        </tr>
                        @foreach ($allActivities as $activity)
                        <tr>
                            <td class="border border-gray-300 p-2 text-sm">{{ $activity->activity->activities ?? '' }}</td>
                            <td class="border border-gray-300 p-2 text-sm">
                                <ul class="list-none space-y-1">
                                    @foreach($activity->platforms as $platform)
                                        <li class="">
                                            - {{ $platform->platforms }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="border border-gray-300 p-2 text-sm">{{ $activity->remarks }}</td>
                        </tr>
                        @endforeach
                @if ($vulnerableActivities)
                    
                @endif
                        <tr>
                            <td colspan="6" class="border border-gray-300 p-2 font-bold">Vulnerable</td>
                        </tr>
                        @foreach ($vulnerableActivities as $activity)
                        
                            <tr>
                                <td class="border border-gray-300 p-2 text-sm">{{ $activity->activity->activities ?? '' }}</td>
                                <td class="border border-gray-300 p-2 text-sm">
                                    <ul class="list-none space-y-1">
                                        @foreach($activity->platforms as $platform)
                                            <li class="">
                                                - {{ $platform->platforms }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border border-gray-300 p-2 text-sm">{{ $activity->remarks }}</td>
                            </tr>
                        @endforeach
                
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">07
                    </p>
                    <p class="font-semibold text-md text-blue-600">Notes</p>
                </div>

                <div class="space-y-2 text-xs italic">
                    <textarea id="notes" name="notes" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your notes here...">{{ $stepRemarks->notes }}</textarea>
                </div>
            </div>

        
    </div>




</x-app-layout>
