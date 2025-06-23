<x-modal id="createTrackableModal" title="Add Trackable" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
    <form id="createTrackableForm" method="POST" enctype="multipart/form-data" class="mt-[10px]">
        @csrf
        <div class="space-y-4">
            <!-- Trackable Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="trackable_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Trackable Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="trackable_name" id="trackable_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Trackable name">
                    <div id="trackable_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Other Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="other_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Other Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="other_name" id="other_name" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Other Name">
                    <div id="other_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>
            <!-- Linked Objects -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="linked_objects" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Linked Objects</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <div id="linkedObjectsContainer" class="flex flex-col gap-2">
                        <div class="flex align-middle input-group">
                            <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                            <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" onclick="addNewLinkedObjectField('#linkedObjectsContainer', 'linked_objects[]')">
                                <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                            </button>
                        </div>
                        <div id="linked_objects_error" class="text-red-500 text-sm hidden"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cancelCreateTrackableModal()"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="button" id="createTrackableSubmit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Create
                </button>
            </div>
        </div>
    </form>
</x-modal>

<script>
    function toggleStatus(button) {
        let isActive = $(button).text().trim() === 'Active';
        if (isActive) {
            $(button).text('Inactive').removeClass('bg-[#047413]').addClass('bg-[#F96767]');
            $('#status_input').val('Inactive');
        } else {
            $(button).text('Active').removeClass('bg-[#F96767]').addClass('bg-[#047413]');
            $('#status_input').val('Active');
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