<x-modal id="editUserModal" title="Edit User" class="max-w-lg">
    <form method="POST" action="" id="editUserForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_user_id">
        <div class="space-y-4">
            <!-- User Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_user_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">User Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="user_name" id="edit_user_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter user name">
                    @error('user_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_email" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Email</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="email" name="email" id="edit_email" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter email">
                    @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Company Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_company_id" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Company Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="company_id" id="edit_company_id" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Company</option>
                        @foreach($companies as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Project Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_project_id" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Project Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="project_id" id="edit_project_id" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Project</option>
                        @foreach($projects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Location -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_location" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Location</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="location" id="edit_location" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter location">
                    @error('location')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Access Level -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_access_level" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Access Level</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="access_level" id="edit_access_level" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter access level">
                    @error('access_level')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Date -->
            <!-- <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_date" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Date</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="date" name="date" id="edit_date" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]">
                    @error('date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div> -->

            <!-- Image Upload -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_user_image" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Upload Image</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="file" name="image" id="edit_user_image" class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#3D3D3D] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB]">
                    @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editUserModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-[#3D3D3D] text-white rounded-lg hover:bg-[#2D2D2D] transition-colors">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>