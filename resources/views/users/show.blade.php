@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px] mr-[10px]">
            <div class="flex justify-between pl-[5px] pr-[5px]">
                <h4 class="manrope-medium text-[14px]">Personal Detail</h4>
                <div class="flex">
                    <button class="bg-[#dcdcdc] manrope-medium text-[14px] text-[#3D3D3D] rounded-[3px]" onclick="showEditModal('{{$user->id}}')"><img src="{{asset('admin-theme/assets/images/edit-opt.png')}}" class="w-[25px]  h-[25px] mr-[11px] object-contain"></button>
                    <form action="{{route('users.destroy', $user->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[13px] ml-[20px]">
                            <img src="{{asset('admin-theme/assets/images/delete.png')}}" class="w-[25px]  h-[25px] mr-[11px] object-contain">
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid">
                    <div class="profile">
                        <img src="{{ $user->profile_img ? Storage::disk('s3')->url($user->profile_img) : asset('admin-theme/assets/images/profile-dummy.png') }}" class="w-[80%] mx-auto object-contain rounded-full">
                    </div>
                </div>
                <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
                    <div class="flex flex-wrap mb-[30px]">
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px] pt-[10px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:85px;">User Name:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]" >{{ $user->name }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:85px;">User ID:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">#{{ $user->id }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:85px;">Username:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $user->username ?? $user->name }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px] pt-[10px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:70px;">Location:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $user->location ?? 'N/A' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:70px;">Mail ID:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px] pt-[10px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:92px;">Date:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $user->created_at->format('d.m.Y') }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:92px;">Access Level:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $user->access_level ?? 'Project' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:92px;">Status:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:115px;">Company Name:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $companyNames ?: 'N/A' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="inline-block manrope-regular text-[14px] text-[#3D3D3D]" style="width:115px;">Project Name:</span>
                                    <span class="manrope-regular text-[14px] text-[#969696]">{{ $projectNames ?: 'N/A' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-project mt-[40px] pl-[3px] pr-[3px]">
            <h3 class="manrope-medium text-[14px] text-[#3D3D3D] mb-[20px]">Projects List</h3>
            <div class="grid grid-cols-6 gap-4">
                @forelse($uprojects as $project)
                <div class="flex alert-shadow items-center p-[20px]">
                    <p class="bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[24px] manrope-semibold text-white rounded-[8px] px-[10px] py-[8px]">{{ strtoupper(substr($project->name, 0, 2)) }}</p>
                    <p class="pl-[10px] manrope-medium text-[16px] text-[#344563]">{{ $project->name }}</p>
                </div>
                @empty
                <div class="col-span-6 p-[20px] text-center manrope-regular text-[#969696]">
                    No projects assigned.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
@include('users.edit')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Sidebar hover and active state handling
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

        // Add active class dynamically
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

        // Profile dropdown toggle
        window.toggleProfileDropdown = function(event) {
            event.stopPropagation();
            const dropdown = $(event.currentTarget).find('.profile-drop');
            dropdown.toggleClass('hidden');
            if (!dropdown.hasClass('hidden')) {
                const rect = event.currentTarget.getBoundingClientRect();
                dropdown.css({
                    position: 'absolute',
                    top: `${rect.bottom + window.scrollY}px`,
                    left: `${rect.left + window.scrollX - dropdown[0].offsetWidth + event.currentTarget.offsetWidth}px`,
                    zIndex: '1000'
                });
            }
        };

        $(document).click(function(e) {
            if (!$(e.target).closest('.profile-drop').length && !$(e.target).closest('button[onclick*="toggleProfileDropdown"]').length) {
                $('.profile-drop').addClass('hidden');
            }
        });

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
                    if (response.profile_img) {
                        $('#edit_user_image').after(`<div><img src="${response.profile_img}" alt="Current Image" class="w-32 h-32 object-contain"></div>`);
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
                        // table.ajax.reload(null, false);
                        toastr.success('User updated successfully');
                        location.reload();
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
    });
</script>
@endpush