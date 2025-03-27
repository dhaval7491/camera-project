@props([
    'id' => 'modal',
    'title' => 'Modal Title',
    'class' => '',
])

<div id="{{ $id }}" class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        </div>

        <!-- Spacer for centering -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <!-- Modal Content -->
        <div class="inline-block align-center bg-white rounded-[40px] text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full px-[20px] py-[20px] {{ $class }}"
             role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <!-- Modal Header -->
            <div class="flex justify-between py-[10px]">
                <h4 class="manrope-medium font-medium text-[18px] text-black mt-[10px]">{{ $title }}</h4>
                <span onclick="toggleModal('{{ $id }}')">
                    <img src="{{ asset('admin-theme/assets/images/modal-cross.png') }}" class="border-[1px] rounded-[7px] border-[#EBEBEB] border-solid bg-white p-[11px] w-[36px] cursor-pointer">
                </span>
            </div>

            <!-- Modal Body -->
            <div class="mt-[40px]">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>