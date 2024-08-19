<x-app-layout>
    <div class="max-w-full mt-6 mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create User</h2>
        
        <form action="{{ route('user.store') }}" method="post" class="space-y-6">
            {!! csrf_field() !!}
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Roles -->
                <div>
                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                    <select name="roles[]" multiple id="roles" class="w-full mt-1 border border-gray-300 multipleselect rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Assigned Province -->
                <div>
                    <label for="assignedProvince" class="block text-sm font-medium text-gray-700">Assigned Province</label>
                    <select name="assignedProvince[]" multiple id="assignedProvince" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ in_array($province->id, old('assignedProvince', [])) ? 'selected' : '' }}>{{ $province->province }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Assigned District -->
                <div>
                    <label for="assignedDistrict" class="block text-sm font-medium text-gray-700">Assigned District</label>
                    <select name="assignedDistrict[]" multiple id="assignedDistrict" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ in_array($district->id, old('assignedDistrict', [])) ? 'selected' : '' }}>{{ $district->district }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 pr-10" placeholder="Password">
                    <button type="button" id="togglePassword" style="margin-top:-4%" class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </button>
                </div>
                
                <!-- Confirm Password -->
                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 pr-10" placeholder="Confirm Password">
                    <button type="button" id="toggleConfirmPassword" style="margin-top:-4%"  class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </button>
                </div>
                
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </form>
    </div>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#assignedProvince').select2({
                placeholder: 'Select Province',
                allowClear: true
            });
            
            $('#assignedDistrict').select2({
                placeholder: 'Select District',
                allowClear: true
            });
    
            // Fetch districts based on selected provinces
            $('#assignedProvince').on('change', function() {
                var provinceIds = $(this).val(); // Get selected province IDs
                
                // AJAX request to fetch districts
                $.ajax({
                    url: '{{ route("district.getdistrictbyprovince") }}', // Route to your controller method
                    type: 'POST',
                    data: {
                        provinceIds: provinceIds,
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        // Check if response has districts data
                        if (response.districts && response.districts.length > 0) {
                            var districtsDropdown = $('#assignedDistrict');
                            districtsDropdown.empty(); // Clear current options
                            
                            $.each(response.districts, function(key, district) {
                                districtsDropdown.append('<option value="' + district.id + '">' + district.district + '</option>');
                            });
                            
                            // Trigger change event to update the Select2
                            districtsDropdown.trigger('change');
                        } else {
                            // Handle case where no districts are found
                            $('#assignedDistrict').empty().append('<option value="">No districts available</option>');
                            $('#assignedDistrict').trigger('change');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        $('#assignedDistrict').empty().append('<option value="">Error loading districts</option>');
                        $('#assignedDistrict').trigger('change');
                    }
                });
            });
    
            function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
                document.getElementById(toggleButtonId).addEventListener('click', function () {
                    const passwordField = document.getElementById(passwordFieldId);
                    const icon = this.querySelector('i');
                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        passwordField.type = 'password';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                });
            }
    
            // Apply toggle functionality to both password fields
            togglePasswordVisibility('password', 'togglePassword');
            togglePasswordVisibility('password_confirmation', 'toggleConfirmPassword');
        });
    </script>
</x-app-layout>
