<x-modal id="editTrackableModal" title="Edit Trackable" class="max-w-lg">
    <form method="POST" action="" id="editTrackableForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_trackable_id">
        <div class="space-y-4">
            <!-- Trackable Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_trackable_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Trackable Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="trackable_name" id="edit_trackable_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Trackable name">
                    @error('trackable_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Other Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_other_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Other Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="other_name" id="edit_other_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Other Name">
                    @error('other_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Linked Objects -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_linked_objects" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Linked Objects</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <div id="editLinkedObjectsContainer" class="flex flex-col gap-2">
                        <!-- Populated via AJAX -->
                    </div>
                    @error('linked_objects.*')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('editTrackableModal')"
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

<script>
    function toggleEditStatus(button) {
        let isActive = $(button).text().trim() === 'Active';
        if (isActive) {
            $(button).text('Inactive').removeClass('bg-[#047413]').addClass('bg-[#F96767]');
            $('#edit_status_input').val('Inactive');
        } else {
            $(button).text('Active').removeClass('bg-[#F96767]').addClass('bg-[#047413]');
            $('#edit_status_input').val('Active');
        }
    }

    function addNewLinkedObjectField(containerId, inputName) {
        let container = $(containerId);
        let newDiv = $('<div>').addClass('flex align-middle input-group');
        let newInput = $('<input>')
            .attr('type', 'text')
            .attr('name', inputName)
            .addClass('h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]')
            .attr('placeholder', 'Enter Linked Object');
        let newButton = $('<button>')
            .attr('type', 'button')
            .addClass('border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center')
            .html('<img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete">')
            .on('click', function() { newDiv.remove(); });
        newDiv.append(newInput).append(newButton);
        container.append(newDiv);
    }
</script>