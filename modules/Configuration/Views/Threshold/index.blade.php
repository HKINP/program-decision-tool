<x-app-layout>
    <x-table-listing 
    :title="'Threshold Value'" 
    :headers="['S.N', 'Min Value','Max Value','Color', 'Recommendation', 'Actions']" 
    :useAddModal="false" 
    :name="'province'" 
    :addRoute="route('threshold.create')"
    
    >
    @forelse ($threshold as $index => $threshold)
    <tr>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            {{ $threshold->min_value }}</td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            {{ $threshold->max_value }}</td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            {{ $threshold->color }}</td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            {{ $threshold->recommendation }}</td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="flex space-x-4 action-buttons">
                <a href="{{ route('threshold.view', $threshold->id) }}"
                    class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-eye"></i>
                </a>
               
                <button type="button" class="text-yellow-500 hover:text-yellow-700" onclick="showEditModal('{{ route('threshold.update', $threshold->id) }}')">
                    <i class="fas fa-edit"></i>
                </button>
                
            <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('threshold.destroy', $threshold->id) }}')">
                <i class="fas fa-trash"></i>
            </button>
            
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6"
            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
            No data available
        </td>
    </tr>
@endforelse
    </x-table-listing>
</x-app-layout>
