<x-modal id="createProjectModal" title="Create a New Project" class="max-w-lg">
    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @csrf
        <x-form-input
            label="Project Name"
            type="text"
            name="name"
            placeholder="Enter project name"
            class="text-[#7A86A1]" />
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <x-form-input
            label="Company Name"
            type="select"
            name="company_id"
            :options="$companies" />
            @error('company_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Location"
            type="text"
            name="location"
            placeholder="Enter location"
            class="text-[#7A86A1]" />
            @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Add Plant"
            type="text"
            name="plant_name"
            placeholder="Enter Plant Name"
            class="text-[#7A86A1]" />
            @error('plant_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="text-right mt-[100px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModalp()">
                Cancel
            </button>
            <button type="submit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#3D3D3D] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>