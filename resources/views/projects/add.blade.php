<x-modal id="createProjectModal" title="Create a New Project" class="max-w-lg">
    <form method="POST" action="{{ route('projects.store') }}" id="createProjectForm" enctype="multipart/form-data" class="mt-[40px]">
        @csrf
        <x-form-input
            label="Project Name"
            type="text"
            name="name"
            id="project_name"
            placeholder="Enter project name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <x-form-input
            label="Company Name"
            type="select"
            name="company_id"
            id="company_id"
            :options="$companies"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('company_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="location"
            placeholder="Enter location"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('location')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <x-form-input
            label="Add Plant"
            type="text"
            name="plant_name"
            id="plant_name"
            placeholder="Enter Plant Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('plant_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <div class="text-right mt-[100px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModal('createProjectModal')">
                Cancel
            </button>
            <button type="submit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>