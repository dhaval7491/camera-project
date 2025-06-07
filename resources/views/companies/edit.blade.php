<x-modal id="editCompanyModal" title="Edit Company" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form id="editCompanyForm" method="POST" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_company_id">
        <x-form-input
            label="Company Name"
            type="text"
            name="company_name"
            id="edit_company_name"
            placeholder="Enter Company Name"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="edit_company_name_error" class="text-red-500 text-sm hidden"></div>

        <x-form-input
            label="Upload Logo"
            type="file"
            name="logo"
            id="edit_company_logo"
            class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="edit_company_logo_error" class="text-red-500 text-sm hidden"></div>

        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="edit_company_location"
            placeholder="Enter Company Location"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px]"
            label-class="block text-[15px] manrope-regular text-[#000000]" />
        <div id="edit_company_location_error" class="text-red-500 text-sm hidden"></div>

        <div class="text-right mt-[50px] mb-[20px]">
            <button type="button" onclick="toggleModal('editCompanyModal')"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                Cancel
            </button>
            <button type="button" id="editCompanySubmit"
                class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Update
            </button>
        </div>
    </form>
</x-modal>