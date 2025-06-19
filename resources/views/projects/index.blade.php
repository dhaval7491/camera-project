@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">All Projects</h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createProjectModal')">
                                    <span class="mr-[10px]">
                                        <img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]">
                                    </span> Add New
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="table-filter-block mt-[20px]">
            <div class="flex justify-end">
                <p class="flex items-center mr-[8px]">
                    <div class="relative flex items-center mr-[8px]">
                        <!-- Search Input -->
                        <input type="text" id="search-input"
                            class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                            placeholder="Search...">

                        <!-- Search Button -->
                        <button id="search-toggle"
                            class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                            <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]">
                        </button>
                    </div>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                        @foreach($companies as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="plant-filter" multiple class="filter-select w-[80px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Plant">
                        @foreach($plants as $plant)
                            <option value="{{ $plant }}">{{ $plant }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                        @foreach($statuses as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="form-list-table">
            <div class="mt-[20px]">
                <div class="relative">
                    {!! $dataTable->table(['class' => 'all-table table table-bordered table-striped w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Project Modal -->
@include('projects.add')
<!-- Create Equipment Modal -->
@include('equipments.add')
<!-- Edit Project Modal -->
@include('projects.edit')
<!-- Add Trackable Modal -->
@include('trackables.add')
<!-- Add User Modal -->
@include('users.add')
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ebebeb;
    border-radius: 10px;
    padding: 2px;
    min-height: 34px;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    padding: 0 4px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #f5f5f5;
    border: 1px solid #ebebeb;
    border-radius: 4px;
    padding: 2px 6px;
    margin: 2px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #444;
    margin-right: 4px;
}
.select2-container .select2-search--inline .select2-search__field {
    margin-top: 4px;
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
    color: #444;
}
.select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #444;
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
$(document).ready(function() {
    let table = $('#projects-table').DataTable();

    // Initialize Select2
    $('.filter-select').select2({
        placeholder: function() {
            return $(this).data('placeholder');
        },
        allowClear: true,
        closeOnSelect: false,
        width: '100%'
    });

    // jQuery Validation for Create Project Form
    $('#createProjectForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            company_id: {
                required: true
            },
            location: {
                required: true,
                minlength: 2
            },
            plant_name: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            name: {
                required: "Please enter a project name",
                minlength: "Project name must be at least 2 characters long"
            },
            company_id: {
                required: "Please select a company"
            },
            location: {
                required: "Please enter a location",
                minlength: "Location must be at least 2 characters long"
            },
            plant_name: {
                required: "Please enter a plant name",
                minlength: "Plant name must be at least 2 characters long"
            }
        },
        errorPlacement: function(error, element) {
            var errorDiv = '#' + $(element).attr('id') + '_error';
            $(errorDiv).text(error.text()).removeClass('hidden');
            $(element).addClass('input-error');
        },
        success: function(label, element) {
            var errorDiv = '#' + $(element).attr('id') + '_error';
            $(errorDiv).addClass('hidden');
            $(element).removeClass('input-error');
        }
    });

    // jQuery Validation for Edit Project Form
    $('#editProjectForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            company_id: {
                required: true
            },
            location: {
                required: true,
                minlength: 2
            },
            plant_name: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            name: {
                required: "Please enter a project name",
                minlength: "Project name must be at least 2 characters long"
            },
            company_id: {
                required: "Please select a company"
            },
            location: {
                required: "Please enter a location",
                minlength: "Location must be at least 2 characters long"
            },
            plant_name: {
                required: "Please enter a plant name",
                minlength: "Plant name must be at least 2 characters long"
            }
        },
        errorPlacement: function(error, element) {
            var errorDiv = '#' + $(element).attr('id') + '_error';
            $(errorDiv).text(error.text()).removeClass('hidden');
            $(element).addClass('input-error');
        },
        success: function(label, element) {
            var errorDiv = '#' + $(element).attr('id') + '_error';
            $(errorDiv).addClass('hidden');
            $(element).removeClass('input-error');
        }
    });

    // Handle Edit Project button click
    $('#editProjectSubmit').on('click', function(e) {
        e.preventDefault();
        if ($('#editProjectForm').valid()) {
            var formData = new FormData($('#editProjectForm')[0]);
            var projectId = $('#edit_project_id').val();
            $.ajax({
                url: '{{ url("projects") }}/' + projectId,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toggleModal('editProjectModal');
                    table.ajax.reload(null, false);
                    toastr.success('Project updated successfully');
                    $('#editProjectForm')[0].reset();
                    $('.text-red-500').addClass('hidden');
                    $('input, select, textarea').removeClass('input-error');
                },
                error: function(xhr) {
                    console.error('Error updating project:', xhr);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var errorDiv = '#' + (key === 'name' ? 'edit_project_name' : key === 'company_id' ? 'edit_project_company_id' : key === 'location' ? 'edit_location' : key === 'plant_name' ? 'edit_plant_name' : key) + '_error';
                            $(errorDiv).text(value[0]).removeClass('hidden');
                            $('#' + (key === 'name' ? 'edit_project_name' : key === 'company_id' ? 'edit_project_company_id' : key === 'location' ? 'edit_location' : key === 'plant_name' ? 'edit_plant_name' : key)).addClass('input-error');
                        });
                    } else {
                        toastr.error('Failed to update project. Please try again.');
                    }
                }
            });
        }
    });

    // Handle Create Project button click
    $('#createProjectSubmit').on('click', function(e) {
        e.preventDefault();
        if ($('#createProjectForm').valid()) {
            var formData = new FormData($('#createProjectForm')[0]);
            $.ajax({
                url: '{{ route('projects.store') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toggleModal('createProjectModal');
                    table.ajax.reload(null, false);
                    toastr.success('Project created successfully');
                    $('#createProjectForm')[0].reset();
                    $('.text-red-500').addClass('hidden');
                    $('input, select, textarea').removeClass('input-error');
                },
                error: function(xhr) {
                    console.error('Error creating project:', xhr);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var errorDiv = '#' + (key === 'name' ? 'project_name' : key === 'location' ? 'p_location' : key) + '_error';
                            $(errorDiv).text(value[0]).removeClass('hidden');
                            $('#' + (key === 'name' ? 'project_name' : key === 'location' ? 'p_location' : key)).addClass('input-error');
                        });
                    } else {
                        toastr.error('Failed to create project. Please try again.');
                    }
                }
            });
        }
    });

    // jQuery Validation for Create Equipment Form
    $('#createEquipmentForm').validate({
            rules: {
                type: {
                    required: true
                },
                equipment_name: {
                    required: true,
                    minlength: 2
                },
                equipment_code: {
                    required: true,
                    minlength: 6
                },
                password: {
                    required: true,
                    minlength: 8
                },
                stream_link: {
                    required: function(element) {
                        return $('#createEquipmentForm input[name="type"]:checked').val() === 'camera';
                    },
                    url: true
                }
            },
            messages: {
                type: {
                    required: "Please select an equipment type"
                },
                equipment_name: {
                    required: "Please enter an equipment name",
                    minlength: "Equipment name must be at least 2 characters long"
                },
                equipment_code: {
                    required: "Please enter an equipment code",
                    minlength: "Equipment code must be at least 6 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                },
                stream_link: {
                    required: "Please enter a streaming link for camera equipment",
                    url: "Please enter a valid URL"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + (element.attr('name') === 'type' ? 'type_error' : element.attr('id') + '_error');
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('input-error');
                if (element.attr('name') === 'type') {
                    $('#createEquipmentForm input[name="type"]').parent().addClass('input-error');
                }
            },
            success: function(label, element) {
                var errorDiv = '#' + ($(element).attr('name') === 'type' ? 'type_error' : $(element).attr('id') + '_error');
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
                if ($(element).attr('name') === 'type') {
                    $('#createEquipmentForm input[name="type"]').parent().removeClass('input-error');
                }
            }
        });

        // Handle Create Equipment Submission
        $('#createEquipmentSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createEquipmentForm').valid()) {
                var formData = new FormData($('#createEquipmentForm')[0]);
                $.ajax({
                    url: '{{ route("equipments.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createEquipmentModal');
                        equipmentTable.ajax.reload(null, false);
                        toastr.success('Equipment created successfully');
                        $('#createEquipmentForm')[0].reset();
                        $('#cameraFields').removeClass('hidden');
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                        $('#createEquipmentForm input[name="type"][value="camera"]').prop('checked', true);
                    },
                    error: function(xhr) {
                        console.error('Error creating equipment:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'type' ? 'type_error' : key + '_error');
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                if (key === 'type') {
                                    $('#createEquipmentForm input[name="type"]').parent().addClass('input-error');
                                } else {
                                    $('#' + key).addClass('input-error');
                                }
                            });
                        } else {
                            toastr.error('Failed to create equipment. Please try again.');
                        }
                    }
                });
            }
        });


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

    // Apply filters to DataTable
    function applyFilters() {
        let companyIds = $('#company-filter').val() || [];
        let plants = $('#plant-filter').val() || [];
        let statuses = $('#status-filter').val() || [];
        let searchTerm = $('#search-input').val() || '';

        table.ajax.url('{{ route('projects.data') }}?' + $.param({
            company_ids: companyIds,
            plants: plants,
            statuses: statuses.map(status => status == 1 ? 'Active' : status == 0 ? 'Inactive' : 'Blocked'),
            'search[value]': searchTerm
        })).load();
    }

    // Trigger filter on select2 change
    $('#company-filter, #plant-filter, #status-filter').on('change', function() {
        applyFilters();
    });

    // Search input handling
    // $('#search-toggle').on('click', function() {
    //     let searchInput = $('#search-input');
    //     if (searchInput.hasClass('w-0')) {
    //         searchInput.removeClass('w-0 p-0').addClass('w-[200px] p-2').focus();
    //     } else {
    //         searchInput.val('').removeClass('w-[200px] p-2').addClass('w-0 p-0');
    //         table.search('').draw(); // Clear search when closing
    //     }
    // });

    $('#search-input').on('keyup', function() {
        let searchTerm = $(this).val();
        table.search(searchTerm).draw(); // Apply search term
    });

    // Toggle dot dropdown for actions
    window.toggleDotDropdown = function(event) {
        const dropdown = event.target.closest('td').querySelector('.dot-drop');
        dropdown.classList.toggle('hidden');
    };

    window.toggleProjectStatus = function(projectId) {
        $.ajax({
            url: '{{ url("projects") }}/' + projectId + '/toggle-active',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload(null, false);
                }
            },
            error: function(xhr) {
                console.error('Error toggling status:', xhr);
                alert('Failed to update status');
            }
        });
    };

    // Fetch project data and populate edit modal
    window.showEditModal = function(projectId) {
        $.ajax({
            url: '{{ url("projects") }}/' + projectId + '/edit',
            method: 'GET',
            success: function(response) {
                // Populate the edit modal fields
                $('#edit_project_id').val(response.id);
                $('#edit_project_name').val(response.name);
                $('#edit_project_company_id').val(response.company_id);
                $('#edit_location').val(response.location);
                $('#edit_plant_name').val(response.plant_name);
                $('#editProjectForm').attr('action', '{{ url("projects") }}/' + response.id);

                // Open the edit modal
                toggleModal('editProjectModal');
            },
            error: function(xhr) {
                console.error('Error fetching project data:', xhr);
                alert('Failed to load project data');
            }
        });
    };

    // Modified toggleModal to handle projectId for createTrackableModal
    window.toggleModal = function(modalId, projectId = null) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
            // If opening createTrackableModal and projectId is provided, append hidden project_id input
            if (modalId === 'createTrackableModal' && projectId) {
                const form = document.getElementById('createTrackableForm');
                // Remove existing project_id input to avoid duplicates
                const existingInput = form.querySelector('input[name="project_id"]');
                if (existingInput) {
                    existingInput.remove();
                }
                // Append new hidden input for project_id
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'project_id';
                hiddenInput.value = projectId;
                form.appendChild(hiddenInput);
            }
        }
    };

    // Map provided modal function names to toggleModal
    window.toggleModalp = function() {
        toggleModal('createProjectModal');
    };

    window.toggleModale = function() {
        toggleModal('createEquipmentModal');
    };

    window.toggleModalpeople = function() {
        toggleModal('createUserModal');
    };

    // Handle Add User modal with pre-selected project
    window.openCreateUserModal = function(companyId, projectId) {
        toggleModal('createUserModal');
        $('#u_company_id').val(companyId);
        $('#u_project_id').val(projectId);
    };
});
</script>
<script> 
$(document).ready(function () {
    $('#projects-table thead th').each(function () {
        const thText = $(this).text().trim();

        if (thText === 'Status') {
            $(this).addClass('status');
        } else if (thText === 'Action') {
            $(this).addClass('action');
        } else if (thText === 'People') {
            $(this).addClass('people');
        } 
        // Add more cases as needed
    });
});
</script>
@endpush