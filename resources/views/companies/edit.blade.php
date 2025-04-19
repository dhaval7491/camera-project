<x-modal id="editCompanyModal" title="Edit Company" class="max-w-lg">
    <form method="POST" action="" id="editCompanyForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <input type="hidden" name="id" id="edit_company_id">
            <x-form-input
                label="Company Name"
                type="text"
                name="company_name"
                id="edit_company_name"
                placeholder="Enter Company Name"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Logo</label>
                <input type="file" name="logo" id="edit_company_logo"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <x-form-input
                label="Location"
                type="text"
                name="location"
                id="edit_company_location"
                placeholder="Enter Company Location"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editCompanyModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>