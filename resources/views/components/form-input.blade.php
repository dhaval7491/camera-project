@props([
'label' => '',
'type' => 'text',
'placeholder' => '',
'name' => '',
'class' => '',
'id' => '',
'options' => [], // Array to handle select options
'labelclass' => 'block text-[15px] manrope-regular text-[#000000]', // Added default label class
'multiple' => false // Added multiple prop for select2
])

<div class="flex flex-wrap mb-[15px]">
    @if($label)
    <div class="lg:w-2/6 w-full">
        <label class="{{ $labelclass }}">{{ $label }}</label>
    </div>
    @endif

    <div class="lg:w-4/6 w-full">
        @if($type === 'file')
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $id }}"
            class="h-[44px] mt-[-7px] p-1 w-full text-slate-500 text-sm rounded-[18px] leading-6 file:bg-[#437651] file:text-[#fff] file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-[14px] border border-[#EBEBEB] {{ $class }}" />
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
            class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[18px] border-[#EBEBEB] border-solid bg-white p-[7px] mt-[-7px] text-[#7A86A1] text-[14px] {{ $class }}" />
        <div id="{{ $id }}_error" class="text-red-500 text-sm hidden"></div>
        @endif
    </div>
</div>