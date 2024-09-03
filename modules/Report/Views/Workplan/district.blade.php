<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">District Compiled Report</h2>
        </div>
        <!-- Search Section -->
        <div class="bg-white p-4 rounded-lg mb-5 border border-[#D8DAE5]">
            <form action="{{ route('workPlanReport.index') }}" method="GET" class="flex gap-4 mb-4">
                <!-- Province Select -->
                <div class="flex-1">
                    <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                    <select id="pid" name="pid"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Province</option>
                        @foreach ($provinces as $provincelist)
                            <option value="{{ $provincelist->id }}" @if (request('pid') == $provincelist->id) selected @endif>
                                {{ $provincelist->province }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- District Select -->
                <div class="flex-1">
                    <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                    <select id="did" name="did"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" @if (request('did') == $district->id) selected @endif>
                                {{ $district->district }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Search Button -->
                <div class="flex items-end">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Search
                    </button>
                </div>
            </form>
        </div>
        


        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">Province:</span>                      
                        <span class="text-black">{{ $province->province ?? 'All Provinces' }}</span>
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

            <table class="min-w-full border-collapse border  divide-y divide-gray-200 border-gray-300">
                <!-- Header Section -->
                <thead>
                    <tr class="bg-purple-800 text-white">
                        <th class="text-xs border border-gray-300 p-2 text-center w-12">#</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Activities</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">All/Targeted</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">District</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Target</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Unit</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Responsible Partner</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Jul</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Aug</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Sept</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Oct</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Nov</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Dec</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Jan</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Feb</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Mar</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Apr</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">May</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Jun</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Budget</th>
                    </tr>
                </thead>
                <!-- Body Section -->
                <tbod class="divide-y divide-gray-200">
                    <!-- Iterate over IRs -->
                    @foreach ($data as $irId => $irOutcomes)
                        <!-- Display IR Header -->
                        <tr class="bg-purple-600 text-white font-semibold">
                            <td colspan="19" class="border border-gray-300 text-xs p-2 text-left">
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
                                    <td colspan="19" class="border border-gray-300 p-2 text-left text-xs">
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
                                        $totalSum = collect($activity['activity']['priorities_activities'])
                                            ->filter(function ($item) {
                                                return is_numeric($item['total_target']);
                                            })
                                            ->sum('total_target');
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

                                        // Array of all months with corresponding table header abbreviations
                                        $months = [
                                            'jul' => 'July',
                                            'aug' => 'August',
                                            'sept' => 'September',
                                            'oct' => 'October',
                                            'nov' => 'November',
                                            'dec' => 'December',
                                            'jan' => 'January',
                                            'feb' => 'February',
                                            'mar' => 'March',
                                            'apr' => 'April',
                                            'may' => 'May',
                                            'jun' => 'June',
                                        ];

                                        // Initialize an array to hold the presence status of each month
                                        $monthPresence = array_fill_keys(array_keys($months), false);

                                        // Loop through each `priorities_activities` item
                                        foreach (
                                            $activity['activity']['priorities_activities']
                                            as $priorities_activity
                                        ) {
                                            // Ensure 'months' is processed as an array
                                            $activityMonths = json_decode($priorities_activity['months'], true);
                                            if (!is_array($activityMonths)) {
                                                $activityMonths = [];
                                            }

                                            // Check if each month is present in the `months` array
                                            foreach ($months as $key => $month) {
                                                if (in_array($month, $activityMonths)) {
                                                    $monthPresence[$key] = true;
                                                }
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">
                                            {{ $activity['activity']['activities'] ?? '' }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">

                                            All-{{ $countAllTargeted }},
                                            Targeted-{{ $countVulnerableTargeted }}


                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">
                                            {{ count($activity['activity']['priorities_activities']) ?? '' }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">{{ $totalSum ?? '' }}</td>
                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">
                                            {{ $activity['activity']['unit'] ?? '' }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-xs">
                                            {{ $activity['activity']['partner'] ?? '' }}
                                        </td>

                                        @foreach ($months as $key => $month)
                                            <td class="border border-gray-300 p-2 text-center">
                                                @if ($monthPresence[$key])
                                                    <i
                                                        class="fas fa-check-circle text-green-500 text-xl p-2 rounded-full"></i>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
            </table>


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('pid');
            const districtSelect = document.getElementById('did');

            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                if (provinceId) {
                    fetch('{{ route('district.getdistrictbyprovince') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                provinceIds: [provinceId]
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            districtSelect.innerHTML = '<option value="">Select District</option>';
                            data.districts.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.district;
                                districtSelect.appendChild(option);
                            });

                            // Re-select the district if already selected in the request
                            const selectedDistrict = "{{ request('did') }}";
                            if (selectedDistrict) {
                                districtSelect.value = selectedDistrict;
                            }
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                } else {
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                }
            });

            // Trigger the change event to load districts if a province was selected
            if (provinceSelect.value) {
                provinceSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>
