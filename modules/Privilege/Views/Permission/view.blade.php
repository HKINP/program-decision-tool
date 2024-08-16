<x-app-layout>
    <x-table-listing
        :headers="['S.N', 'Roles', 'Users']"
        :title="'Permission: ' . $permission->permission_name"
        :useAddModal="false"
        :name="'permissions'"
        :addRoute="route('permission.create')">

        @forelse($permission->roles as $index => $role)
            <tr class="gradeX" id="row_{{ $role->id }}">
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $role->name }} <!-- Change to the correct role attribute -->
                </td>
                <td>
                    @foreach($role->users as $user)
                        {!! $user->full_name !!} - {!! $user->getOfficeName() !!}
                        @unless($loop->last) <br /> @endunless
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    No data available
                </td>
            </tr>
        @endforelse

    </x-table-listing>
</x-app-layout>
