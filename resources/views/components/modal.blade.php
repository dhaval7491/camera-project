@props([
    'id' => 'modal',
    'title' => 'Modal Title',
    'class' => '',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Modal Container -->
    <div class="relative bg-white rounded-[40px] shadow-xl max-w-lg mx-auto sm:my-8 sm:align-middle transform transition-all {{ $class }}">
        
        <!-- Modal Header -->
        <div class="flex justify-between items-center px-6 pt-6 pb-2">
            <h4 class="manrope-medium font-medium text-[18px] text-black">
                {{ $title }}
            </h4>
            <button onclick="toggleModal('{{ $id }}')" class="focus:outline-none">
                <img src="{{ asset('admin-theme/assets/images/modal-cross.png') }}"
                     class="border-[1px] rounded-[7px] border-[#EBEBEB] bg-white p-[11px] w-[36px] cursor-pointer"
                     alt="Close">
            </button>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="px-6 pb-6 max-h-[80vh] mt-[10px] overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
</div>


<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>