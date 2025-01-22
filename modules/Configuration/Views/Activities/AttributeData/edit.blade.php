<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">

                <!-- Activity Title -->
                @if(!empty($attributedata->activity->activities))
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                    {{$attributedata->activity->activities}}
                </h2>
                @endif

                <form action="{{ route('activities.attributedata.update', $attributedata->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="activity_id" value="{{ $attributedata->activity_id }}">

                    <!-- General Information -->
                    <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 mb-6 bg-white border-gray-200">
                        <div class="flex flex-wrap">
                            <!-- Event Date -->
                            <div class="w-1/2 px-2 mb-6">
                                <label for="event_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Date *</label>
                                <input type="date" name="event_date" id="event_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('event_date', $attributedata->event_date) }}">
                            </div>

                            <!-- Event Location -->
                            <div class="w-1/2 px-2 mb-6">
                                <label for="event_location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Location *</label>
                                <input type="text" name="event_location" id="event_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('event_location', $attributedata->event_location) }}">
                            </div>

                            <!-- Province -->
                            <div class="w-1/2 px-2 mb-6">
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Province *</label>
                                <select id="pid" name="province_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ $province->id == old('province_id', $attributedata->province_id) ? 'selected' : '' }}>{{ $province->province }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- District -->
                            <div class="w-1/2 px-2 mb-6">
                                <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select District *</label>
                                <select id="did" name="district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ $district->id == old('district_id', $attributedata->district_id) ? 'selected' : '' }}>{{ $district->district }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Attributes Data -->
                    @php
                        $parsedAttributes = json_decode($attributedata->attributes_data, true);
                    @endphp

                    @foreach ($parsedAttributes as $attributeId => $subcategories)
                        <div class="w-full mb-6">
                            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                                <h3 class="text-lg font-bold mb-4">{{ $attributes[$attributeId]['name'] ?? 'Unknown Category' }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach ($subcategories as $subcategoryId => $value)
                                    <div class="mb-4">
                                        <label for="attribute_{{ $attributeId }}_subcategory_{{ $subcategoryId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $attributes[$attributeId]['subcategories'][$subcategoryId] ?? 'Unknown Subcategory' }}
                                        </label>
                                        <input type="number" id="attribute_{{ $attributeId }}_subcategory_{{ $subcategoryId }}" name="attributes[{{ $attributeId }}][{{ $subcategoryId }}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old("attributes.{$attributeId}.{$subcategoryId}", $value) }}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Data</button>
                </form>

            </div>
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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ provinceIds: [provinceId] })
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
                            districtSelect.value = "{{ old('district_id', $attributedata->district_id) }}";
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                }
            });

            if (provinceSelect.value) {
                provinceSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>
