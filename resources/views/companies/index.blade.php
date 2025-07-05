@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex">
                <div class="sm:w-1/6 md:w-1/6 lg:w-1/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[13px] mt-[10px]">All Companies</h3>
                </div>
                <div class="sm:w-5/6 md:w-5/6 lg:w-5/6 w-full">
                    <div class="table-filter float-right">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[10px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createCompanyModal')">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span>
                                    Add New
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
                        class="p-[11px] rounded-[14px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                        <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="" style="width:13px;">
                    </button>
                </div>
                </p>
                <p class="flex items-center mr-[8px] ">
                <div class="relative flex items-center mr-[8px] filter-resp">
                    <button id="search-toggle"
                        class="rounded-[14px] border border-[#EBEBEB] z-[8] bg-white" style="padding:12px;">
                        <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="" style="width:13px;">
                    </button>
                </div>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="company-filter" multiple class="filter-select w-[150px] p-2 border border-[#EBEBEB] rounded-[11px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                        @foreach($companies as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="people-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="People">
                        @foreach($people as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px] filter-drop">
                    <select id="location-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Location">
                        @foreach($locations as $location)
                        <option value="{{ $location }}">{{ $location }}</option>
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
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped min-w-full leading-normal w-full whitespace-nowrap all-table'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Company Modal -->
@include('companies.add')
<!-- Edit Company Modal -->
@include('companies.edit')
<!-- Create Project Modal -->
@include('projects.add')
<!-- Create User Modal -->
@include('users.add')
@endsection
@push('styles')
@endpush
<!-- @section('css') -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>

</style>
<!-- @endsection -->

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#companies-table').DataTable();

        // Initialize Select2
        $('.filter-select').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
            closeOnSelect: false,
            width: '100%'
        });

        // jQuery Validation for Create Company Form
        $('#createCompanyForm').validate({
            rules: {
                company_name: {
                    required: true,
                    minlength: 2
                },
                logo: {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
                },
                location: {
                    required: true,
                    minlength: 2
                },
                admin_name: {
                    required: true,
                    minlength: 2
                },
                admin_email: {
                    required: true,
                    email: true
                },
                admin_password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                company_name: {
                    required: "Please enter a company name",
                    minlength: "Company name must be at least 2 characters long"
                },
                logo: {
                    required: "Please upload a company logo",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
                },
                location: {
                    required: "Please enter a location",
                    minlength: "Location must be at least 2 characters long"
                },
                admin_name: {
                    required: "Please enter an admin name",
                    minlength: "Admin name must be at least 2 characters long"
                },
                admin_email: {
                    required: "Please enter an admin email",
                    email: "Please enter a valid email address"
                },
                admin_password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 6 characters long"
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

        // jQuery Validation for Edit Company Form
        $('#editCompanyForm').validate({
            rules: {
                company_name: {
                    required: true,
                    minlength: 2
                },
                logo: {
                    extension: "jpg|jpeg|png|gif"
                },
                location: {
                    required: true,
                    minlength: 2
                },
                admin_name: {
                    required: true,
                    minlength: 2
                },
                admin_email: {
                    required: true,
                    email: true
                },
                admin_password: {
                    required: false,
                    minlength: 6
                }
            },
            messages: {
                company_name: {
                    required: "Please enter a company name",
                    minlength: "Company name must be at least 2 characters long"
                },
                logo: {
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
                },
                location: {
                    required: "Please enter a location",
                    minlength: "Location must be at least 2 characters long"
                },
                admin_name: {
                    required: "Please enter an admin name",
                    minlength: "Admin name must be at least 2 characters long"
                },
                admin_email: {
                    required: "Please enter an admin email",
                    email: "Please enter a valid email address"
                },
                admin_password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 6 characters long"
                }
            },
            // errorPlacement: function(error, element) {
            //     console.log("error", error);
            //     var errorDiv = '#edit_' + $(element).attr('id') + '_error';
            //     console.log("errorDiv", errorDiv);
            //     $(errorDiv).text(error.text()).removeClass('hidden');
            //     $(errorDiv).addClass('input-error');
            // },
            error: function(xhr) {
                console.log('Error updating project:', xhr);

                if (xhr.status === 422) {
                    console.log("errors", xhr.responseJSON.errors);
                    const errors = xhr.responseJSON.errors || {};

                    $.each(errors, function(key, messages) {
                        const errorDiv = '#edit_' + key + '_error';
                        const inputField = '#edit_' + key;

                        // Show the first validation message
                        $(errorDiv).text(messages[0]).removeClass('hidden');
                        $(inputField).addClass('input-error');

                        console.log("Field:", key);
                        console.log("Error Message:", messages[0]);
                    });
                } else {
                    toastr.error('Failed to update project. Please try again.');
                }
            },
            success: function(label, element) {
                console.log("success");
                var errorDiv = '#' + $(element).attr('id') + '_error';
                $(errorDiv).addClass('hidden');
                $(element).removeClass('input-error');
            }
        });


        // Handle Create button click
        $('#createCompanySubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createCompanyForm').valid()) {
                var formData = new FormData($('#createCompanyForm')[0]);
                $.ajax({
                    url: '{{ route("companies.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createCompanyModal');
                        table.ajax.reload(null, false);
                        toastr.success('Company created successfully');
                        $('#createCompanyForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating company:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + key + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#' + key).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to create company');
                        }
                    }
                });
            }
        });

        // Handle Edit button click
        $('#editCompanySubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#editCompanyForm').valid()) {
                var formData = new FormData($('#editCompanyForm')[0]);
                var companyId = $('#edit_company_id').val();
                $.ajax({
                    url: '{{ url("companies") }}/' + companyId,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('editCompanyModal');
                        table.ajax.reload(null, false);
                        toastr.success('Company updated successfully');
                        $('#editCompanyForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input, select, textarea').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.log('Error updating company:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#edit_' + key + '_error';
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                $('#edit_' + key).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to update company');
                        }
                    }
                });
            }
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

        // Handle Create Project button click
        $('#createProjectSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createProjectForm').valid()) {
                var formData = new FormData($('#createProjectForm')[0]);
                $.ajax({
                    url: '{{ route("projects.store") }}',
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
            let peopleIds = $('#people-filter').val() || [];
            let locations = $('#location-filter').val() || [];
            let statuses = $('#status-filter').val() || [];

            table.ajax.url('{{ route("companies.data") }}?' + $.param({
                company_ids: companyIds,
                people_ids: peopleIds,
                locations: locations,
                statuses: statuses.map(status => status == 1 ? 'Active' : 'Inactive')
            })).load();
        }

        // Trigger filter on select2 change
        $('#company-filter, #people-filter, #location-filter, #status-filter').on('change', function() {
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

        window.toggleCompanyStatus = function(companyId) {
            $.ajax({
                url: '{{ url("companies") }}/' + companyId + '/toggle-active',
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

        // Fetch company data and populate edit modal
        window.showEditModal = function(companyId) {
            $.ajax({
                url: '{{ url("companies") }}/' + companyId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_company_id').val(response.id);
                    $('#edit_company_name').val(response.company_name);
                    $('#edit_company_location').val(response.location);
                    $('#edit_admin_name').val(response.admin_name);
                    $('#edit_admin_email').val(response.admin_email);
                    // $('#edit_company_admin_password').val(response.admin_password);
                    $('#editCompanyForm').attr('action', '{{ url("companies") }}/' + response.id);
                    // Remove any existing logo preview
                    $('#edit_company_logo').siblings('.logo-preview').remove();
                    if (response.logo) {
                        $('#edit_company_logo').after(`<div class="logo-preview"><img src="${response.logo}" alt="Current Logo" class="w-32 h-32 object-contain"></div>`);
                    }

                    // Open the edit modal
                    toggleModal('editCompanyModal');
                },
                error: function(xhr) {
                    console.error('Error fetching company data:', xhr);
                    alert('Failed to load company data');
                }
            });
        };

        // Handle Add Project modal with pre-selected company
        window.openCreateProjectModal = function(companyId) {
            toggleModal('createProjectModal');
            $('#company_id').val(companyId);
        };

        // Handle Add User modal with pre-selected company
        window.openCreateUserModal = function(companyId) {
            toggleModal('createUserModal');
            $('#u_company_id').val(companyId).trigger('change');
        };

        // Handle Delete company
        window.deleteCompany = function(companyId) {
            if (confirm('Are you sure you want to delete this company?')) {
                $.ajax({
                    url: '{{ url("companies") }}/' + companyId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            alert('Company deleted successfully');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting company:', xhr);
                        alert('Failed to delete company');
                    }
                });
            }
        };
    });

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
</script>
<script>
    $(document).ready(function() {
        $('#companies-table thead th').each(function() {
            const thText = $(this).text().trim();

            if (thText === 'Status') {
                $(this).addClass('status');
            } else if (thText === 'Action') {
                $(this).addClass('action');
            } else if (thText === 'People') {
                $(this).addClass('people');
            } else if (thText === 'Company Name') {
                $(this).addClass('companyName');
            } else if (thText === 'Date Created') {
                $(this).addClass('dateCreated');
            } else if (thText === 'Location') {
                $(this).addClass('location');
            } else if (thText === 'Location') {
                $(this).addClass('location');
            }

            // Add more cases as needed
        });
    });
</script>
<!-- <script>
$(document).ready(function() {
    $('#companies-table').DataTable({
        stripeClasses: ['bg-[#E7EEEA]', 'bg-white'],
    });
});
</script> -->
@endpush