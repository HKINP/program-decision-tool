<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto">

      
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">

                <!-- Activity Title -->
                @if(!empty($attributedata[0]->activity->activities))
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                    {{$attributedata[0]->activity->activities}}
                </h2>
                @endif

                <!-- Activity Capsules -->
                <div class="capsule-section flex flex-wrap gap-2">
                    @if(!empty($attributedata[0]->activity->activity_type))
                    <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                        {{$activitytype[$attributedata[0]->activity->activity_type] ?? ''}}
                    </span>
                    @endif

                    @if(!empty($attributedata[0]->activity->ir_id))
                    <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                        {{$ir[$attributedata[0]->activity->ir_id] ?? ''}}
                    </span>
                    @endif

                    @if(!empty($attributedata[0]->activity->outcomes_id))
                    <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                        {{$outcomes[$attributedata[0]->activity->outcomes_id] ?? ''}}
                    </span>
                    @endif
                </div>
                
                <!-- Attributes Table -->
                <div class="overflow-x-auto mt-6">
                    <h3 class="text-md font-semibold text-blue-600 mb-3">Attributes Data</h3>
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                   
                    @php
                        // Collect attributes used in the dataset
                        $availableCategories = [];
                        foreach ($attributedata as $data) {
                        $parsedAttributes = json_decode($data->attributes_data, true);
                        foreach ($parsedAttributes as $categoryId => $subcategories) {
                        if (!isset($availableCategories[$categoryId])) {
                        $availableCategories[$categoryId] = [];
                        }
                        foreach ($subcategories as $subcategoryId => $value) {
                        if (!isset($availableCategories[$categoryId][$subcategoryId])) {
                        $availableCategories[$categoryId][$subcategoryId] = $attributes[$categoryId]['subcategories'][$subcategoryId] ?? 'Unknown';
                        }
                        }
                        }
                        }
                        @endphp

                        <!-- Header Row for Categories -->
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="text-xs py-2 px-4 border" rowspan="2"></th>
                                <th class="text-xs py-2 px-4 border" rowspan="2">Province</th>
                                <th class="text-xs py-2 px-4 border" rowspan="2">District</th>
                                <th class="text-xs py-2 px-4 border" rowspan="2">Event Date</th>
                                <th class="text-xs py-2 px-4 border" rowspan="2">Event Location</th>
                                @foreach($availableCategories as $categoryId => $subcategories)
                                <th class="text-xs py-2 px-4 border text-center" colspan="{{ count($subcategories) }}">
                                    {{ $attributes[$categoryId]['name'] ?? 'Unknown Category' }}
                                </th>
                                @endforeach
                            </tr>

                            <!-- Subcategories Row -->
                            <tr class="text-xs bg-blue-500 text-white">
                                @foreach($availableCategories as $subcategories)
                                @foreach($subcategories as $subcategory)
                                <th class="text-xs py-2 px-4 border">{{ $subcategory }}</th>
                                @endforeach
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="text-gray-700">
                            @foreach($attributedata as $data)
                            <tr class="border">
                                <!-- Province and District -->
                                <td class="border border-gray-300 p-2 text-xs">
                                    <div class="flex  space-x-4">
                                        <a href="{{route('activities.attributedata.edit',$data->id)}}" class="text-green-500 hover:text-green-700" title="Add">
                                            <i class="fas fa-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-xs py-2 px-4 border">{{ $data->province->province ?? 'Unknown Province' }}</td>
                                <td class="text-xs py-2 px-4 border">{{ $data->district->district ?? 'Unknown District' }}</td>
                                <td class="text-xs py-2 px-4 border">{{ $data->event_date ?? 'Unknown event date' }}</td>
                                <td class="text-xs py-2 px-4 border">{{ $data->event_location ?? 'Unknown event location' }}</td>

                                <!-- Attributes Data -->
                                @php
                                $parsedAttributes = json_decode($data->attributes_data, true);
                                @endphp

                                @foreach($availableCategories as $categoryId => $subcategories)
                                @foreach($subcategories as $subcategoryId => $subcategory)
                                <td class="text-xs py-2 px-4 border text-center">
                                    {{ $parsedAttributes[$categoryId][$subcategoryId] ?? '0' }}
                                </td>
                                @endforeach
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
     

    </div>
</x-app-layout>