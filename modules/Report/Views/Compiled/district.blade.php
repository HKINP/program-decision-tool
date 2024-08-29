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
                        <span class="text-black">{{ $districtprofile->province->province }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">District:</span>
                        <span class="text-black">{{ $districtprofile->district }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4 no-print">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
                <p class="font-semibold text-md text-blue-600">Activities</p>
            </div>

            <table class="print-table">
                <thead>
                    <tr>
                        <th class="bg-gray-500 text-white text-xs p-2">#</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Work Plan Activity</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Co-creation Activity</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Notes</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Activity Mapping</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $serialNumber = 1;
                    @endphp
                    @foreach ($activities as $stageId => $targetedForGroups)
                        <tr class="bg-gray-100 border-b">
                            <td class="p-3 font-bold" colspan="5">
                                @php
                                    $ir_id = null; // Initialize ir_id
                                @endphp

                                @if ($stageId == 3)
                                    @php
                                        $ir_id = 1;
                                    @endphp
                                    <span class="ml-2 text-blue-600">IR 1. Improve household nutrition practices</span>
                                @elseif ($stageId == 4)
                                    @php
                                        $ir_id = 2;
                                    @endphp
                                    <span class="ml-2 text-blue-600">IR 2. Improved coverage and quality of nutrition
                                        services</span>
                                @elseif ($stageId == 5)
                                    @php
                                        $ir_id = 3;
                                    @endphp
                                    <span class="ml-2 text-blue-600">IR 3. Improve access to safe, diverse, and
                                        nutritious foods</span>
                                @elseif ($stageId == 6)
                                    @php
                                        $ir_id = 4;
                                    @endphp
                                    <span class="ml-2 text-blue-600">IR 4. Strengthen GON capacity for multi-sectoral
                                        nutrition programming</span>
                                @endif
                            </td>
                        </tr>
                        @foreach ($targetedForGroups as $targetedFor => $activitiesList)
                            <tr class="bg-gray-200 border-b">
                                <td class="p-3 font-bold">{{ ucfirst($targetedFor) }}</td>
                                <td colspan="4"></td>
                            </tr>
                            @foreach ($activitiesList as $activity)
                                <tr class="bg-gray-100 border-b">
                                    <td class="p-3">{{ $serialNumber++ }}</td>
                                    <td class="p-3"> {{ $activity->activity->activities ?? 'NA' }}</td>
                                    <td class="p-3"> {{ $activity->proposed_activities ?? 'NA' }} </td>
                                    <td class="p-3">{{ $activity->remarks }}</td>
                                    <td class="p-3">
                                        @if($activity->activity_id ==null)
                                        <a href="#" class="open-modal" onclick="openModal({{ $ir_id }},{{ $activity->id }})">
                                            <i class="fa-solid fa-link"></i>
                                        </a>
                                        @else                                       
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!-- Modal Structure -->
    <div id="activityModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white w-1/2 p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4 px-4 py-2">Select Activities</h2>
            <form class="p-4" id="updateActivitiesForm" action="{{ route('activityMapping.district') }}"
                method="POST">
                @csrf
                <input type="hidden" name="id" id="activityId">
                <input type="hidden" name="district_id" value="{{ $districtprofile->id }}">
                <div class="mb-4">

                    <select id="activitiesSelect" name="activity_id"
                        class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Select</option>
                        @foreach ($mappingActivities as $mactivity)
                            <option value="{{ $mactivity->id }}" class="w-1/2 max-w-1/2"
                                data-ir-id="{{ $mactivity->ir_id }}">
                                {{ $mactivity->activities }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                <button type="button" id="closeModal"
                    class="ml-2 bg-red-500 text-white px-4 py-2 rounded">Close</button>
            </form>
        </div>
    </div>

    <style>
        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }

            #sidebar {
                display: none !important;
            }

            .print-container {
                width: 100%;
                overflow: hidden;
                padding: 0;
                box-sizing: border-box;
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .print-table {
                width: 100%;
                table-layout: fixed;
                border-collapse: collapse;
            }

            .print-table th,
            .print-table td {
                padding: 2mm;
                font-size: 8pt;
                border: 1px solid #ddd;
            }

            .print-table thead {
                display: table-header-group;
            }

            .print-table tbody {
                display: table-row-group;
            }

            .print-table tr {
                page-break-inside: avoid;
            }

            .print-table td {
                page-break-inside: avoid;
            }

            .no-print {
                display: none;
            }

            header {
                display: none;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("activityModal");
            const activitiesSelect = document.getElementById("activitiesSelect");
            const activityIdInput = document.getElementById("activityId");

            const allActivities = Array.from(activitiesSelect.options);

            window.openModal = function(irId,activityId) {
                activityIdInput.value = activityId;

                // Clear the select list
                activitiesSelect.innerHTML = "";

                // Add the first option
                const firstOption = document.createElement("option");
                firstOption.value = "";
                firstOption.textContent = "Please select an activity";
                activitiesSelect.appendChild(firstOption);

                // Filter activities based on the passed irId
                const filteredActivities = allActivities.filter(option => option.getAttribute('data-ir-id') ==
                    irId);

                // Populate the select list with filtered activities
                filteredActivities.forEach(option => {
                    activitiesSelect.appendChild(option);
                });

                modal.classList.remove("hidden");
            };

            document.getElementById("closeModal").addEventListener("click", function() {
                modal.classList.add("hidden");
            });
        });
    </script>

</x-app-layout>
0
