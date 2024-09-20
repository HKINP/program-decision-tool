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
            <form method="post"
                @can('manage-data-entry')
            action="{{ route('activities.order') }}">
            @csrf
            @endcan
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <button id="exportBtn"
                    class="btn bg-[#844a8a] text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z">
                        </path>
                    </svg>
                    <span class="max-xs:sr-only">Export to Excel</span>
                </button>
                @can('set-activities-order')
                    <div class="flex justify-end items-center">
                        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                            Update Order
                        </button>
                    </div>
                @endcan

        </div>

        <!-- Add your table here -->
        <table id="myTable" class="min-w-full border-collapse border divide-y divide-gray-200 mt-8 border-gray-300">
            <!-- Header Section -->
            <thead>
                <tr class="bg-purple-800 text-white">
                    <th class="text-xs border border-gray-300 p-2 text-center w-12">#</th>
                    {{-- <th class="text-xs border border-gray-300 p-2 text-center w-12">Order</th> --}}
                    <th class="text-xs border border-gray-300 p-2 text-center">Activities</th>
                    <th class="text-xs border border-gray-300 p-2 text-center">Administrative Level</th>
                    <th class="text-xs border border-gray-300 p-2 text-center">Province</th>
                    <th class="text-xs border border-gray-300 p-2 text-center">District</th>
                    <th class="text-xs border border-gray-300 p-2 text-center">Municipalities</th>
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
                    <th class="text-xs border border-gray-300 p-2 w-[5rem] text-center">Budget</th>
                </tr>
            </thead>
            <!-- Body Section -->
            <tbody class="divide-y divide-gray-200">

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Program Management
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetPA) }}
                    </td>
                </tr>
                @foreach ($programactivities as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->implemented_by ?? '-' }}
                        </td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                @endforeach
                </tr>

                <tr class="bg-gray-100 text-white font-semibold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Finance and Operations
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetFAO) }}
                    </td>
                </tr>
                @foreach ($financeandoperation as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs"></td>
                    </tr>
                @endforeach
                @php
                    // Initialize the overall total budget
                    $overallTotalBudget = 0;
                @endphp
                <!-- Iterate over Outcomes -->
                @foreach ($irOutcomes as $irId => $irOutcomes)
                    <!-- Display IR Header -->
                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
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
                                <td colspan="21"
                                    class="border border-gray-300 p-2 font-bold  text-black text-left text-xs"
                                    style="background:#e5e7eb;font-weight:bold">
                                    {{ $outcome['outcome']['outcome'] }}
                                </td>
                                <td class="border border-gray-300 p-2 font-bold  text-black text-left text-xs"
                                    style="background:#e5e7eb;font-weight:bold">
                                    @php
                                        // Calculate the sum of totalbudget for all activities, only including numeric values
                                        $totalBudgetSum = collect($outcome['outcome']['activities'])->sum(function (
                                            $activity,
                                        ) {
                                            return is_numeric($activity['total_budget'])
                                                ? $activity['total_budget']
                                                : 0;
                                        });
                                        $overallTotalBudget += $totalBudgetSum;
                                    @endphp
                                    $ {{ number_format($totalBudgetSum) }}
                                </td>
                            </tr>

                            <!-- Iterate over Activities -->
                            @foreach ($outcome['outcome']['activities'] as $index => $activity)
                                <tr class="text-black">
                                    {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }} --}}
                                    </td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        <input type="text" id="order" name="order[]"
                                            value="{{ $activity['order'] ?? 0 }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                        <input type="text" id="activity_id" name="activity_id[]"
                                            value="{{ $activity['id'] }}" hidden />

                                    </td>
                                    <td class="border border-gray-300 p-2 text-xs">
                                        {{ $activity['activities'] ?? '' }}</td>
                                    <td class="border border-gray-300 p-2 text-xs">
                                        {{ $activity['implemented_by'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity['province_count'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity['district_count'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity['targeted_for'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-xs">
                                        {{ $activity['partner'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity['unit'] ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity['total_target'] ?? '-' }}</td>
                                    @php
                                        $months = explode(',', $activity['months']);
                                    @endphp
                                    @for ($i = 7; $i <= 12; $i++)
                                        <td
                                            @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                            @else
                            class="border border-gray-300 p-2 text-center text-xs" @endif>

                                        </td>
                                    @endfor
                                    @for ($j = 1; $j <= 6; $j++)
                                        <td
                                            @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                            @else
                            class="border border-gray-300 p-2 text-center text-xs" @endif>

                                        </td>
                                    @endfor
                                    <td class="border border-gray-300 p-2 text-center text-xs">
                                        {{ $activity->total_budget ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Monitoring, Evaluation, Research and Learning
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetMerl) }}
                    </td>
                </tr>
                @foreach ($merl as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Gender and Inclusive Development
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetGid) }}
                    </td>
                </tr>
                @foreach ($gid as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor

                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Resilience and Shock Response
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetEprr) }}
                    </td>
                </tr>
                @foreach ($eprr as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Diverse Partnersips (Private Sector, Academia, CSOs)
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetDiverse) }}
                    </td>
                </tr>
                @foreach ($diverse as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                        @else
                        class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td colspan="21" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Social and Behaviour Change
                    </td>
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">
                        $ {{ number_format($budgetsbcc) }}
                    </td>
                </tr>
                @foreach ($sbcc as $index => $programactivity)
                    <tr class="text-black">
                        {{-- <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td> --}}
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <input type="text" id="order" name="order[]"
                                value="{{ $programactivity->order ?? 0 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="text" id="activity_id" name="activity_id[]"
                                value="{{ $programactivity->id }}" hidden />

                        </td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>
                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $programactivity->implemented_by ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->province_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->district_count ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->targeted_for ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->partner ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->unit ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            {{ $programactivity->total_target ?? '-' }}</td>
                        @php
                            $months = explode(',', $programactivity->months);
                        @endphp
                        @for ($i = 7; $i <= 12; $i++)
                            <td
                                @if (in_array($i, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        @for ($j = 1; $j <= 6; $j++)
                            <td
                                @if (in_array($j, $months)) class="border border-gray-300 p-2 text-center text-xs" style="background:#3b0764"
                       @else
                       class="border border-gray-300 p-2 text-center text-xs" @endif>

                            </td>
                        @endfor
                        <td class="border border-gray-300 p-2 text-center text-xs">
                            <!-- {{ $programactivity->total_budget }} -->
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                    <td class="border border-gray-300  text-black text-xs p-2 text-left">

                    </td>
                    <td colspan="19" class="border border-gray-300  text-black text-xs p-2 text-left">
                        Total Budget
                    </td>
                    <td colspan="2" class="border border-gray-300  text-black text-xs p-2 text-left">

                        $ {{ number_format($overallTotalBudget + $totalbudget, 2) }}
                    </td>
                </tr>

            </tbody>
        </table>

        </form>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#exportBtn').on('click', function() {
                exportTableToExcel('myTable',
                    `Year One Workplan_${new Date().toISOString().split("T")[0]}`);
            });

            function exportTableToExcel(tableID, filename = '') {
                var downloadLink;
                var dataType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var tableHTML = tableSelect.outerHTML;

                // Specify file name
                filename = filename ? filename + '.xls' : 'excel_data.xls';

                // Create download link element
                downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);

                var blob = new Blob([tableHTML], {
                    type: dataType
                });
                const url = URL.createObjectURL(blob);
                downloadLink.href = url;
                downloadLink.download = filename;
                downloadLink.click();
            }
        });
    </script>

</x-app-layout>
