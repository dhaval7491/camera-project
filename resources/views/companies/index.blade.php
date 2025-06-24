@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">All Companies</h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createCompanyModal')">
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
                            class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                            <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]">
                        </button>
                    </div>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="company-filter" multiple class="filter-select w-[150px] p-2 border border-[#EBEBEB] rounded-[11px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                        @foreach($companies as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="people-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="People">
                        @foreach($people as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="location-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Location">
                        @foreach($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
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


    // Handle Create button click
    $('#createCompanySubmit').on('click', function(e) {
        e.preventDefault();
        if ($('#createCompanyForm').valid()) {
            var formData = new FormData($('#createCompanyForm')[0]);
            $.ajax({
                url: '{{ route('companies.store') }}',
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
                    console.error('Error updating company:', xhr);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var errorDiv = '#' + key + '_error';
                            $(errorDiv).text(value[0]).removeClass('hidden');
                            $('#' + key).addClass('input-error');
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

    // Apply filters to DataTable
    function applyFilters() {
        let companyIds = $('#company-filter').val() || [];
        let peopleIds = $('#people-filter').val() || [];
        let locations = $('#location-filter').val() || [];
        let statuses = $('#status-filter').val() || [];

        table.ajax.url('{{ route('companies.data') }}?' + $.param({
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
        $('#u_company_id').val(companyId);
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
</script>
<script> 
$(document).ready(function () {
    $('#companies-table thead th').each(function () {
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
<!-- <script>
$(document).ready(function() {
    $('#companies-table').DataTable({
        stripeClasses: ['bg-[#E7EEEA]', 'bg-white'],
    });
});
</script> -->
@endpush