<x-app-layout>
    <x-table-listing
        :headers="['S.N', 'User Name', 'User Email', 'Actions']"
        :title="'Users'"
        :useAddModal="false"
        :name="'user'"
        :addRoute="route('user.create')">

        @forelse ($users as $index => $user)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900">{{ $user->email }}</div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex space-x-4">
                    <a href="javascript:void(0);" class="text-blue-500 hover:text-blue-700 openChangePasswordModal" data-id="{{ $user->id }}">
                        <i class="fas fa-key"></i>
                    </a>


                    <a href="{{ route('user.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('user.destroy', $user->id) }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
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

    <!-- Change Password Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="changePasswordModal" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal Panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="changePasswordModalLabel">Change Password</h3>
                            <div class="mt-2">
                                <form id="changePasswordForm" method="POST" action="{{ route('user.change.password') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" id="user_id">
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <span id="passwordError" class="text-red-500 text-sm hidden">Password and Confirm Password must match</span>
                                    </div>
                                    <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">Update Password</button>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" data-dismiss="modal">Close</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Open modal and set user ID
            document.querySelectorAll('.openChangePasswordModal').forEach(function(button) {
                button.addEventListener('click', function() {
                    var userId = this.getAttribute('data-id');
                    document.getElementById('user_id').value = userId;

                    // Show the modal
                    document.getElementById('changePasswordModal').classList.remove('hidden');
                });
            });

            // Close modal
            document.querySelectorAll('[data-dismiss="modal"]').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.getElementById('changePasswordModal').classList.add('hidden');
                });
            });

            // Password confirmation validation
            document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('password_confirmation').value;
                var passwordError = document.getElementById('passwordError');

                if (password !== confirmPassword) {
                    event.preventDefault(); // Prevent form submission
                    passwordError.classList.remove('hidden'); // Show error message
                } else {
                    passwordError.classList.add('hidden'); // Hide error message if passwords match
                }
            });
        });
    </script>

</x-app-layout>