<x-modal id="editMappingModal" title="Edit Mapping" class="max-w-lg">
    <form method="POST" action="" id="editMappingForm">
        @csrf
        @method('PUT')
        <div class="space-y-4">
        <input type="hidden" name="id" id="edit_mapping_id">
            <x-form-input
                label="Company Name"
                type="select"
                name="company_id"
                id="edit_company_id"
                :options="$companies" />
            @error('company_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Project Name"
                type="select"
                name="project_id"
                id="edit_project_id"
                :options="$projects" />
            @error('project_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-form-input
                label="Equipment Name"
                type="select"
                name="equipment_id"
                id="edit_equipment_id"
                :options="$equipments" />
            @error('equipment_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editMappingModal')"
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