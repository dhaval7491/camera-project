<x-modal id="createCompanyModal" title="Create a New Company" class="max-w-lg">
    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <x-form-input
                label="Company Name"
                type="text"
                name="company_name"
                id="company_name"
                placeholder="Enter Company Name"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('company_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Logo</label>
                <input type="file" id="logo" name="logo"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('logo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input
                label="Location"
                type="text"
                name="location"
                id="location"
                placeholder="Enter Company Location"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('location')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <p class="text-lg font-semibold text-gray-800">Admin Details</p>

            <x-form-input
                label="Admin Name"
                type="text"
                name="admin_name"
                id="admin_name"
                placeholder="Enter Admin Name"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('admin_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Admin Mail ID"
                type="email"
                name="admin_email"
                id="admin_email"
                placeholder="Enter Admin Mail ID"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('admin_email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Admin Password"
                type="password"
                name="admin_password"
                id="admin_password"
                placeholder="Enter Password"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
            @error('admin_password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('createCompanyModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>