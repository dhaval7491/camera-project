@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">All Companies</h3>
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
                    <select id="company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
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
                <div class="relative overflow-x-scroll h-full">
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 whitespace-nowrap'], true) !!}
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
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
                    alert('Company created successfully');
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
                        alert('Failed to create company');
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
                    alert('Company updated successfully');
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
                        alert('Failed to update company');
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

    // Reopen modal if there are validation errors
    @if($errors -> any())
    toggleModal('createCompanyModal');
    @endif

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
@endpush