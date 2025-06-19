<x-modal id="editMappingModal" title="Edit Mapping" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form id="editMappingForm" method="POST" enctype="multipart/form-data" class="mt-[10px]">
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

            <x-form-input
                label="Project Name"
                type="select"
                name="project_id"
                id="edit_project_id"
                :options="$projects" />

            <x-form-input
                label="Tablet Name"
                type="select"
                name="tablet_id"
                id="edit_tablet_id"
                :options="$tablets" />

            <x-form-input
                label="Camera Name"
                type="select"
                name="camera_id"
                id="edit_camera_id"
                :options="$cameras" />



            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cancelEditMappingModal()"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="button" id="editMappingSubmit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>