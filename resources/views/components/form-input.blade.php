@props([
'label' => '',
'type' => 'text',
'placeholder' => '',
'name' => '',
'class' => '',
'id' => '',
'options' => [], // Array to handle select options
'labelclass' => 'block text-[13px] manrope-regular text-[#000000]', // Added default label class
'multiple' => false, // Added multiple prop for select2
'readonly' => false
])

<div class="flex flex-wrap mb-[15px]">
    @if($label)
    <div class="lg:w-2/6 w-full">
        <label class="{{ $labelclass }}">{{ $label }}</label>
    </div>
    @endif

    <div class="lg:w-4/6 w-full">
        @if($type === 'file')
        <!-- <input
            type="file"
            name="{{ $name }}"
            id="{{ $id }}"
            class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB] {{ $class }}" /> -->
            <div class="flex">
            <label for="profile_image" class="flex items-center w-[40%] gap-2 px-4 py-2 border border-[#EBEBEB] rounded-[16px] text-[#6B7280] hover:bg-gray-100 transition mt-[-5px] cursor-pointer h-[43px]" style="width:40%; color:#6B7280; border-radius:16px; padding: 10px 16px;"><img src="http://localhost/unniffy/public/assets/images/upload.png" class="w-[12px]" style="width:12px;"><span class="manrope-regular text-[12px]">Browse files</span>
            </label>
            <input
                type="file"
                name="{{ $name }}"
                id="profile_image"
                class="hidden"
            />
            <img src="" class="w-[50px] border-solid border-[1px] border-[#ebebeb] mt-[-3px] rounded-[8px] ml-[7px] object-contain" style="height:36px; margin-top:-3px; margin-left:7px;">
            </div>
        <div id="{{ $id }}_error" class="text-red-500 text-sm hidden"></div>
        @elseif($type === 'select')
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] {{ $class }}">
            <option value="">Select {{ $label }}</option>
            @if(!empty($options))
            @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
            @else
            <option value="">No options available</option>
            @endif
        </select>
        <div id="{{ $id }}_error" class="text-red-500 text-sm hidden"></div>
        @elseif($type === 'select2')
        <select
            name="{{ $multiple ? $name . '[]' : $name }}"
            id="{{ $id }}"
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] select2 {{ $class }}">
            <option value="">Select {{ $label }}</option>
            @if(!empty($options))
            @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
            @else
            <option value="">No options available</option>
            @endif
        </select>
        <div id="{{ $id }}_error" class="text-red-500 text-sm hidden"></div>
        @push('scripts')
        <script>
            $(document).ready(function() {
                $('#{{ $id }}').select2({
                    placeholder: "{{ $placeholder ?: 'Select ' . $label }}",
                    allowClear: true,
                    width: '100%',
                    theme: 'default',
                    dropdownCssClass: 'text-[14px] text-[#7A86A1]',
                    selectionCssClass: 'h-[44px] rounded-[18px] border-[#EBEBEB] border-[1px] p-[7px]',
                    multiple: {{ $multiple ? 'true' : 'false' }}
                });
            });
        </script>
        @endpush
        @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            @if($readonly) readonly @endif
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] {{ $class }}" />
        <div id="{{ $id }}_error" class="text-red-500 text-sm hidden"></div>
        @endif
    </div>
</div>