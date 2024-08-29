<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">District Compiled Report</h2>
        </div>

        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">Province:</span>
                        <span class="text-black">{{ $districtprofile->province->province ?? 'All Provinces' }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">District:</span>
                        <span class="text-black">{{ $districtprofile->district ?? 'All Districts' }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4 no-print">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
                <p class="font-semibold text-md text-blue-600">Activities</p>
            </div>

            <table class="min-w-full border-collapse border border-gray-300">
                <!-- Header Section -->
                <thead>
                    <tr class="bg-purple-800 text-white">
                        <th class="text-sm border border-gray-300 p-2 text-center w-12">#</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">Activities</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">All/Targeted</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">District</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">Target</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">Unit</th>
                        <th class="text-sm border border-gray-300 p-2 text-center">Responsible Partner</th>
                        <th class="border border-gray-300 p-2 text-center">Jul</th>
                        <th class="border border-gray-300 p-2 text-center">Aug</th>
                        <th class="border border-gray-300 p-2 text-center">Sept</th>
                        <th class="border border-gray-300 p-2 text-center">Oct</th>
                        <th class="border border-gray-300 p-2 text-center">Nov</th>
                        <th class="border border-gray-300 p-2 text-center">Dec</th>
                        <th class="border border-gray-300 p-2 text-center">Jan</th>
                        <th class="border border-gray-300 p-2 text-center">Feb</th>
                        <th class="border border-gray-300 p-2 text-center">Mar</th>
                        <th class="border border-gray-300 p-2 text-center">Apr</th>
                        <th class="border border-gray-300 p-2 text-center">May</th>
                        <th class="border border-gray-300 p-2 text-center">Jun</th>
                        <th class="border border-gray-300 p-2 text-center">Budget</th>
                    </tr>
                </thead>
                <!-- Body Section -->
                <tbody>
                    <!-- Iterate over IRs -->
                    @foreach ($data as $irId => $irOutcomes)
                        <!-- Display IR Header -->
                        <tr class="bg-purple-600 text-white font-semibold">
                            <td colspan="19" class="border border-gray-300 text-sm p-2 text-left">
                                @if ($irId == 1)
                                    IR 1. Improve household nutrition practices
                                @elseif ($irId == 2)
                                    IR 2. Improved coverage and quality of nutrition
                                    services
                                @elseif ($irId == 3)
                                    IR 3. Improve access to safe, diverse, and
                                    nutritious foods
                                @elseif ($irId == 4)
                                    IR 4. Strengthen GON capacity for multi-sectoral
                                    nutrition programming
                                @endif
                            </td>
                        </tr>

                        <!-- Iterate over Outcomes -->
                        @foreach ($irOutcomes as $outcomeGroup)
                            @foreach ($outcomeGroup as $outcome)
                                <!-- Display Outcome Header -->
                                <tr class="bg-gray-200 font-semibold">
                                    <td colspan="19" class="border border-gray-300 p-2 text-left text-sm">
                                        {{ $outcome['outcome']['outcome'] }}
                                    </td>
                                </tr>

                                <!-- Iterate over Activities -->
                                @foreach ($outcome['activities'] as $index => $activity)
                                    @php
                                        // Filter the array where 'targeted_for' is 'All'
                                        $allTargetedActivities = array_filter(
                                            $activity['activity']['priorities_activities'],
                                            function ($item) {
                                                return $item['targeted_for'] === 'All';
                                            },
                                        );

                                        // Filter the array where 'targeted_for' is 'Vulnerable'
                                        $vulnerableTargetedActivities = array_filter(
                                            $activity['activity']['priorities_activities'],
                                            function ($item) {
                                                return $item['targeted_for'] === 'Vulnerable';
                                            },
                                        );

                                        // Count the number of occurrences
                                        $countAllTargeted = count($allTargetedActivities);
                                        
                                        $countVulnerableTargeted = count($vulnerableTargetedActivities);
                                    @endphp

                                    <tr>
                                        <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ $activity['activity']['activities'] }}</td>
                                        <td class="border border-gray-300 p-2 text-sm">{{ $countAllTargeted }}/{{ $countVulnerableTargeted }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ count($activity['activity']['priorities_activities']) ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            </td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ $activity['activity']['unit'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ $activity['activity']['responsible_partner'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['jul'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['aug'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['sept'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['oct'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['nov'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['dec'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['jan'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['feb'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['mar'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['apr'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['may'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">{{ $activity['activity']['jun'] ?? '' }}</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $activity['activity']['budget'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>


</x-app-layout>
0
