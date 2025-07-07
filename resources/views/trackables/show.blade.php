@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-between">
    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Trackable</h3>
    </div>
</div>

<div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
    <div class="flex justify-between pl-[5px] pr-[5px]">
        <h4 class="manrope-medium text-[18px] mb-[20px]">Trackable Detail</h4>
    </div>
    <div class="flex flex-wrap mb-[30px]">
        <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid flex items-center justify-center">
            <div class="text-center inline-block w-[140px] h-[140px] mr-[10px] text-[50px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px] items-center justify-center pt-[30px]">
                {{ strtoupper(substr($trackable->trackable_name, 0, 2)) }}
            </div>
        </div>
        <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
            <h3 class="manrope-regular text-[16px] ml-[5px] font-semibold">{{ $trackable->trackable_name }}</h3>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px] pt-[10px]">
                    <div class="profile-detail">
                        <p class="pt-[0px]">
                            <span class="w-[37%] inline-block manrope-regular text-[16px]">Trackable Name:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">{{ $trackable->trackable_name }}</span>
                        </p>
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular">Other name:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">{{ $trackable->other_name ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                    <div class="profile-detail">
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular">Linked Objects:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">
                                {{ $trackable->linkedObjects->pluck('name')->implode(', ') ?: 'None' }}
                            </span>
                        </p>
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular text-[16px]">Status:</span>
                            <span class="manrope-regular text-[16px] {{ $trackable->is_active ? 'text-[#047413]' : 'text-[#ff0000]' }}">
                                {{ $trackable->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile-detail pt-[20px] pb-[1px] mt-[10px]">
    <div class="profile-project pt-[10px] pl-[3px] pr-[3px]">
        <h3 class="manrope-semibold text-[15px] text-[#437651] mb-[20px] flex justify-between">
            <span>Associated Projects</span>
            <div class="flex mt-[-15px]">
                <p class="flex items-center mr-[8px]">
                    <div class="relative flex items-center">
                        <input type="text" id="search-input" class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white" placeholder="Search...">
                        <button id="search-toggle" class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                            <img src="{{ asset('admin-theme/assets/images/table-search.png') }}" class="w-[16px]" alt="Search">
                        </button>
                    </div>
                </p>
                <button id="view-toggle" class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                    <img id="view-icon" src="{{ asset('admin-theme/assets/images/grid-view.png') }}" class="w-[16px]" alt="Toggle View">
                </button>
            </div>
        </h3>
        <div class="mt-[20px]">
            <div class="relative overflow-x-auto h-full" id="project-table">
                {{ $dataTable->table(['id' => 'projects-table', 'class' => 'w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400']) }}
            </div>
            <div id="project-grid" class="grid grid-cols-6 gap-4 hidden">
                @forelse($trackable->projects as $project)
                <div class="flex alert-shadow items-center p-[20px]">
                    <p class="bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[18px] manrope-semibold text-white rounded-[8px] px-[10px] py-[8px]">
                        {{ strtoupper(substr($project->name, 0, 2)) }}
                    </p>
                    <p class="pl-[10px] manrope-medium text-[16px] text-[#344563]">{{ $project->name }}</p>
                </div>
                @empty
                <div class="flex alert-shadow items-center p-[20px] col-span-6">
                    <p class="manrope-medium text-[16px] text-[#344563] w-full text-center">No projects associated with this trackable</p>
                </div>
                @endforelse
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

@push('scripts')
<script>
     $(document).ready(function() {
        // let table = $('#projects-table').DataTable();

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
                companies: {
                    required: true
                },
                location: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                name: {
                    required: "Please enter a project name",
                    minlength: "Project name must be at least 2 characters long"
                },
                companies: {
                    required: "Please select at least one company"
                },
                location: {
                    required: "Please enter a location",
                    minlength: "Location must be at least 2 characters long"
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
                formData.append('_method', 'PUT');
                var projectId = $('#edit_project_id').val();
                $('.edit-text').addClass('hidden');
                $('.edit-spinner').removeClass('hidden');
                $('#editProjectSubmit').prop('disabled', true);
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
                        $('#edit_companies').val(null).trigger('change');
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error updating project:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'name' ? 'edit_project_name' : key === 'companies' ? 'companies' : key === 'location' ? 'edit_location' : key === 'plant_name' ? 'edit_plant_name' : key) + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#' + (key === 'name' ? 'edit_project_name' : key === 'companies' ? 'companies' : key === 'location' ? 'edit_location' : key === 'plant_name' ? 'edit_plant_name' : key)).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to update project. Please try again.');
                        }
                    },
                    complete: function() {
                        $('.edit-text').removeClass('hidden');
                        $('.edit-spinner').addClass('hidden');
                        $('#editProjectSubmit').prop('disabled', false);
                    }
                });
            }
        });

        // Handle Edit Project button click
        $('#createProjectSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createProjectForm').valid()) {
                var formData = new FormData($('#createProjectForm')[0]);
                $('.create-text').addClass('hidden');
                $('.create-spinner').removeClass('hidden');
                $('#createProjectSubmit').prop('disabled', true);
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
                        $('#companies').val(null).trigger('change');
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating project:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'name' ? 'project_name' : key === 'location' ? 'p_location' : key === 'companies' ? 'companies' : key) + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#' + (key === 'name' ? 'project_name' : key === 'location' ? 'p_location' : key === 'companies' ? 'companies' : key)).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to create project. Please try again.');
                        }
                    },
                    complete: function() {
                        $('.create-text').removeClass('hidden');
                        $('.create-spinner').addClass('hidden');
                        $('#createProjectSubmit').prop('disabled', false);
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

        // jQuery Validation for Create User Form
        $('#createUserForm').validate({
            rules: {
                user_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                company_id: {
                    required: true
                },
                project_id: {
                    required: true
                },
                location: {
                    required: true,
                    minlength: 2
                },
                access_level: {
                    required: true,
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
                }
            },
            messages: {
                user_name: {
                    required: "Please enter a user name",
                    minlength: "User name must be at least 2 characters long"
                },
                email: {
                    required: "Please enter an email",
                    email: "Please enter a valid email address"
                },
                company_id: {
                    required: "Please select a company"
                },
                project_id: {
                    required: "Please select a project"
                },
                location: {
                    required: "Please enter a location",
                    minlength: "Location must be at least 2 characters long"
                },
                access_level: {
                    required: "Please select an access level",
                },
                image: {
                    required: "Please upload an image",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
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

        // Handle Create User button click
        $('#createUserSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createUserForm').valid()) {
                var formData = new FormData($('#createUserForm')[0]);
                $.ajax({
                    url: '{{route("users.store")}}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createUserModal');
                        table.ajax.reload(null, false);
                        toastr.success('User created successfully');
                        $('#createUserForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating user:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'company_id' ? 'u_company_id' : key === 'project_id' ? 'u_project_id' : key === 'location' ? 'u_location' : key) + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#' + (key === 'company_id' ? 'u_company_id' : key === 'project_id' ? 'u_project_id' : key === 'location' ? 'u_location' : key)).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to create user. Please try again.');
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
                    $('#edit_companies').val(response.company_ids).trigger('change');
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
        window.openCreateUserModal = function(projectId) {
            getProjects(projectId);
            toggleModal('createUserModal');
        };

        window.cancelCreateUserModal = function() {
            $('#createUserForm')[0].reset();
            $('#createUserModal select').val(null).trigger('change');
            $('.text-red-500').addClass('hidden');
            $('select').removeClass('input-error');
            toggleModal('createUserModal');
        };

        function getProjects(selectedProjectId = null) {
            var $projectSelect = $('#u_project_id');

            // Clear existing options and reinitialize Select2
            $projectSelect.empty().trigger('change');

            // Fetch companies via AJAX
            $.ajax({
                url: '{{ route("get-projects") }}',
                method: 'GET',
                success: function(response) {
                    if (response.success && response.projects) {
                        // Populate company dropdown
                        $.each(response.projects, function(id, name) {
                            var option = new Option(name, id, false, false);
                            $projectSelect.append(option);
                        });

                        // Reinitialize Select2
                        $projectSelect.trigger('change');

                        // Set the selected company AFTER options are populated
                        if (selectedProjectId) {
                            $projectSelect.val(selectedProjectId);
                            // Manually trigger the project loading instead of relying on change event
                            loadCompaniesForProject(selectedProjectId);
                        }
                    } else {
                        toastr.error('No projects found');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching projects:', xhr);
                    toastr.error('Failed to load projects');
                }
            });
        }

        function loadCompaniesForProject(projectId) {
            var $companySelect = $('#u_company_id');

            // Clear existing options and reinitialize Select2
            $companySelect.empty().trigger('change');

            if (projectId) {
                // Fetch related projects via AJAX
                $.ajax({
                    url: '{{ route("mappings.get-companies") }}',
                    method: 'POST',
                    data: {
                        project_id: projectId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success && response.companies) {
                            // Populate project dropdown
                            $.each(response.companies, function(id, name) {
                                var option = new Option(name, id, false, false);
                                $companySelect.append(option);
                            });
                            // Reinitialize Select2
                            $companySelect.trigger('change');
                        } else {
                            toastr.error('No companies found for this project');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching companies:', xhr);
                        toastr.error('Failed to load companies');
                    }
                });
            }
        }

         

    });
    $(document).ready(function() {
        $(".sidebar li").each(function() {
            const img = $(this).find("img");
            const originalSrc = img.attr("src"); 
            const hoverSrc = originalSrc.replace(".png", "-green.png");
    
            $(this).on("mouseenter", function() {
                img.attr("src", hoverSrc);
            });
    
            $(this).on("mouseleave", function() {
                if (!$(this).hasClass("active")) {
                    img.attr("src", originalSrc);
                }
            });
        });

        const currentPage = window.location.pathname.split("/").pop();
        $(".sidebar li a").each(function() {
            if ($(this).attr("href") === currentPage) {
                const parentLi = $(this).parent();
                parentLi.addClass("bg-[#f1f1f1]");
                const img = parentLi.find("img");
                let imgSrc = img.attr("src");
                if (imgSrc && !imgSrc.includes("-green.png")) {
                    img.attr("src", imgSrc.replace(".png", "-green.png"));
                }
            }
        });

        // Toggle view between table and grid
        const viewToggleBtn = document.getElementById('view-toggle');
        const viewIcon = document.getElementById('view-icon');
        const tableView = document.getElementById('project-table');
        const gridView = document.getElementById('project-grid');

        viewToggleBtn.addEventListener('click', () => {
            const isTableVisible = !tableView.classList.contains('hidden');
            tableView.classList.toggle('hidden');
            gridView.classList.toggle('hidden');
            viewIcon.src = isTableVisible ? '{{ asset("admin-theme/assets/images/list-view.png")}}' : '{{ asset("admin-theme/assets/images/grid-view.png")}}';
        });

        // Search functionality
        $('#search-input').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#project-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            $('#project-grid > div').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

    function toggleDotDropdown(event) {
        const dropdown = event.target.closest('td').querySelector('.dot-drop');
        document.querySelectorAll('.dot-drop').forEach(drop => drop.classList.add('hidden'));
        dropdown.classList.toggle('hidden');
    }
</script>
{{ $dataTable->scripts() }}
@endpush