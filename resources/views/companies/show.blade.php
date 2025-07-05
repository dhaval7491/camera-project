@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-between">
    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
        <h3 class="manrope-medium text-[#344563] text-[13px] mt-[10px]">
            <p class="inline-block manrope-medium text-[13px]  px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                <a href="{{ route('companies.index') }}">< Back</a>
            </p>
        </h3>
    </div>
    <!-- <a href="#"><img src="assets/images/edit-1.png" class="w-[20px] mt-[7px] ml-[20px]"> Edit</a> -->
</div>
<div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
    <div class="flex justify-between pl-[5px] pr-[5px]">
        <h4 class="manrope-medium text-[18px] mb-[20px]">Company Detail</h4>
    </div>
    <div class="flex flex-wrap mb-[30px]">
        <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid flex items-center justify-center">
            <div class="text-center inline-block w-[140px] h-[140px] mr-[10px] text-[50px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px] items-center justify-center pt-[30px]">
                @if($company->logo)
                <img src="{{ $company->logo }}" alt="" class="w-full h-full object-cover">
                @else
                {{ getInitials($company->company_name) }}
                @endif
            </div>
        </div>
        <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
            <h3 class="manrope-regular text-[16px] ml-[5px] font-semibold">{{ $company->company_name }}</h3>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px] pt-[10px]">
                    <div class="profile-detail">
                        <p class="pt-[0px]"><span class="w-[37%] inline-block manrope-regular text-[16px] text-[#344563]">Location:</span><span class="manrope-regular text-[16px] text-[#969696]">
                                {{ $company->location }}</span></p>
                        <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Created At: </span><span class="manrope-regular text-[16px] text-[#969696] ">{{ displayDateFormat($company->created_at) }}</span></p>

                    </div>
                </div>
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                    <div class="profile-detail">
                        <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Admin Name: </span><span class="manrope-regular text-[16px] text-[#969696]">{{ $company->admin?->name }}</span></p>
                        <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular text-[16px]">Admin Email:</span><span class="manrope-regular text-[16px] text-[#047413]">{{ $company->admin?->email }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-wrap gap-[20px]">
    <div class="lg:w-1/2 w-full">
        <div class="profile-detail pt-[20px] pb-[1px] mt-[10px]">
            <div class="profile-project pt-[10px] pl-[3px] pr-[3px]">
                <h3 class="manrope-semibold text-[13px] text-[#344563] mb-[20px]">Associated Projects</h3>
                <div class="grid grid-cols-6 gap-[20px]">
                    @foreach ($company->projects as $project)
                    <div class="flex alert-shadow items-center p-[20px]">
                        <p class="bg-gradient-to-b from-[#844EBC] to-[#AA55AA]  text-[18px] manrope-semibold text-white rounded-[8px] px-[10px] py-[8px]">{{ getInitials($project->name) }}</p>
                        <p class="pl-[10px] manrope-medium text-[16px] text-[#344563]">{{ $project->name }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="lg:w-1/2 w-full">
        <div class="profile-detail pt-[20px] pb-[1px] mt-[10px]">
            <div class="profile-project pt-[10px] pl-[3px] pr-[3px]">
                <h3 class="manrope-semibold text-[13px] text-[#344563] mb-[20px]">Associated Users</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="manrope-regular text-[16px] text-[#344563] py-[10px] text-left p-[20px]">Name</th>
                                <th class="manrope-regular text-[16px] text-[#344563] py-[10px] text-left p-[20px]">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($company->users as $user)
                            <tr class="alert-shadow">
                                <td class="p-[20px] text-left">
                                    <p class="manrope-medium text-[16px] text-[#344563] inline-block">{{ $user->name }}</p>
                                </td>
                                <td class="p-[20px] text-left">
                                    <p class="manrope-medium text-[16px] text-[#344563] inline-block">{{ $user->email }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection