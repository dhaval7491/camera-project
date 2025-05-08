<x-modal id="editEquipmentModal" title="Edit Equipment" class="max-w-lg">
    <form method="POST" action="" id="editEquipmentForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_equipment_id">
        <div class="space-y-4">
            <!-- Equipment Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Equipment Type</label>
                <div class="flex space-x-4 mt-1">
                    <label class="flex items-center">
                        <input type="radio" name="type" value="camera" class="mr-2" id="edit_type_camera">
                        Camera
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="type" value="tablet" class="mr-2" id="edit_type_tablet">
                        Tablet
                    </label>
                </div>
            </div>

            <!-- Common Fields -->
            <div class="space-y-4">
                <x-form-input
                    label="Equipment Name"
                    type="text"
                    name="equipment_name"
                    id="edit_equipment_name"
                    placeholder="Enter Equipment Name"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('equipment_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <x-form-input
                    label="Equipment Code"
                    type="text"
                    name="equipment_code"
                    id="edit_equipment_code"
                    placeholder="#2356523"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('equipment_code')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <x-form-input
                    label="Password"
                    type="password"
                    name="password"
                    id="edit_password"
                    placeholder="Enter Password"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <!-- Camera Specific Field -->
                <div id="cameraFields" class="space-y-4">
                    <x-form-input
                        label="Streaming Link"
                        type="url"
                        name="stream_link"
                        id="edit_stream_link"
                        placeholder="https://www.example.com/api/v1/resources/d"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                    @error('stream_link')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editEquipmentModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('#editEquipmentModal input[name="type"]');
        const cameraFields = document.getElementById('cameraFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'camera') {
                    cameraFields.classList.remove('hidden');
                } else if (this.value === 'tablet') {
                    cameraFields.classList.add('hidden');
                }
            });
        });
    });
</script>