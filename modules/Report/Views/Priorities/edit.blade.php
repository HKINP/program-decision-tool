<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8 rounded-lg w-full mb-5">
            <div class="flex items-center gap-4 text-2xl">
                <!-- First Arrow with Anchor Link -->
                <a href="{{ route('steplist.create', ['did' => $districtprofile->id]) }}" class="border bg-white p-2 rounded-full ml-2 inline-flex items-center">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </a>


                <!-- Step Description -->
                <p class="font-semibold text-[24px]">Step 2. Prioritize Indicators for Year 1</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <p>1) Use the menu below to design community-level activities. To support women and caregivers to adopt
                    the selected behaviors, consider what barriers they would need to overcome. These barriers may be
                    individual (e.g., knowledge, self-confidence, time, cost) or social (family support, cultural
                    practices, gender norms), or structural (health system, food system). We will address health system
                    barriers under IR 2 and food system barriers under IR 3.</p>
                <p class="mb-2">2) For each platform/program determine what you would need to do: conduct IPC,
                    organize community events (e.g., street theater), refer or link with another program e.g., social
                    protection. Complete the who and how columns to determine further who needs to be involved and how.
                    Then describe your activity in as much detail as possible. Once you have completed identifying
                    activities for everyone in the district, consider how it might change for underserved populations.
                    Given the year 1 implementation duration of 4-6 months, try to limit the number of activities to 5-7
                    for this IR.</p>
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

        <div class="bg-white p-4 rounded-lg w-full mb-5 ">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">04</p>
                <p class="font-semibold text-md text-blue-600">District profile</p>
            </div>
            <div class="flex flex-wrap -mx-2">
                <!-- Column 1 -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="municipality-count"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of
                        Municipality</label>
                    <input type="text" id="municipality-count" value="{{ count($districtprofile->locallevel) }}"
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
                        <td class="p-2 text-sm">
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
        </div>

        <form action="{{ route('priority.updatebydistrict', $districtprofile->id) }}" method="POST">
            @csrf
            @method('put')
               <div class="overflow-x-auto mt-6">

                <p class="bg-white p-4 rounded-lg w-full mb-5">Legend: red < 50%; orange 50%-79%; green>=80%</p>
                <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                    <thead class="rounded-lg">
                        <tr>
                            <th class="bg-gray-500 text-white text-xs p-2">Target Group</th>
                            <th class="bg-gray-500 text-white text-xs p-2">Thematic area</th>
                            <th class="bg-gray-500 text-white text-xs p-2">#</th>
                            <th class="bg-gray-500 text-white text-xs p-2">Questions (based on MSNP III indicators)</th>
                            <th class="bg-gray-500 text-white text-xs p-2">Responses (%)<br />Province / District</th>
                            <th class="bg-gray-500 text-white text-xs p-2">Priority for Y1</th>
                        </tr>
                    </thead>
                    <tbody class="rounded-lg" id="priority-table-body">
                        <!-- Existing rows rendered by server-side logic -->
                        @php $index = 1; @endphp
                        @foreach ($priorities as $question)
                        <input type="number" name="id[]" value="{{ $question->id }}" hidden>
                        <tr class="priority-row @if ($question->priority==1) bg-gray-300  @endif  ">
                            <td class="border text-sm text-black border-gray-200 px-2">
                                <input type="number"  value="{{ $question->targetGroup->id }}" hidden>
                                {{ $question->targetGroup->target_group }}
                            </td>
                            <td class="border text-sm text-black border-gray-200 px-2">
                                <input type="number"  value="{{ $question->thematicArea->id }}" hidden>
                                {{ $question->thematicArea->thematic_area }}
                            </td>
                            <td class="border text-sm text-black border-gray-200 px-2">{{ $index++ }}</td>
                            <input type="number"  value="{{$question->id}}" hidden>
                            <td class="border text-sm text-black border-gray-200 px-2">{{ $question->question->question }}</td>
                            @php
                            $value = $question->question->indicator->provinceProfiles[0]->all_value;
                            $color = '';

                            if ($value < 50) { $color='bg-red-600 text-white' ; } elseif ($value>= 50 && $value < 80) { $color='bg-orange-700 text-white' ; } elseif ($value>= 80) {
                                    $color = 'bg-green-600 text-white';
                                    }
                                    @endphp
                                    <td class="border text-sm text-black border-gray-200 text-center px-2 {{ $color }}">
                                        {{ $value }}
                                    </td>
                                    <td class="border text-xs text-black border-gray-200 p-1 text-center">
                                        <select name="priority[]" class="mt-1 block w-full text-sm border-gray-300 rounded-lg shadow-sm priority-select">
                                            <option value="0">Priority</option>
                                            <option @if ($question->priority==1) selected @endif value="1">Yes</option>
                                        </select>
                                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="bg-white p-4 rounded-lg w-full mb-4 mt-6">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06</p>
                    <p class="font-semibold text-md text-blue-600">Notes</p>
                </div>

                <div class="space-y-2 text-xs italic">
                    <textarea id="notes" name="notes" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your notes here...">{{$stepRemarks->notes}}</textarea>
                </div>
            </div>
            <button type="submit" class="mt-4 p-2 bg-purple-500 text-white rounded">Update</button>
    </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Attach event listener to all priority select elements
            document.querySelectorAll('.priority-select').forEach(select => {
                select.addEventListener('change', function() {
                    // Get all rows
                    document.querySelectorAll('.priority-row').forEach(row => {
                        // Remove red highlight from all rows
                        row.classList.remove('highlight-red');
                    });

                    // Highlight the row if 'Yes' is selected
                    if (this.value === '1') {
                        this.closest('tr').classList.add('bg-gray-300');
                    }
                    if (this.value === '0') {
                        this.closest('tr').classList.remove('bg-gray-300');
                    }
                });
            });
        });
    </script>
</x-app-layout>