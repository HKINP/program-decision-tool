<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class=" p-4 rounded-lg w-full mb-5">

            <div class="flex items-center gap-2 text-2xl p-4">
                <div class="border bg-white p-2 rounded-full ml-2"><svg stroke="currentColor" fill="currentColor"
                        stroke-width="0" viewBox="0 0 1024 1024" height="18" width="18"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                        </path>
                    </svg></div>
                <p class="font-semibold text-[24px]">Step1. District Context</p>
            </div>
        </div>
        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>

                    <p class="font-semibold text-md  ml-4">
                        <span class="text-blue-600"> Province: </span>
                        <span class="text-black">{{ $districtprofile->province->province }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md  ml-4">
                        <span class="text-blue-600"> District: </span>
                        <span class="text-black">{{ $districtprofile->district }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">04</p>
                <p class="font-semibold text-md text-blue-600">District profile</p>
            </div>
            <form action="{{ route('districtvulnerability.store') }}" method="POST">
                @csrf

                <div class="flex flex-wrap -mx-2">
                    <!-- Column 1 -->
                    <div class="w-1/3 px-2 mb-6">
                        <label for="municipality-count"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of
                            Municipality</label>
                        <input type="text" id="municipality-count" value="{{ count($locallevel) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="" required="">
                    </div>

                    <!-- Column 2 -->
                    <div class="w-1/3 px-2 mb-6">
                        <label for="vulnerable-municipality-count"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Vulnerable
                            Municipality</label>
                        <input type="number" value="{{ $districtprofile->vulnerable_municipality }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="" required="">
                    </div>

                    <!-- Column 3  -->
                    <div class="w-1/3 px-2 mb-6">
                        <label for="Ecological Zone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ecological Zone</label>
                        <input type="text" value="{{ $districtprofile->ecological_zone }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="" required="">
                    </div>
                    <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                </div>


                <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                    <thead class="rounded-lg">

                        <tr>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Municipality
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Remote
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Caste/Ethnicity
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Geography (municipalities)
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Food insecurity
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Wealth
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Climatic Change
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                                style="line-height: 1.2;">
                                Remark
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody class="rounded-lg" id="priority-table-body">

                        @foreach ($districtVulnerability as $data)
                            <tr>
                                <td class="p-2">
                                    {{ $data->locallevel->lgname }}
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->remote_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->caste_ethnicity_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->geography_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->food_security_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->wealth_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="checkbox"
                                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        value="1" {{ $data->climatic_change_status == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ $data->remarks }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </form>

        </div>
</x-app-layout>
