@props([
    'label' => '',
    'type' => 'text',
    'placeholder' => '',
    'name' => '',
    'class' => '',
    'id' => '',
])

<div class="flex flex-wrap mb-[30px]">
    @if($label)
        <div class="lg:w-2/6 w-full">
            <label class="block text-[15px] manrope-regular font-normal text-[#000000]">{{ $label }}</label>
        </div>
    @endif

    <div class="lg:w-4/6 w-full">
        @if($type === 'file')
            <input
                type="file"
                name="{{ $name }}"
                id="{{ $id }}"
                class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#3D3D3D] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB] {{ $class }}"
            />
        @else
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $id }}"
                placeholder="{{ $placeholder }}"
                class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] {{ $class }}"
            />
        @endif
    </div>
</div>