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
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="changePasswordForm" method="POST" action="{{ route('user.change.password') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   // Event delegation for handling clicks on elements with class 'openChangePasswordModal'
document.addEventListener('click', function (event) {
    if (event.target.closest('.openChangePasswordModal')) {
        // Get the user ID from the clicked element's data-id attribute
        const userId = event.target.closest('.openChangePasswordModal').getAttribute('data-id');
        
        // Set the user ID in the hidden input field inside the modal
        document.getElementById('user_id').value = userId;

        // Show the modal
        const modal = document.getElementById('changePasswordModal');
        modal.classList.add('show');
        modal.style.display = 'block';
        modal.removeAttribute('aria-hidden');
        modal.setAttribute('aria-modal', 'true');
        modal.setAttribute('role', 'dialog');

        // Add backdrop for modal
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        document.body.appendChild(backdrop);
    }
});

// Function to hide the modal
function hideModal() {
    const modal = document.getElementById('changePasswordModal');
    modal.classList.remove('show');
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden', 'true');
    modal.removeAttribute('aria-modal');
    modal.removeAttribute('role');

    // Remove the backdrop
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.parentNode.removeChild(backdrop);
    }
}

// Event listener for closing the modal when the close button is clicked
document.querySelector('#changePasswordModal .close').addEventListener('click', hideModal);

// Event listener for closing the modal when the 'Close' button is clicked
document.querySelector('#changePasswordModal .btn-secondary').addEventListener('click', hideModal);

</script>

</x-app-layout>