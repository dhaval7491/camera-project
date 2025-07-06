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
            label-class="block text-[13px] manrope-regular text-[#000000]" />


        <div class="flex flex-wrap mb-[15px]">
            <div class="lg:w-2/6 w-full">
                <label for="company_id" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Company Name</label>
            </div>
            <div class="lg:w-4/6 w-full">
                <select name="companies[]" id="companies" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] select2">
                    <option value="">Select Company</option>
                    @foreach($companies as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <div id="companies_error" class="text-red-500 text-sm hidden"></div>
            </div>
        </div>    

        <!-- <x-form-input
            label="Company Name"
            type="select2"
            name="companies"
            id="companies"
            :options="$companies"
            :multiple="true"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[13px] manrope-regular text-[#000000]" /> -->

        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="p_location"
            placeholder="Enter location"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[13px] manrope-regular text-[#000000]" />       

        <div class="text-right mt-[50px] mb-[20px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModal('createProjectModal')">
                Cancel
            </button>
            <button type="button" id="createProjectSubmit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                <span class="create-text">Create</span>
                <svg class="animate-spin h-5 w-5 text-white hidden create-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </form>
</x-modal>