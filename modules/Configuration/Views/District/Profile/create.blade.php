<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">District Profile</h1>
            </div>
        </div>
        <form action="{{ route('districtprofile.store') }}" method="POST">
            @csrf
            <div class="12 px-2 mb-6 mt-8">
                <label for="district_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select District</label>
                <select style="width: 100%" name="district_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="">Select</option>
                    @foreach ($districts as $key => $district)
                        <option value="{{ $key }}" {{ old('district_id') == $key ? 'selected' : '' }}>
                            {{ $district }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="overflow-x-auto mt-6">
                <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs leading-4 text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">#</th>
                            <th class="px-6 py-3 text-left font-medium">Indicator</th>
                            <th class="px-6 py-3 text-left font-medium">All Value</th>
                            <th class="px-6 py-3 text-left font-medium">Source</th>
                        </tr>
                    </thead>

                    <tbody class="rounded-lg" id="priority-table-body">
                        @php $index = 0; @endphp
                        @foreach ($indicators as $indicator)
                            @php $index++; @endphp
                            <input type="hidden" name="indicator_id[]" value="{{ $indicator->id }}">
                            <tr>
                                <td class="border text-sm border-gray-200 p-2">
                                    {{ $index }}
                                </td>
                                <td class="border text-sm border-gray-200 p-2">
                                    {{ $indicator->indicator_name }}
                                </td>
                                <td class="border text-sm border-gray-200 p-2">
                                    <input type="number" name="all_value[]"
                                        value="{{ old('all_value.' . ($index - 1)) }}"
                                        class="mt-1 block text-sm w-full border-gray-300 rounded-lg shadow-sm">
                                </td>
                                <td class="border text-sm border-gray-200 p-2">
                                    <input type="text" name="source[]"
                                        value="{{ old('source.' . ($index - 1)) }}"
                                        class="mt-1 text-sm block w-full border-gray-300 rounded-lg shadow-sm">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="mt-4 p-2 bg-green-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
