<x-modal id="createEquipmentModal" title="Add Equipment" class="max-w-lg">
    <form method="POST" action="{{ route('equipments.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <!-- Equipment Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Equipment Type</label>
                <div class="flex space-x-4 mt-1">
                    <label class="flex items-center">
                        <input type="radio" name="type" value="camera" checked class="mr-2">
                        Camera
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="type" value="tablet" class="mr-2">
                        Tablet
                    </label>
                </div>
            </div>

            <!-- Camera Fields -->
            <div id="cameraFields" class="space-y-4">
                <x-form-input
                    label="Add Camera Name"
                    type="text"
                    name="camera_name"
                    id="camera_name"
                    placeholder="Enter Camera Name"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('camera_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <x-form-input
                    label="Add Streaming Link"
                    type="url"
                    name="stream_link"
                    id="stream_link"
                    placeholder="https://www.example.com/api/v1/resources/d"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('stream_link')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <x-form-input
                    label="Add Camera Code"
                    type="text"
                    name="camera_code"
                    id="camera_code"
                    placeholder="#2356523"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('camera_code')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <x-form-input
                    label="Password"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter Password"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tablet Fields -->
            <div id="tabletFields" class="space-y-4 hidden">
                <x-form-input
                    label="Map Tablet"
                    type="text"
                    name="map_tablet"
                    id="map_tablet"
                    placeholder="Enter Tablet Name"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('map_tablet')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('createEquipmentModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="type"]');
        const cameraFields = document.getElementById('cameraFields');
        const tabletFields = document.getElementById('tabletFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'camera') {
                    cameraFields.classList.remove('hidden');
                    tabletFields.classList.add('hidden');
                } else if (this.value === 'tablet') {
                    cameraFields.classList.add('hidden');
                    tabletFields.classList.remove('hidden');
                }
            });
        });
    });
</script>