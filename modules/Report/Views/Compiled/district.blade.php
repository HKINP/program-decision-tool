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
                        <th class="bg-gray-500 text-white text-xs p-2">Activities for Year 1</th>
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
                        <td class="p-3 font-bold" colspan="4">
                            @if ($stageId == 3)
                            <span class="ml-2 text-blue-600">IR 1. Improve household nutrition practices</span>
                            @elseif ($stageId == 4)
                            <span class="ml-2 text-blue-600">IR 2. Improved coverage and quality of nutrition services</span>
                            @elseif ($stageId == 5)
                            <span class="ml-2 text-blue-600">IR 3. Improve access to safe, diverse, and nutritious foods</span>
                            @elseif ($stageId == 6)
                            <span class="ml-2 text-blue-600">IR 4. Strengthen GON capacity for multi-sectoral nutrition programming</span>
                            @endif
                        </td>
                    </tr>
                    @foreach ($targetedForGroups as $targetedFor => $activitiesList)
                    <tr class="bg-gray-200 border-b">
                        <td class="p-3 font-bold">{{ ucfirst($targetedFor) }}</td>
                        <td colspan="3"></td>
                    </tr>
                    @foreach ($activitiesList as $activity)
                    <tr class="bg-gray-100 border-b">
                        <td class="p-3">{{ $serialNumber++ }}</td>
                        <td class="p-3">
                            @if ($stageId == 6)
                            {{ $activity->activity->activities }}
                            @else
                            {{ $activity->proposed_activities }}
                            @endif
                        </td>
                        <td class="p-3">{{ $activity->remarks }}</td>
                        <td class="p-3">
                            <a href="#" class="open-modal" data-activity-id="{{ $activity->id }}">
                                <i class="fa-solid fa-link"></i>
                            </a>
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
    <div id="activityModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4">Select Activities</h2>
            <form id="updateActivitiesForm" action="{{ route('activityMapping.district') }}" method="POST">
                @csrf
                <input type="hidden" name="activity_id" id="activityId">
                <input type="hidden" name="district_id" value="{{$districtprofile->id}}">
                <div class="mb-4">
                    <label for="activitiesSelect" class="block text-gray-700">Select Activities:</label>
                    <select id="activitiesSelect" name="activities" class="form-select mt-1 block w-full">
                        @foreach ($mappingActivities as $mactivity)
                        <option value="{{ $mactivity->id }}">{{ $mactivity->activities }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                <button type="button" id="closeModal" class="ml-2 bg-red-500 text-white px-4 py-2 rounded">Close</button>
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
        function openModal(activityId) {
            const modal = document.getElementById('activityModal');
            const select = document.getElementById('activitiesSelect');
            const activityIdInput = document.getElementById('activityId');

            // Set the input values
            activityIdInput.value = activityId;

            // Set the selected value in the dropdown
            select.value = activityId;

            // Show the modal
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('activityModal');
            modal.classList.add('hidden');
        }

        document.querySelectorAll('.open-modal').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const activityId = this.getAttribute('data-activity-id');
                openModal(activityId);
            });
        });

        document.getElementById('closeModal').addEventListener('click', closeModal);
    </script>

</x-app-layout>
0