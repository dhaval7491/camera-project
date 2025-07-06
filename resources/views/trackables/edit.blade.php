<x-modal id="editTrackableModal" title="Edit Trackable" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
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
                    <input type="text" name="trackable_name" id="edit_trackable_name" value="{{ old('trackable_name', $trackable->trackable_name ?? 'Test Trackable 3') }}" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Trackable name">
                    <div id="trackable_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Other Name -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_other_name" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Other Name</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <input type="text" name="other_name" id="edit_other_name" value="{{ old('other_name', $trackable->other_name ?? 'Test 3') }}" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px]" placeholder="Other Name">
                    <div id="other_name_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <!-- Linked Objects -->
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full">
                    <label for="edit_linked_objects" class="block text-[14px] manrope-regular text-[#000000] mt-[7px]">Linked Objects</label>
                </div>
                <div class="lg:w-4/6 w-full">
                    <div id="editLinkedObjectsContainer" class="flex flex-col gap-2">
                        <!-- Blank input with Add button at the top -->
                        <div class="flex align-middle input-group">
                            <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Type" oninput="checkEditInput(this)">
                            <button id="addLinkedObject" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" disabled>
                                <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                            </button>
                        </div>
                        <!-- Existing linked objects with Delete buttons -->
                        @foreach ($trackable->linked_objects ?? ['Test 3'] as $linkedObject)
                            <div class="flex align-middle input-group">
                                <input type="text" name="linked_objects[]" value="{{ $linkedObject }}" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                                <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center remove-linked-object">
                                    <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete">
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div id="linked_objects_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-[50px]">
                <button type="button" onclick="toggleModal('editTrackableModal')"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer">
                    Cancel
                </button>
                <button type="submit"
                    class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#437651] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-modal>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
        function checkEditInput(input) {
            const addButton = input.nextElementSibling;
            addButton.disabled = input.value.trim() === '';
        }

        document.getElementById('addLinkedObject').addEventListener('click', function(event) {
            event.preventDefault();
            addEditNewField(this);
        });

        function addEditNewField(addBtn) {
            const input = addBtn.previousElementSibling;
            if (input.value.trim() === '') return;

            // Convert the current input and add button to a new div with a delete button
            let currentDiv = input.parentElement;
            let newDeleteButton = document.createElement('button');
            newDeleteButton.className = "border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center";
            newDeleteButton.innerHTML = '<img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete">';
            newDeleteButton.addEventListener('click', function() {
                currentDiv.remove();
            });
            currentDiv.removeChild(addBtn);
            currentDiv.appendChild(newDeleteButton);

            // Create a new input field row to be inserted at the top
            let newDiv = document.createElement('div');
            newDiv.classList.add('flex', 'align-middle', 'input-group');
            let newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'linked_objects[]';
            newInput.className = "h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]";
            newInput.placeholder = "Enter Type";
            newInput.oninput = function() { checkInput(this); };
            let newAddButton = document.createElement('button');
            newAddButton.className = "border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center";
            newAddButton.innerHTML = '<img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">';
            newAddButton.disabled = true;
            newAddButton.addEventListener('click', function(event) {
                event.preventDefault();
                addNewField(this);
            });

            newDiv.appendChild(newInput);
            newDiv.appendChild(newAddButton);

            // Insert new div at the top
            let container = document.getElementById('editLinkedObjectsContainer');
            container.insertBefore(newDiv, container.firstChild);

            // Keep the current input value and disable the new add button until edited
            addBtn.disabled = true;
        }

        // Add event listeners for existing remove buttons
        document.querySelectorAll('.remove-linked-object').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });

        function toggleEditStatus(button) {
            let isActive = button.textContent.trim() === 'Active';
            if (isActive) {
                button.textContent = 'Inactive';
                button.classList.remove('bg-[#047413]');
                button.classList.add('bg-[#F96767]');
                document.getElementById('edit_status_input').value = 'Inactive';
            } else {
                button.textContent = 'Active';
                button.classList.remove('bg-[#F96767]');
                button.classList.add('bg-[#047413]');
                document.getElementById('edit_status_input').value = 'Active';
            }
        }
    // });
</script>