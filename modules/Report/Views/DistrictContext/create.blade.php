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
                <p class="font-semibold text-[24px]">Step 1. District Context</p>
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
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <p>1) Please begin by asking participants to complete the district profile section. Discuss how they
                    would define vulnerability based on caset/ethnicity, geography, food insecurity, and wealth.
                </p>
                <p class="mb-2">
                    2) Then list the development partners working in the district, the type of programs they implement,
                    and the number of municipalities where they operate.</p>
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
                        <label for="municipality-count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Municipality</label>
                        <input type="text" id="municipality-count" value="{{count($districtprofile->locallevel)}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                    </div>

                    <!-- Column 2 -->
                    <div class="w-1/3 px-2 mb-6">
                        <label for="vulnerable-municipality-count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Vulnerable Municipality</label>
                        <input type="number" id="vulnerable-municipality-count" name="vulnerable_municipality" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                    </div>

                    <!-- Column 3 -->
                    <div class="w-1/3 px-2 mb-6">
                        <label for="target-group" class="block text-sm font-medium text-gray-700">Ecological Zone</label>
                        <select name="ecological_zone" required id="ecological_zone" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm edit-context target-group">
                            <option value="">Select Ecolological Zone</option>
                            <option value="Terai">Terai</option>
                            <option value="Hill">Hill</option>
                            <option value="Mountain">Mountain</option>
                        </select>
                    </div>
                    <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                    <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
                </div>


                <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                    <thead class="rounded-lg">
                        <tr>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Municipality
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Remote
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Caste/Ethnicity
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Geography (municipalities)
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Food insecurity
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Wealth
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Climatic Change
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Remark
                            </th>
                            <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="rounded-lg" id="priority-table-body">
                        <!-- Existing rows rendered by server-side logic -->
                    </tbody>
                </table>




        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                <p class="font-semibold text-md text-blue-600">Notes</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your notes here..."></textarea>

            </div>
        </div>

        <button type="submit" class="mt-4 p-2 bg-green-500 text-white rounded">Submit</button>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const vulnerableMunicipalityInput = document.getElementById('vulnerable-municipality-count');
                const priorityTableBody = document.getElementById('priority-table-body');
                const locallevel = @json($districtprofile->locallevel);

                function createMunicipalityOptions(selectedValues = []) {
                    return locallevel.map(item => {
                        if (!selectedValues.includes(item.id)) {
                            return `<option value="${item.id}">${item.lgname}</option>`;
                        }
                        return '';
                    }).join('');
                }

                function getSelectedMunicipalities() {
                    return Array.from(priorityTableBody.querySelectorAll('select.municipality-select'))
                        .map(select => select.value)
                        .filter(value => value);
                }

                function updateTableRows() {
                    const count = parseInt(vulnerableMunicipalityInput.value, 10);
                    if (isNaN(count) || count < 0) return; // Ensure count is a valid number

                    const existingRows = priorityTableBody.querySelectorAll('tr').length;

                    if (count > existingRows) {
                        for (let i = existingRows; i < count; i++) {
                            const selectedValues = getSelectedMunicipalities();
                            const row = document.createElement('tr');

                            row.innerHTML = `
                            <td class="p-2 text-center">
                                    <select name="lgid[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 municipality-select">
                                        <option value="">Select Municipality</option>
                                        ${createMunicipalityOptions(selectedValues)}
                                    </select>
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="remote_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="caste_ethnicity_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="geography_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="food_security_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="wealth_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="hidden" name="climatic_change_status[]" value="0">
                                    <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1">
                                </td>
                                <td class="p-2 text-center">
                                    <input type="text" name="remark[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </td>
                                <td class="p-2 text-center">
                                    <button type="button" class="remove-row-btn text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </td>
                            `;

                            priorityTableBody.appendChild(row);
                        }
                    } else if (count < existingRows) {
                        for (let i = existingRows; i > count; i--) {
                            priorityTableBody.querySelector('tr:last-child').remove();
                        }
                    }

                    updateDropdowns();
                }

                function handleRowRemoval(event) {
                    if (event.target.closest('.remove-row-btn')) {
                        event.target.closest('tr').remove();
                        vulnerableMunicipalityInput.value = parseInt(vulnerableMunicipalityInput.value, 10) - 1;
                        updateTableRows();
                    }
                }

                function updateDropdowns() {
                    const selectedValues = getSelectedMunicipalities();
                    const dropdowns = priorityTableBody.querySelectorAll('select.municipality-select');
                    dropdowns.forEach(dropdown => {
                        const currentValue = dropdown.value;
                        dropdown.innerHTML = `<option value="">Select Municipality</option>${createMunicipalityOptions(selectedValues)}`;
                        if (currentValue && !selectedValues.includes(currentValue)) {
                            dropdown.value = ''; // Clear if not included in options
                        } else {
                            dropdown.value = currentValue; // Set back the previous value if still valid
                        }
                    });
                }

                function handleCheckboxChange(event) {
                    const checkbox = event.target;
                    const hiddenInput = checkbox.previousElementSibling;
                    hiddenInput.value = checkbox.checked ? '1' : '0'; // Set value of hidden input
                }

                priorityTableBody.addEventListener('change', function(event) {
                    if (event.target.matches('input[type="checkbox"]')) {
                        handleCheckboxChange(event);
                    }
                });

                vulnerableMunicipalityInput.addEventListener('change', updateTableRows);
                priorityTableBody.addEventListener('click', handleRowRemoval);
            });
        </script>




</x-app-layout>