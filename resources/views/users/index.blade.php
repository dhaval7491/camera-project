@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="">
            <div class="flex">
                <div class="sm:w-1/6 md:w-1/6 lg:w-1/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[14px] mt-[17px]">
                        <!-- User - {{ $user_counts ?? '10' }} -->
                         User
                    </h3>
                </div>
                <div class="sm:w-5/6 md:w-5/6 lg:w-5/6 w-full">
                    <div class="table-filter float-right">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[10px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createUserModal')">
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
                        <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]" style="width:13px;">
                    </button>
                </div>
                </p>
                <p class="flex items-center mr-[8px]">
                    <div class="relative flex items-center mr-[8px] filter-resp">
                        <button id="search-toggle"
                            class="rounded-[14px] border border-[#EBEBEB] z-[8] bg-white" style="padding:12px;">
                            <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="" style="width:13px;">
                        </button>
                    </div>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="user-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="User">
                        @foreach($users as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="company-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company">
                        @foreach($companies as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                        @foreach($projects as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
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
                    {!! $dataTable->table(['class' => 'all-table w-full text-sm text-left rtl:text-right'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal -->
@include('users.add')
<!-- Edit User Modal -->
@include('users.edit')
<!-- Create Project Modal -->
@include('projects.add')
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
        let table = $('#users-table').DataTable();

        // Initialize Select2
        $('.filter-select').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
            closeOnSelect: false,
            width: '100%'
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

        // jQuery Validation for Edit User Form
        $('#editUserForm').validate({
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
                companies: {
                    required: "Please select a company"
                },
                projects: {
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

        // Handle Edit User button click
        $('#editUserSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#editUserForm').valid()) {
                var formData = new FormData($('#editUserForm')[0]);
                var userId = $('#edit_user_id').val();
                $.ajax({
                    url: '{{ url("users") }}/' + userId,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('editUserModal');
                        table.ajax.reload(null, false);
                        toastr.success('User updated successfully');
                        $('#editUserForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                        $('#edit_user_image').siblings('div').remove();
                    },
                    error: function(xhr) {
                        console.error('Error updating user:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'user_name' ? 'edit_user_name' : key === 'email' ? 'edit_email' : key === 'company_id' ? 'edit_company_id' : key === 'project_id' ? 'edit_project_id' : key === 'location' ? 'edit_location' : key === 'access_level' ? 'edit_access_level' : key === 'image' ? 'edit_user_image' : key) + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#' + (key === 'user_name' ? 'edit_user_name' : key === 'email' ? 'edit_email' : key === 'company_id' ? 'edit_company_id' : key === 'project_id' ? 'edit_project_id' : key === 'location' ? 'edit_location' : key === 'access_level' ? 'edit_access_level' : key === 'image' ? 'edit_user_image' : key)).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to update user. Please try again.');
                        }
                    }
                });
            }
        });


        // Apply filters to DataTable
        function applyFilters() {
            let userIds = $('#user-filter').val() || [];
            let companyIds = $('#company-filter').val() || [];
            let projectIds = $('#project-filter').val() || [];
            let statuses = $('#status-filter').val() || [];

            table.ajax.url('{{ route("users.data") }}?' + $.param({
                    user_ids: userIds,
                    company_ids: companyIds,
                    project_ids: projectIds,
                    statuses: statuses.map(status => status == 1 ? 'Active' : status == 0 ? 'Inactive' : 'Blocked')
                })).load();
        }

        // Trigger filter on select2 change
        $('#user-filter, #company-filter, #project-filter, #status-filter').on('change', function() {
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

        window.toggleUserStatus = function(userId) {
            $.ajax({
                url: '{{ url("users") }}/' + userId + '/toggle-active',
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

        // Fetch user data and populate edit modal
        window.showEditModal = function(userId) {
            $.ajax({
                url: '{{ url("users") }}/' + userId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_user_id').val(response.id);
                    $('#edit_user_name').val(response.user_name);
                    $('#edit_email').val(response.email);
                    $('#edit_company_id').val(response.company_id);
                    $('#edit_project_id').val(response.project_id);
                    $('#edit_location').val(response.location);
                    $('#edit_access_level').val(response.access_level);
                    $('#editUserForm').attr('action', '{{ url("users") }}/' + response.id);
                    // Remove any existing image preview
                    $('#edit_user_image').siblings('div').remove();
                    if (response.image) {
                        $('#edit_user_image').after(`<div><img src="${response.image}" alt="Current Image" class="w-32 h-32 object-contain"></div>`);
                    }

                    // Open the edit modal
                    toggleModal('editUserModal');
                },
                error: function(xhr) {
                    console.error('Error fetching user data:', xhr);
                    alert('Failed to load user data');
                }
            });
        };

        // Modified toggleModal to handle userId for create planterModal
        window.toggleModal = function(modalId, userId = null) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
                // If opening createProjectModal and userId is provided, append hidden user_id input
                if (modalId === 'createProjectModal' && userId) {
                    const form = document.getElementById('createProjectForm');
                    // Remove existing user_id input to avoid duplicates
                    const existingInput = form.querySelector('input[name="user_id"]');
                    if (existingInput) {
                        existingInput.remove();
                    }
                    // Append new hidden input for user_id
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'user_id';
                    hiddenInput.value = userId;
                    form.appendChild(hiddenInput);
                }
            }
        };

        // Map provided modal function names to toggleModal
        window.toggleModalu = function() {
            toggleModal('createUserModal');
        };

        window.toggleModalp = function(userId = null) {
            toggleModal('createProjectModal', userId);
        };

        $('#u_company_id').on('change', function() {
            var companyId = $(this).val();
            var $projectSelect = $('#u_project_id');

            // Clear existing options and reinitialize Select2
            $projectSelect.empty().trigger('change');

            if (companyId) {
                // Fetch related projects via AJAX
                $.ajax({
                    url: '{{ route("mappings.get-projects") }}',
                    method: 'POST',
                    data: {
                        company_id: companyId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success && response.projects) {
                            // Populate project dropdown
                            $.each(response.projects, function(id, name) {
                                var option = new Option(name, id, false, false);
                                $projectSelect.append(option);
                            });
                            // Reinitialize Select2
                            $projectSelect.trigger('change');
                        } else {
                            toastr.error('No projects found for this company');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching projects:', xhr);
                        toastr.error('Failed to load projects');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#users-table thead th').each(function() {
            const thText = $(this).text().trim();

            if (thText === 'Status') {
                $(this).addClass('status');
            } else if (thText === 'Action') {
                $(this).addClass('action');
            } else if (thText === 'Name') {
                $(this).addClass('name');
            } else if (thText === 'Company') {
                $(this).addClass('company');
            } else if (thText === 'Created At') {
                $(this).addClass('created');
            } else if (thText === 'Email') {
                $(this).addClass('email');
            } else if (thText === 'Access Level') {
                $(this).addClass('accesslevel');
            }
            // Add more cases as needed
        });
    });
</script>
@endpush