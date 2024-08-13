<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4 ">
            <h2 class="text-lg font-bold">District Compiled Report </h2>
        </div>
    
        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">Province:</span>
                        
                        <span class="text-black">{{ $province->province }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">District:</span>
                        <span class="text-black"></span>
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
                    </tr>
                </thead>
                <tbody>
                    @php
                        $serialNumber = 1;
                    @endphp
                    @foreach ($activities as $stageId => $targetedForGroups)
                        <tr class="bg-gray-100 border-b">
                            <td class="p-3 font-bold text-gray-700" colspan="3">
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
                                <td colspan="2"></td>
                            </tr>
                            @foreach ($activitiesList as $activity)
                                <tr class="bg-gray-100 border-b">
                                    <td class="p-3">{{ $serialNumber++ }}</td>
                                    <td class="p-3">{{ $activity->proposed_activities }}</td>
                                    <td class="p-3">{{ $activity->remarks }}</td>
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
                margin: 15mm; /* Adjust margins as needed */
            }
            #sidebar {
    display: none !important;
}
    
            .print-container {
                width: 100%;
                overflow: hidden; /* Hide any overflow to prevent scrollbars */
                padding: 0; /* Ensure no extra padding */
                box-sizing: border-box; /* Include padding and border in element's total width and height */
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
                table-layout: fixed; /* Ensure consistent table layout */
                border-collapse: collapse; /* Collapse borders to avoid double borders */
            }
    
            .print-table th,
            .print-table td {
                padding: 2mm;
                font-size: 8pt;
                border: 1px solid #ddd; /* Border for clarity */
            }
    
            .print-table thead {
                display: table-header-group; /* Ensure headers are visible on each page */
            }
    
            .print-table tbody {
                display: table-row-group; /* Ensure rows are grouped properly */
            }
    
            .print-table tr {
                page-break-inside: avoid; /* Avoid page breaks inside rows */
            }
    
            .print-table td {
                page-break-inside: avoid; /* Avoid page breaks inside cells */
            }
    
            /* Hide elements that should not appear in print */
            .no-print {
                display: none;
            }
    
            header {
                display: none; /* Hide header for print */
            }
        }
    </style>
    
    
</x-app-layout>
