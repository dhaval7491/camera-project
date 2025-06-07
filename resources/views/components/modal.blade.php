@props([
    'id' => 'modal',
    'title' => 'Modal Title',
    'class' => '',
])

<div id="{{ $id }}" class="fixed inset-0 z-10 flex items-center justify-center hidden">
    <!-- Modal Overlay -->
    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>

    <!-- Modal Container -->
    <div class="{{ $class }}" style="width:550px !important;">
        
        <!-- Modal Header -->
        <div class="flex justify-between py-[10px] mb-[20px]">
            <h4 class="manrope-bold font-medium text-[18px] text-black mt-[10px]">
                {{ $title }}
            </h4>
            <button onclick="toggleModal('{{ $id }}')" class="focus:outline-none">
                <img src="{{ asset('admin-theme/assets/images/modal-cross.png') }}"
                     class="border-[1px] rounded-[15px] border-[#EBEBEB] border-solid bg-white p-[11px] w-[36px] cursor-pointer"
                     alt="Close">
            </button>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="max-h-[80vh] overflow-y-auto">
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