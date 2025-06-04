<x-modal id="editMappingModal" title="Edit Mapping" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form method="POST" action="" id="editMappingForm">
        @csrf
        @method('PUT')
        <div class="space-y-4">
        <input type="hidden" name="id" id="edit_mapping_id">
            <x-form-input
                label="Company Name"
                type="select"
                name="company_id"
                id="edit_company_id"
                :options="$companies" />
            @error('company_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Project Name"
                type="select"
                name="project_id"
                id="edit_project_id"
                :options="$projects" />
            @error('project_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Camera Name"
                type="select"
                name="camera_id"
                id="edit_camera_id"
                :options="$cameras" />
            @error('camera_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Tablet Name"
                type="select"
                name="tablet_id"
                id="edit_tablet_id"
                :options="$tablets" />
            @error('tablet_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editMappingModal')"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>