<x-modal id="createUserModal" title="Create a New User" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form method="POST" action="{{ route('users.store') }}" id="createUserForm" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <!-- User Name -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="user_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">User Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="user_name" id="user_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter user name">
                    <div id="user_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Email -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="email" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Email</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="email" name="email" id="email" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter email">
                    <div id="email_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Company Name -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="company_id" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Company Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="companies" id="u_company_id" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Company</option>
                        @foreach($companies as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <div id="u_company_id_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Project Name -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="project_id" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Project Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="projects" id="u_project_id" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Project</option>
                        
                    </select>
                    <div id="u_project_id_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Location -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="location" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Location</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="location" id="u_location" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Enter location">
                    <div id="u_location_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Access Level -->
            <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="access_level" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Access Level</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <select name="access_level" id="access_level" class="h-[44px] w-full border-[1px] rounded-[14px] border-[#EBEBEB] bg-white p-[7px] text-[#7A86A1] text-[14px]">
                        <option value="">Select Access Level</option>
                        @foreach ($permissions as $id => $permission)
                        <option value="{{ $permission }}">{{ ucfirst($permission) }}</option>
                        @endforeach
                    </select>

                    <div id="access_level_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Image Upload -->
            <!-- <div class="flex flex-wrap mb-[15px]">
                <div class="lg:w-2/6 w-full">
                    <label for="image" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Upload Image</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="file" name="image" id="image" class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB]">
                    <div id="image_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div> -->

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cancelCreateUserModal()"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="button" id="createUserSubmit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>