<x-modal id="createEquipmentModal" title="Add Equipment" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form id="createEquipmentForm" method="POST" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        <!-- Equipment Type -->
        <div class="mb-[30px] flex space-x-4">
            <label class="block text-[13px] manrope-regular text-[#000000] mb-[10px]" style="width:30%;">Equipment Type</label>
            <div class="flex space-x-4 mb-3 mt-[-5px]">
                <label class="flex items-center">
                    <input type="radio" name="type" value="camera" checked 
                        class="h-[20px] w-[20px] accent-[#437651] focus:ring-[#437651] mr-[10px]">
                    Camera
                </label>
                <label class="flex items-center">
                    <input type="radio" name="type" value="tablet" 
                        class="h-[20px] w-[20px] accent-[#437651] focus:ring-[#437651] mr-[10px]">
                    Tablet
                </label>
            </div>
            <div id="type_error" class="text-red-500 text-sm mt-1 hidden"></div>
        </div>

        <!-- Common Fields -->
        <x-form-input
            label="Equipment Name"
            type="text"
            name="equipment_name"
            id="equipment_name"
            placeholder="Enter Equipment Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[13px] manrope-regular text-[#000000]" />
        
        <x-form-input
            label="Equipment Code"
            type="text"
            name="equipment_code"
            id="equipment_code"
            placeholder="#2356523"
            :readonly="true"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[13px] manrope-regular text-[#000000]" />

        <div class="relative">
            <x-form-input
                label="Password"
                type="password"
                name="password"
                id="password"
                placeholder="Enter Password"
                class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
                label-class="block text-[13px] manrope-regular text-[#000000]" />
            <button type="button" class="absolute right-3 top-[30%] transform -translate-y-[-50%] text-gray-700">
                <i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
            </button>
        </div>

        <div class="text-right mt-[50px] mb-[20px]">
            <button type="button" onclick="cancelCreateEquipmentModal()"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                Cancel
            </button>
            <button type="button" id="createEquipmentSubmit"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>