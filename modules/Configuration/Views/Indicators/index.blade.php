<x-app-layout>
    <x-table-listing 
    :title="'Indicators'" 
    :headers="['S.N','Indicator', 'Actions']" 
    :useAddModal="false" 
    :name="'province'" 
    :addRoute="route('indicators.create')"
    
    >
        @forelse ($indicators as $index => $indicator)
 
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
            
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $indicator->indicator_name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                    <a href="{{ route('indicators.view', $indicator->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('indicators.edit', $indicator->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('indicators.destroy', $indicator->id) }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                No data available
            </td>
        </tr>
        @endforelse
    </x-table-listing>
</x-app-layout>
