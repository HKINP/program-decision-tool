<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">USAID Integrated Nutrition Year One Workplan (July 2024-June 2025)
            </h2>
        </div>




        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4 no-print">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Activities</p>
            </div>
            <button class="mb-2" onclick="exportTableToExcel('myTable', 'myExcelFile')">Export to Excel</button>

            <table class="min-w-full border-collapse border  divide-y divide-gray-200 border-gray-300">
                <!-- Header Section -->
                <thead>
                    <tr id="myTable" class="bg-purple-800 text-white">
                        <th class="text-xs border border-gray-300 p-2 text-center w-12">#</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Activities</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Targeted For</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Implementation at</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Province</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">District</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Responsible Partner</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Unit</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Target</th>
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
                <tbody class="divide-y divide-gray-200">

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Program Management
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetPA }}
                        </td>
                    </tr>
                    @foreach ($programactivities as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                        @endforeach
                    </tr>

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Finance and Operations
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetFAO }}
                        </td>
                    </tr>
                    @foreach ($financeandoperation as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                    </tr>
                    @endforeach

                    <!-- Iterate over Outcomes -->
                    @foreach ($irOutcomes as $irId => $irOutcomes)
                    <!-- Display IR Header -->
                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="22" class="border text-black font-bold border-gray-300 text-xs p-2 text-left">
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
                    @foreach ($irOutcomes as $outcomeGroup)
                    @foreach ($outcomeGroup as $outcome)
                    <tr class="bg-gray-200 ">
                        <td colspan="21" class="border border-gray-300 p-2 font-bold  text-black text-left text-xs">
                            {{ $outcome['outcome']['outcome'] }}
                        </td>
                    </tr>

                    <!-- Iterate over Activities -->
                    @foreach ($outcome['outcome']['activities'] as $index => $activity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $activity['activities'] ?? '' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity['targeted_for'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $activity['implemented_by'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity['province_count'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity['district_count'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $activity['partner'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity['unit'] ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity['total_target'] ?? '-'}}</td>
                        @php
                        $months = explode(',', $activity['months']);
                        @endphp
                        @for ($i = 1; $i <= 12; $i++)
                            <td @if (in_array($i, $months))
                            class="border border-gray-300 p-2 bg-purple-950 text-center text-xs"
                            @else
                            class="border border-gray-300 p-2 text-center text-xs"
                            @endif>

                            </td>
                            @endfor
                            <td class="border border-gray-300 p-2 text-center text-xs">{{ $activity->total_budget ?? ''}}</td>
                    </tr>

                    @endforeach
                    @endforeach
                    @endforeach
                    @endforeach
                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Monitoring, Evaluation, Research and Learning
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetMerl }}
                        </td>
                    </tr>
                    @foreach ($merl as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Gender and Inclusive Development
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetGid }}
                        </td>
                    </tr>
                    @foreach ($gid as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Resilience and Shock Response
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetEprr }}
                        </td>
                    </tr>
                    @foreach ($eprr as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Diverse Partnersips (Private Sector, Academia, CSOs)
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetDiverse }}
                        </td>
                    </tr>
                    @foreach ($diverse as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Social Behaviour Change
                        </td>
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetsbcc }}
                        </td>
                    </tr>
                    @foreach ($sbcc as $index=>$programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->targeted_for ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->province_count ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->unit ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $programactivity->total_target ?? '-'}}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget}} -->
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td class="border border-gray-300  text-black text-xs p-2 text-left">

                        </td>
                        <td colspan="19" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Total Budget
                        </td>
                        <td colspan="2" class="border border-gray-300  text-black text-xs p-2 text-left">
                            $ {{ $budgetPA }}
                        </td>
                    </tr>

                </tbody>
            </table>


        </div>
    </div>
    <script>
    function exportTableToExcel(tableID, filename = ''){
        // Select the table element
        let table = document.getElementById(tableID);

        // Convert HTML table to a worksheet
        let wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });

        // Write the workbook and download the file
        XLSX.writeFile(wb, filename ? filename + '.xlsx' : 'excel_data.xlsx');
    }
</script>

</x-app-layout>