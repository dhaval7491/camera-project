<x-modal id="createTrackableModal" title="Add Trackable" :onClose="'cancelCreateTrackableModal()'" class="relative inline-block bg-white rounded-[40px] shadow-xl transform transition-all overflow-hidden px-[20px] py-[20px]">
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
                            <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Type" oninput="checkInput(this)">
                            <button id="addButton" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" disabled>
                                <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                            </button>
                        </div>
                    </div>
                    <div id="linked_objects_error" class="text-red-500 text-sm hidden"></div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-[50px]">
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
    // document.addEventListener('DOMContentLoaded', function() {
       function checkInput(input) {
            const addButton = input.nextElementSibling;
            addButton.disabled = input.value.trim() === '';
        }

        document.getElementById('addButton').addEventListener('click', function(event) {
            event.preventDefault();
            addNewField(this);
        });

        function addNewField(addBtn) {
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
            let container = document.getElementById('linkedObjectsContainer');
            container.insertBefore(newDiv, container.firstChild);

            // Keep the current input value and disable the new add button until edited
            addBtn.disabled = true;
        }

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
    // });
</script>