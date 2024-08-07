<x-app-layout>
    <x-table-listing 
    :title="'Questions'" 
    :headers="['S.N','Targeted Groups','Thematic Area', 'Question','Indicator', 'Actions']" 
    :useAddModal="false" 
    :name="'province'" 
    :addRoute="route('question.create')"
    
    >
        @forelse ($questions as $index => $question)

        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $question->targetGroup->target_group  }}</div>
            </td>
            
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $question->thematicArea->thematic_area }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $question->question }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $question->indicator->indicator_name }}</div>
            </td>
           
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                    <!-- <a href="{{ route('threshold.questionid', $question->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-bar-chart"></i>
                    </a> -->
                    <a href="{{ route('question.view', $question->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('question.edit', $question->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('question.destroy', $question->id) }}')">
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
