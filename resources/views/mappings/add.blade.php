<x-modal id="createMappingModal" title="Create Mapping" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form id="createMappingForm" method="POST" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        <div class="space-y-4">
            <x-form-input
                label="Company Name"
                type="select"
                name="company_id"
                id="company_id"
                :options="$companies" />

            <x-form-input
                label="Project Name"
                type="select"
                name="project_id"
                id="project_id"
                :options="[]" />

            <x-form-input
                label="Tablet Name"
                type="select"
                name="tablet_id"
                id="tablet_id"
                :options="$tablets" />

            <x-form-input
                label="Camera Name"
                type="select"
                name="camera_id"
                id="camera_id"
                :options="$cameras" />

            <div class="flex justify-end space-x-3 mt-[50px] mt-[50px]">
                <button type="button" onclick="cancelCreateMappingModal()"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="button" id="createMappingSubmit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>