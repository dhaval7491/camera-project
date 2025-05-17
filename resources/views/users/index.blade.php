@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">
                        User - {{ $userCount ?? '10' }}
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
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
                    <select id="user-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="User">
                        @foreach($users as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="company-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company">
                        @foreach($companies as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="flex items-center mr-[8px]">
                    <select id="project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                        @foreach($projects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
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
                <div class="relative overflow-x-auto h-full">
                    {!! $dataTable->table(['class' => 'w-full text-sm text-left rtl:text-right'], true) !!}
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
    let table = $('#user-table').DataTable();

    // Initialize Select2
    $('.filter-select').select2({
        placeholder: function() {
            return $(this).data('placeholder');
        },
        allowClear: true,
        closeOnSelect: false,
        width: '100%'
    });

    // Trigger filter on select2 change
    $('#user-filter, #company-filter, #project-filter, #status-filter').on('change', function() {
        table.ajax.reload();
    });

    // Reopen modal if there are validation errors
    @if($errors -> any())
    toggleModal('createUserModal');
    @endif

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
});
</script>
@endpush