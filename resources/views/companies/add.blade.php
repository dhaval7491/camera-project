<x-modal id="createCompanyModal" title="Create a New Company" class="max-w-lg">
    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" class="mt-[40px]">
        @csrf
        <x-form-input
            label="Company Name"
            type="text"
            name="company_name"
            id="company_name"
            placeholder="Enter Company Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('company_name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Upload Logo"
            type="file"
            name="logo"
            id="logo"
            class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('logo')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="location"
            placeholder="Enter Company Location"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('location')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <p class="block text-[15px] manrope-medium font-bold text-[#000000] mb-[35px]">Admin Details</p>

        <x-form-input
            label="Admin Name"
            type="text"
            name="admin_name"
            id="admin_name"
            placeholder="Enter Admin Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('admin_name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Admin Mail ID"
            type="email"
            name="admin_email"
            id="admin_email"
            placeholder="Enter Admin Mail ID"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('admin_email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Admin Password"
            type="password"
            name="admin_password"
            id="admin_password"
            placeholder="Enter Password"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        @error('admin_password')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="text-right mt-[100px]">
            <button type="button" onclick="toggleModal('createCompanyModal')"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                Cancel
            </button>
            <button type="submit"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>