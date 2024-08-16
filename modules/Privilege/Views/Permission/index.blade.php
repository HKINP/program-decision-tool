<x-app-layout>
    <x-table-listing
    :headers="['S.N', 'Permission Name', 'Guard Name', 'Updated By','Actions']" 
    :title="'Permissions'" 
    :useAddModal="false" 
    :name="'permissions'" 
    :addRoute="route('permission.create')">
    
        @forelse ($permissions as $index => $permission)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900"> {{ $permission->permission_name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900"> {{ $permission->guard_name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900"> {!! $permission->updatedBy ? ($permission->updatedBy->full_name .' on ' . $permission->updated_at) : 'NA' !!}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                    <a href="{{ route('permission.view', $permission->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('permission.edit', $permission->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('permission.destroy', $permission->id) }}')">
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


