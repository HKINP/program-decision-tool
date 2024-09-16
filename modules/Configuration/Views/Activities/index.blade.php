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