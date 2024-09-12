<x-app-layout>
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
    :addRoute="route('activities.create')"
>

        @forelse ($activities as $index => $activities)
     
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>

            <?php if(!isset($activityType)){ ?>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $activityTypes[$activities->activity_type] ?? 'NA' }}</div>
                </td>
            <?php }else{} ?>
            
            <?php if(isset($ir)){ ?>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $ir[$activities->ir_id] ?? 'NA' }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $activities->outcomes->outcome ?? 'NA' }}</div>
            </td>
            <?php }else{} ?>
            
            
            
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
</x-app-layout>
