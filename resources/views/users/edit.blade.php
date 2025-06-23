<x-modal id="editUserModal" title="Edit User" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form method="POST" action="" id="editUserForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_user_id">
        <div class="space-y-4">
            <!-- User Name -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_user_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">User Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="user_name" id="edit_user_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter user name">
                    <div id="edit_user_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Email -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_email" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Email</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="email" name="email" id="edit_email" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter email">
                    <div id="edit_email_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Company Name -->
            <div class="flex flex-wrap mb-[15px]">
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
                    <div id="edit_company_id_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Project Name -->
            <div class="flex flex-wrap mb-[15px]">
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
                    <div id="edit_project_id_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Location -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_location" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Location</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="location" id="edit_location" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter location">
                    <div id="edit_location_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Access Level -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_access_level" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Access Level</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="access_level" id="edit_access_level" class="h-[44px] w-full border-[1px] rounded-[14px] border-[#EBEBEB] bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Access Level</option>
                        @foreach ($permissions as $id => $permission)
                        <option value="{{ $permission }}">{{ ucfirst($permission) }}</option>
                        @endforeach
                    </select>
                    <div id="edit_access_level_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Image Upload -->
            <!-- <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_user_image" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Upload Image</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="file" name="image" id="edit_user_image" class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB]">
                    <div id="edit_user_image_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div> -->

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cancelEditUserModal()"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="button" id="editUserSubmit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>