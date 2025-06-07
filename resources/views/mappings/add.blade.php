<x-modal id="createMappingModal" title="Create Mapping" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form method="POST" action="{{ route('mappings.store') }}" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        <div class="space-y-4">
            <x-form-input
                label="Company Name"
                type="select"
                name="company_id"
                id="company_id"
                :options="$companies" />
            @error('company_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Project Name"
                type="select"
                name="project_id"
                id="project_id"
                :options="$projects" />
            @error('project_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Camera Name"
                type="select"
                name="camera_id"
                id="camera_id"
                :options="$cameras" />
            @error('camera_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Tablet Name"
                type="select"
                name="tablet_id"
                id="tablet_id"
                :options="$tablets" />
            @error('camera_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- <div>
                <label class="block text-sm font-medium text-gray-700">Camera Name</label>
                <div class="flex items-center w-full px-4 py-2 border border-gray-200 rounded-lg focus-within:ring-2 focus-within:ring-green-500">
                    <input type="text" name="camera_name" id="camera_name_input" placeholder="Camera Name" class="flex-grow text-[#7A86A1] text-[14px] focus:outline-none">
                    <button type="button" class="text-[#7A86A1] cursor-pointer"><img src="{{ asset('assets/images/add-camera.png') }}" class="w-[20px] h-[20px] object-contain"></button>
                </div>
                @error('camera_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <p class="text-[#D10039] manrope-regular text-[13px]">
                    <span class="mr-[8px]">Camera 01</span>
                    <span class="mr-[8px]">Camera 02</span>
                </p>
            </div> -->

            <!-- <x-form-input
                label="Streaming Link"
                type="url"
                name="stream_link"
                id="stream_link"
                placeholder="https://www.example.com/api/v1/resources"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('stream_link')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror -->

            <!-- <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-[#7A86A1] text-[14px]">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div> -->

            <!-- <div>
                <label class="block text-sm font-medium text-gray-700">Tablet</label>
                <select name="tablet" id="tablet" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-[#7A86A1] text-[14px]">
                    <option value="ipad">Ipad</option>
                </select>
                @error('tablet')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div> -->

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('createMappingModal')"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>