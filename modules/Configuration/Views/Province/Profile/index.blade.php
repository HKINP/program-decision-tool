<x-app-layout>
    <x-table-listing 
    :title="'Province Profile'" 
    :headers="['S.N', 'Province','Indicator', 'Source', 'Total', 'Rural', 'Actions']" 
    :useAddModal="false" 
    :name="'province'" 
    :addRoute="route('provinceprofile.create')"
    
    >
        @forelse ($profile as $index => $profile)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $profile->province->province }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $profile->indicator->indicator_name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $profile->source}}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $profile->all_value}}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $profile->rural_value}}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                   
                    <a href="{{ route('provinceprofile.edit', $profile->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                   
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
