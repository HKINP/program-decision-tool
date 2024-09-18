<x-app-layout>
    @if($activityTypeid!=3)
    <x-table-listing
        :title="@isset($activityType)
        ? $activityType.' - Activities'
        : 'Activities'"
        :headers="array_merge(
        ['S.N'], 
        isset($activityType) ? [] : ['Activity Type'], 
        isset($ir) ? ['IR', 'Outcomes'] : [],
        ['Activities Name', 'Responsible Partners', 'Unit', 'Budget', 'Actions']
    )"
        :useAddModal="false"
        :name="'province'"
        :addRoute="route('activities.create', ['activity_id' => $activityTypeid ?? ''])">

        @forelse ($activities as $index => $activities)

        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>

            <?php if (!isset($activityType)) { ?>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $activityTypes[$activities->activity_type] ?? 'NA' }}</div>
                </td>
            <?php } else {
            } ?>

            <?php if (isset($ir)) { ?>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $ir[$activities->ir_id] ?? 'NA' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $activities->outcomes->outcome ?? 'NA' }}</div>
                </td>
            <?php } else {
            } ?>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $activities->activities }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $activities->partner ?? '' }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $activities->unit }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $activities->total_budget }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                    <a href="{{ route('activities.view', $activities->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('activities.edit', $activities->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('activities.destroy', $activities->id) }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                No data available
            </td>
        </tr>
        @endforelse
    </x-table-listing>
    @endif

    @if($activityTypeid==3)
    @foreach ($ir as $irId => $irName)
    <div class="mb-4">
        <div class="province border bg-white border-[#D8DAE5] rounded-lg divide-y divide-solid mb-4">
            <div class="flex justify-between items-center cursor-pointer province-header" data-index="{{ $irId }}">
                <div class="flex gap-2 p-4 items-center">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">
                        0{{$irId}}</p>
                    <p class="font-semibold text-md text-blue-600">{{ $irName }}</p>
                </div>
                <span class="text-4xl arrow-icon">
                    <svg class="transform transition-transform duration-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 14L8 10H16L12 14Z"></path>
                    </svg>
                </span>
            </div>
            
            <div class="province-content grid grid-cols-1 gap-4 p-4 hidden">
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <a href="{{ route('activities.create', ['activity_id' => $activityTypeid ?? '']) }}" class="btn bg-[#844a8a] text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path>
                    </svg>
                    <span class="max-xs:sr-only">Add +</span>
                </a>
            </div>    
            <div class="col-span-6 mb-4">
                    <input type="text" class="search-district form-input w-full p-2 border rounded-lg" placeholder="Search activities..." oninput="filterTable(this, {{ $irId }})">
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs bg-gray-50">#</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Outcome</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Activity</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Partner</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Unit</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Total Budget</th>
                            <th class="px-6 py-3 text-xs bg-gray-50">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body-{{ $irId }}">
                        @forelse ($activities->where('ir_id', $irId) as $index => $activity)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $activity->outcomes->outcome ?? 'NA' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $activity->activities }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $activity->partner ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $activity->unit }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $activity->total_budget }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex space-x-4">
                                    <a href="{{ route('activities.view', $activity->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('activities.edit', $activity->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('activities.destroy', $activity->id) }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                No activities available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach


      <!-- Delete Modal -->
      <div id="delete-modal-ir" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <form id="delete-form-ir" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Delete Activity ?
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        Are you sure you want to delete this activity? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Delete
                            </button>
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" onclick="document.getElementById('delete-modal').classList.add('hidden')">
                                Cancel
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
function showDeleteModal(deleteRoute) {
        document.getElementById('delete-form-ir').action = deleteRoute;
        document.getElementById('delete-modal-ir').classList.remove('hidden');
    }

    </script>
    @endif


    <script>
        document.querySelectorAll('.province-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const arrowIcon = header.querySelector('svg');
                content.classList.toggle('hidden');
                arrowIcon.classList.toggle('rotate-180');
            });
        });

        function filterTable(input, irId) {
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll(`#table-body-${irId} tr`);
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        }
    </script>
</x-app-layout>