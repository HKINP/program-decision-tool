<x-app-layout>
    <div class="max-w-full mt-6 mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Role</h2>
        
        <form action="{{ route('role.update', $role->id) }}" method="post" class="space-y-6">
            <input type="hidden" name="_method" value="PUT">
            
            <div class="md:w-1/2 w-full">
                <label for="role" class="block text-sm font-medium text-gray-700">Role Name *</label>
                <input 
                    id="role" 
                    name="role" 
                    type="text" 
                    value="{!! $role->role !!}" 
                    placeholder="Enter Role Name" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>
            
            <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden">
                <thead>
                    <tr class="bg-gray-200">
                        <th colspan="2" class="py-3 px-4 text-left text-sm font-medium text-gray-700">
                            Permissions
                        </th>
                    </tr>
                </thead>
                <tbody id="tablebody">
                    <tr>
                        <td colspan="2" class="py-3 px-4">
                            <input type="checkbox" id="check-all" class="check-all mr-2" value="all" />
                            Give All Permissions
                        </td>
                    </tr>
                    @foreach($permissions as $permission)
                        <tr>
                            <td class="py-3 px-4">
                                <input type="checkbox" name="permissions[]" class="check-permission parent-permission mr-2" value="{{ $permission->id }}"
                                       @if(in_array($permission->id, $rolePermissions)) checked="checked" @endif />
                                {{ $permission->permission_name }}
                            </td>
                            <td class="py-3 px-4">
                                @if($permission->childrens)
                                <table class="min-w-full child-table">
                                    @foreach($permission->childrens->chunk(3) as $chunks)
                                        <tr>
                                            @foreach($chunks as $child)
                                            <td class="py-2 px-4">
                                                <input type="checkbox" name="permissions[]" class="check-permission child-permission mr-2" data-parent-id="{{ $permission->id }}" value="{{ $child->id }}"
                                                       @if(in_array($child->id, $rolePermissions)) checked="checked" @endif />
                                                {{ $child->permission_name }}
                                            </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

          
            {!! csrf_field() !!}
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Submit
            </button>
        </form>
    </div>
    
    <script>
        // Handle the "Give All Permissions" checkbox
        document.getElementById('check-all').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.check-permission').forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });

        // Handle parent permission checkboxes
        document.querySelectorAll('.parent-permission').forEach(function(parentCheckbox) {
            parentCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                const parentId = this.value;
                
                // Check or uncheck all child permissions
                document.querySelectorAll(`.child-permission[data-parent-id="${parentId}"]`).forEach(function(childCheckbox) {
                    childCheckbox.checked = isChecked;
                });
            });
        });
    </script>
    
</x-app-layout>
