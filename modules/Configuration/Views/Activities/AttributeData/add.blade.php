<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <!-- <div class="mb-4 sm:mb-0">
                <h1 class="text-xl md:text-xl text-gray-800 dark:text-gray-100 font-bold">Add Disaggregated data</h1>
            </div> -->

        </div>
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <!-- Title and Capsule Component -->
                <div class="card-title-capsule">
                    <!-- Card Title -->
                    @if(!empty($activity->activities))
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        {{$activity->activities}}
                    </h2>
                    @endif
                    <!-- Capsule Section -->
                    <div class="capsule-section flex flex-wrap gap-2">
                        @if(!empty($activity->activity_type))
                        <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                            {{$activitytype[$activity->activity_type] ?? ''}}
                        </span>
                        @endif

                        @if(!empty($activity->ir_id))
                        <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                            {{$ir[$activity->ir_id] ?? ''}}
                        </span>
                        @endif

                        @if(!empty($activity->outcomes_id))
                        <span class="capsule-item bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-full px-3 py-1 text-sm font-medium">
                            {{$outcomes[$activity->outcomes_id] ?? ''}}
                        </span>
                        @endif
                    </div>
                </div>


            </div>
        </div>


        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <form action="{{ route('activities.attributedata.store') }}" method="POST">
                @csrf
                <input  hidden type="text" name="activity_id" value="{{ $activity->id }}">

                <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 mb-6 bg-white border-gray-200">
                    <div class="flex flex-wrap ">
                        <!-- Event Date & Location (Existing fields) -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="event_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Date *</label>
                            <input type="date" name="event_date" id="event_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('event_date', $activity->event_date) }}">
                        </div>

                        <div class="w-1/2 px-2 mb-6">
                            <label for="event_location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Location *</label>
                            <input type="text" name="event_location" id="event_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('event_location', $activity->event_location) }}">
                        </div>


                        <!-- Province -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Province *</label>
                            <select id="pid" name="province_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ in_array($province->id, old('province_ids', $activity->province_ids)) ? 'selected' : '' }}>{{ $province->province }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select District *</label>
                            <select id="did" name="district_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ in_array($district->id, old('district_ids', $activity->district_ids)) ? 'selected' : '' }}>{{ $district->district }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @foreach ($attributes as $attributeId => $attribute)
                @php
                $attributeValues = explode(',', $activity->attributes);
                @endphp
                @if (in_array($attributeId, $attributeValues))
                <div class="w-full mb-6">
                    <!-- Card Container -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4">{{ $attribute['name'] }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($attribute['subcategories'] as $subcategoryId => $subcategoryName)
                            <div class="mb-4">
                                <label for="attribute_{{ $attributeId }}_subcategory_{{ $subcategoryId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $subcategoryName }}
                                </label>
                                <input
                                    type="number" {{-- Or "text" if you need text input --}}
                                    id="attribute_{{ $attributeId }}_subcategory_{{ $subcategoryId }}"
                                    name="attributes[{{ $attributeId }}][{{ $subcategoryId }}]" {{-- Nested array keys --}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old("attributes.{$attributeId}.{$subcategoryId}", $activity->attributes[$attributeId][$subcategoryId] ?? '') }}" {{-- Access existing data --}}>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endforeach


                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit Data</button>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {           

            const provinceSelect = document.getElementById('pid');
            const districtSelect = document.getElementById('did');

            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                if (provinceId) {
                    fetch('/api/province/district', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
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