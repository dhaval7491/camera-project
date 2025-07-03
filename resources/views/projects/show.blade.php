@extends('layouts.app')

@section('content')
<div class="company-table h-full">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[13px] mt-[10px]">
                        Project
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[12px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createTrackableModal')">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span> Create Trackable
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[12px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModalassigntrackable()">Assign Trackable
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
            <div class="flex justify-between pl-[5px] pr-[5px]">
                <h4 class="manrope-medium text-[18px] mb-[20px]">Project Detail</h4>
            </div>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid flex items-center justify-center">
                    <div class="text-center inline-block w-[100px] h-[100px] mr-[10px] text-[50px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px] items-center justify-center">
                        {{ strtoupper(substr($project->name, 0, 2)) }}
                    </div>
                </div>
                <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
                    <div class="flex flex-wrap mb-[30px]">
                        <div class="lg:w-2/6 w-full pl-[5px] pr-[5px] pt-[10px]">
                            <div class="profile-detail">
                                <p class="pt-[0px]"><span class="w-[37%] inline-block manrope-regular text-[16px] text-[#344563]">Name of project:</span><span class="manrope-regular text-[16px] text-[#969696]">
                                        {{ $project->name }}</span></p>
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Date Created: </span><span class="manrope-regular text-[16px] text-[#969696]">{{ $project->created_at->format('M d - Y') }}</span></p>
                            </div>
                        </div>
                        <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Company Name: </span><span class="manrope-regular text-[16px] text-[#969696]">{{ $companyNames }}</span></p>
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular text-[16px]">Status:</span><span class="manrope-regular text-[16px] text-[#047413]">{{ $project->is_active ? 'Active' : 'Inactive' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between pl-[5px] pr-[5px]">
            <h4 class="manrope-medium text-[18px] mb-[10px] mt-[10px]">Trackable List</h4>
        </div>
        <div class="form-list-table">
            <div class="">
                <div class="relative overflow-x-scroll h-full">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#e6e6e6]">
                            <tr>
                                <th scope="col" class="px-6 py-3 manrope-medium text-[#344563] font-medium text-[16px]"></th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#344563] font-medium text-[13px]">Trackable Name</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#344563] font-medium text-[13px]">Other name</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#344563] font-medium text-[13px]">Linked Objects</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#344563] font-medium text-[13px]">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trackables as $trackable)
                            <tr class="bg-{{ $loop->even ? '[#f8f8f8]' : 'white' }} transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="checkbox-{{ $trackable->id }}" type="checkbox" value="{{ $trackable->id }}" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]"><a href="{{ route('trackables.show', $trackable->id) }}" class="cursor-pointer">{{ $trackable->trackable_name }}</a></p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]">{{ $trackable->other_name ?? 'N/A' }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]">{{ $trackable->linked_objects ?? 'None' }}</p>
                                </td>
                                <td class="px-[20px] py-[20px] text-center">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                        {{ $trackable->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white">
                                <td colspan="5" class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    No trackables found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Trackable Modal -->
@include('trackables.add')
<!-- Edit Trackable Modal -->
@include('trackables.edit')
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // jQuery Validation for Create Trackable Form
        $('#createTrackableForm').validate({
            rules: {
                trackable_name: {
                    required: true,
                    minlength: 2
                },
                other_name: {
                    minlength: 2
                },
                'linked_objects[]': {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                trackable_name: {
                    required: "Please enter a trackable name",
                    minlength: "Trackable name must be at least 2 characters long"
                },
                other_name: {
                    minlength: "Other name must be at least 2 characters long"
                },
                'linked_objects[]': {
                    required: "Please add at least one linked object",
                    minlength: "Each linked object must be at least 1 character long"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + element.attr('name').replace(/\[\]/g, '') + '_error';
                if (element.attr('name') === 'linked_objects[]') {
                    $('#linked_objects_error').text(error.text()).removeClass('hidden');
                    element.closest('.input-group').find('input').addClass('input-error');
                } else {
                    $(errorDiv).text(error.text()).removeClass('hidden');
                    element.addClass('input-error');
                }
            },
            success: function(label, element) {
                var errorDiv = '#' + $(element).attr('name').replace(/\[\]/g, '') + '_error';
                if ($(element).attr('name') === 'linked_objects[]') {
                    $('#linked_objects_error').addClass('hidden').text('');
                    $(element).closest('.input-group').find('input').removeClass('input-error');
                } else {
                    $(errorDiv).addClass('hidden').text('');
                    $(element).removeClass('input-error');
                }
            },
            // Ensure validation checks all linked object inputs
            ignore: [],
            invalidHandler: function(event, validator) {
                // Ensure linked_objects[] is validated correctly
                var linkedObjects = $('input[name="linked_objects[]"]');
                var hasValue = false;
                linkedObjects.each(function() {
                    if ($(this).val().trim().length > 0) {
                        hasValue = true;
                    }
                });
                if (!hasValue) {
                    $('#linked_objects_error').text('Please add at least one linked object').removeClass('hidden');
                    linkedObjects.addClass('input-error');
                }
            }
        });

        // Handle Create Trackable Submission
        $('#createTrackableSubmit').on('click', function(e) {
            e.preventDefault();
            // Manually validate linked_objects
            var linkedObjects = $('input[name="linked_objects[]"]');
            var validLinkedObjects = true;
            linkedObjects.each(function() {
                if ($(this).val().trim().length === 0) {
                    $(this).addClass('input-error');
                    validLinkedObjects = false;
                } else {
                    $(this).removeClass('input-error');
                }
            });
            if (!validLinkedObjects) {
                $('#linked_objects_error').text('Please fill in all linked objects or remove empty ones').removeClass('hidden');
            } else {
                $('#linked_objects_error').addClass('hidden').text('');
            }

            if ($('#createTrackableForm').valid() && validLinkedObjects) {
                var formData = new FormData($('#createTrackableForm')[0]);
                formData.append('project_id', '{{ $project->id }}'); // Add project_id to form data
                $.ajax({
                    url: '{{ route("trackables.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createTrackableModal');
                        trackableTable.ajax.reload(null, false);
                        toastr.success('Trackable created successfully');
                        $('#createTrackableForm')[0].reset();
                        $('#linkedObjectsContainer').html(`
                            <div class="flex align-middle input-group">
                                <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                                <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" onclick="addNewLinkedObjectField('#linkedObjectsContainer', 'linked_objects[]')">
                                    <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                                </button>
                            </div>
                        `);
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating trackable:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                var errorDiv = '#' + key.replace(/\.\d+/g, '') + '_error';
                                if (key.startsWith('linked_objects')) {
                                    $('#linked_objects_error').text(error[0]).removeClass('hidden');
                                    $('input[name="linked_objects[]"]').addClass('input-error');
                                } else {
                                    $(errorDiv).text(error[0]).removeClass('hidden');
                                    $('#' + key.replace(/\.\d+/g, '')).addClass('input-error');
                                }
                            });
                        } else {
                            toastr.error('Failed to create trackable');
                        }
                    }
                });
            }
        });

        // Cancel Create Trackable Modal
        window.cancelCreateTrackableModal = function() {
            $('#createTrackableForm')[0].reset();
            $('#linkedObjectsContainer').html(`
                <div class="flex align-middle input-group">
                    <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                    <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" onclick="addNewLinkedObjectField('#linkedObjectsContainer', 'linked_objects[]')">
                        <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                    </button>
                </div>
            `);
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('input-error');
            toggleModal('createTrackableModal');
        };

    });
</script>
@endpush