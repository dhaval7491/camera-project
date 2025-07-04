@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Account Section -->
    <div class="w-[70%] mx-auto">
        <div class="account-detail pl-[40px] pt-[20px]">
            <h4 class="manrope-semibold font-[16px] text-[#437651]">Account Details</h4>
            <div class="account-form mt-[40px]">
                <p class="manrope-medium text-[13px] text-[#000000] mb-[10px]">Upload Profile Picture</p>
                <form action="" method="POST" enctype="multipart/form-data" class="items-start gap-6">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap mt-[10px] mb-[10px]">
                        <div class="lg:w-1/6 w-full pl-[5px] pr-[5px]">
                            <div class="relative w-[73%] mb-[40px] my-[10px]">
                                <img src="{{ asset('admin-theme/assets/images/profile-edit.png') }}" class="w-full" alt="Profile Picture">
                                <label for="file-input"
                                    class="absolute right-[10px] bg-white p-1 rounded-full shadow-md cursor-pointer flex items-center justify-center" style="bottom:10px;">
                                    <img src="{{ asset('admin-theme/assets/images/camera.png') }}" class="w-[20px] h-[20px] object-contain p-[2px]" alt="Upload Icon">
                                </label>
                                <input type="file" id="file-input" name="profile_picture" accept="image/*" class="hidden">
                            </div>
                        </div>
                        <div class="lg:w-5/6 w-full pl-[5px] pr-[5px]">
                            <div class="w-[100%]">
                                <label class="text-[13px] text-black font-medium manrope-medium">Full Name</label>
                                <div class="mt-[20px] mb-[30px]">
                                    <div class="sm:flex">
                                        <input type="text" name="first_name" class="block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-l-full py-[10px] px-[25px]" placeholder="First Name">
                                        <input type="text" name="last_name" class="block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-r-full py-[10px] px-[25px]" placeholder="Last Name">
                                    </div>
                                </div>
                                <label class="text-[13px] text-black font-medium manrope-medium">Email</label>
                                <input type="email" name="email" class="mt-[20px] block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-full py-[10px] px-[25px]" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[12px] border-[1px] border-solid border-[#437651] text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="account-detail pl-[40px] pt-[20px]">
            <h4 class="manrope-semibold font-[16px] text-[#437651]">Change Password</h4>
            <div class="w-[100%]">
                <form action="{{ route('profile.password.update') }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="border-l-[6px] border-[#437651] border-solid tab-shadow py-[20px] px-[30px] mb-[30px] mt-[40px]">
                        <h5 class="text-lg font-semibold">Change Password</h5>
                        <div class="relative mt-2">
                            <input type="password" name="new_password" class="w-[70%] border-[1px] border-[#EBEBEB] border-solid rounded-full p-3 pr-10 focus:ring focus:ring-gray-200" placeholder="New Password">
                        </div>
                        <div class="relative mt-2">
                            <input type="password" name="new_password_confirmation" class="w-[70%] border-[1px] border-[#EBEBEB] border-solid rounded-full p-3 pr-10 focus:ring focus:ring-gray-200" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[12px] border-[1px] border-solid border-[#437651] text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection