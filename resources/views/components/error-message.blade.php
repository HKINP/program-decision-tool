@if ($message)
    <div id="error-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" style="display: block;">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-red-700">Error</h3>
                    <button id="close-modal-error" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-gray-700">{{ $message }}</p>
            </div>
        </div>
    </div>

   <!-- Script to handle modal visibility -->
   <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('error-modal');
            const closeButton = document.getElementById('close-modal-error');

            closeButton.addEventListener('click', () => {
                console.log(modal)
                modal.style.display = 'none';
            });
        });
    </script>
@endif
