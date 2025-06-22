@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
            <div class="flex justify-between pl-[5px] pr-[5px]">
                <h4 class="manrope-medium text-[18px]">Personal Detail</h4>
                <div class="flex">
                    <button class="bg-[#f1f3f5] manrope-medium text-[14px] text-[#3D3D3D] py-[10px] px-[25px] rounded-[10px]" onclick="showEditModal('{{$user->id}}')">Edit Profile</button>
                    <form action="{{route('users.destroy', $user->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[15px] ml-[20px]">
                            <img src="{{asset('admin-theme/assets/images/profile-delete.png')}}" class="w-[20px] mr-[11px] object-contain">
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
                                    <span class="w-[37%] inline-block manrope-regular text-[16px] text-[#3D3D3D]">User Name:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->name }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">User ID:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">#{{ $user->id }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">Username:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->username ?? $user->name }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block manrope-regular text-[16px] text-[#3D3D3D]">Location:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->location ?? 'N/A' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">Mail ID:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block manrope-regular text-[16px] text-[#3D3D3D]">Date:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->created_at->format('d.m.Y') }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">Access Level:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->access_level ?? 'Project' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">Status:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="lg:w-2/8 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block manrope-regular text-[16px] text-[#3D3D3D]">Company Name:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $companyNames ?: 'N/A' }}</span>
                                </p>
                                <p class="pt-[10px]">
                                    <span class="w-[37%] inline-block">Project Name:</span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">{{ $projectNames ?: 'N/A' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-project mt-[40px] pl-[3px] pr-[3px]">
            <h3 class="manrope-semibold text-[18px] text-[#3D3D3D] mb-[20px]">Projects List</h3>
            <div class="grid grid-cols-6 gap-4">
                @forelse($projects as $project)
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
    });
</script>
@endpush