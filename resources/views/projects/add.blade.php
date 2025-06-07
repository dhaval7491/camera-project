<x-modal id="createProjectModal" title="Create a New Project" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form method="POST" action="{{ route('projects.store') }}" id="createProjectForm" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        <x-form-input
            label="Project Name"
            type="text"
            name="name"
            id="project_name"
            placeholder="Enter project name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="project_name_error" class="text-red-500 text-sm hidden"></div>

        <x-form-input
            label="Company Name"
            type="select"
            name="company_id"
            id="company_id"
            :options="$companies"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="company_id_error" class="text-red-500 text-sm hidden"></div>

        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="p_location"
            placeholder="Enter location"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="p_location_error" class="text-red-500 text-sm hidden"></div>

        <x-form-input
            label="Add Plant"
            type="text"
            name="plant_name"
            id="plant_name"
            placeholder="Enter Plant Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="plant_name_error" class="text-red-500 text-sm hidden"></div>

        <div class="text-right mt-[50px] mb-[20px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModal('createProjectModal')">
                Cancel
            </button>
            <button type="button" id="createProjectSubmit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>