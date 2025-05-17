<x-modal id="editEquipmentModal" title="Edit Equipment" class="max-w-lg">
    <form method="POST" action="" id="editEquipmentForm" enctype="multipart/form-data" class="mt-[40px]">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_equipment_id">
        <!-- Equipment Type -->
        <div class="mb-[30px]">
            <label class="block text-[15px] manrope-regular text-[#000000]">Equipment Type</label>
            <div class="flex space-x-4 mt-1">
                <label class="flex items-center">
                    <input type="radio" name="type" value="camera" class="h-[20px] w-[20px] text-[#437651] focus:ring-[#437651] mr-2" id="edit_type_camera">
                    Camera
                </label>
                <label class="flex items-center">
                    <input type="radio" name="type" value="tablet" class="h-[20px] w-[20px] text-[#437651] focus:ring-[#437651] mr-2" id="edit_type_tablet">
                    Tablet
                </label>
            </div>
            @error('type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Common Fields -->
        <x-form-input
            label="Equipment Name"
            type="text"
            name="equipment_name"
            id="edit_equipment_name"
            placeholder="Enter Equipment Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('equipment_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Equipment Code"
            type="text"
            name="equipment_code"
            id="edit_equipment_code"
            placeholder="#2356523"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('equipment_code')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Password"
            type="password"
            name="password"
            id="edit_password"
            placeholder="Enter Password"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Camera Specific Field -->
        <div id="editcameraFields" class="mb-[30px]">
            <x-form-input
                label="Streaming Link"
                type="url"
                name="stream_link"
                id="edit_stream_link"
                placeholder="https://www.example.com/api/v1/resources/d"
                class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
                label-class="block text-[15px] manrope-regular text-[#000000]" />
            @error('stream_link')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right mt-[100px]">
            <button type="button" onclick="toggleModal('editEquipmentModal')"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                Cancel
            </button>
            <button type="submit"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Update
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eradioButtons = document.querySelectorAll('#editEquipmentModal input[name="type"]');
            const ecameraFields = document.getElementById('editcameraFields');

            // Function to set initial state based on equipment type
            function setInitialState() {
                const selectedType = document.querySelector('#editEquipmentModal input[name="type"]:checked')?.value;
                if (selectedType === 'camera') {
                    cameraFields.classList.remove('hidden');
                } else {
                    cameraFields.classList.add('hidden');
                }
            }

            // Set initial state when modal is opened
            setInitialState();

            // Update state on radio button change
            eradioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'camera') {
                        ecameraFields.classList.remove('hidden');
                    } else if (this.value === 'tablet') {
                        ecameraFields.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-modal>