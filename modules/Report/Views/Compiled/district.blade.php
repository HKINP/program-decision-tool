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
                            <div class="flex space-x-4">
                                @if($activity->activity_id == null)
                                <a href="{{ route('activityMapping.showAdd', ['ir_id' => $ir_id, 'id' => $activity->id]) }}" class="text-blue-500 hover:text-blue-700" onclick="openModal({{ $ir_id }}, {{ $activity->id }})">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                                @else
                           
                                <a href="{{ route('activityMapping.showRollback', ['ir_id' => $ir_id, 'id' => $activity->id]) }}" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('http://localhost:8000/user/1')">
                                    <i class="fas fa-reply"></i>
                                </a>
                                @endif
                                <a href="{{ route('activityMapping.showEdit', ['ir_id' => $ir_id, 'id' => $activity->id]) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                               
                            </div>


                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>

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


</x-app-layout>
0