<div class="flex gap-4">
    <!-- Province Section -->
    <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
        <div class="flex items-center mb-4">
            <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>

            <p class="font-semibold text-md ml-4">
                <span class="text-blue-600"> Province: </span>
                <span class="text-black">{{ $districtprofile->province->province }}</span>
            </p>
        </div>
    </div>
    <!-- District Section -->
    <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
        <div class="flex items-center mb-4">
            <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
            <p class="font-semibold text-md ml-4">
                <span class="text-blue-600"> District: </span>
                <span class="text-black">{{ $districtprofile->district }}</span>
            </p>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-lg w-full mb-5 ">
    <div class="flex gap-2 items-center mb-4">
        <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">04</p>
        <p class="font-semibold text-md text-blue-600">District profile</p>
    </div>
    <div class="flex flex-wrap -mx-2">
        <!-- Column 1 -->
        <div class="w-1/2 px-2 mb-6">
            <label for="municipality-count"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Municipality</label>
            <input type="text" id="municipality-count" value="{{ count($districtprofile->locallevel) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required="">
        </div>

        <!-- Column 2 -->
        <div class="w-1/2 px-2 mb-6">
            <label for="vulnerable-municipality-count"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Vulnerable Municipality</label>
            <input type="number" value="{{ $districtprofile->vulnerable_municipality }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required="">
        </div>

       
    </div>

    <table class="min-w-full border-collapse bg-white border-gray-600 rounded-lg overflow-hidden">
        <thead class="rounded-lg">
            <tr>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Municipality</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Vulnerability Count</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Remote</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Caste/Ethnicity</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Food insecurity</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Wealth</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Climatic Change</th>
                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">Remark</th>
            </tr>
        </thead>
        <tbody class="rounded-lg" id="priority-table-body">
            @foreach ($districtVulnerability as $data)
                <tr>
                    <td class="p-2 text-sm">{{ $data->locallevel->lgname }}</td>
                    <td class="p-2 text-center">
                        {{$data->remote_status + $data->caste_ethnicity_status + $data->food_security_status + $data->wealth_status+  $data->climatic_change_status}}
                    </td>
                    <td class="p-2 text-center">
                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->remote_status == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 text-center">
                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->caste_ethnicity_status == 1 ? 'checked' : '' }}>
                    </td>
                  
                    <td class="p-2 text-center">
                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->food_security_status == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 text-center">
                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->wealth_status == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 text-center">
                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->climatic_change_status == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="p-2 text-center">
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->remarks }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
