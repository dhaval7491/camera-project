@extends('layouts.app')

@section('content')
<div class="help-options">
    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]"> Help</h3>
    </div>
    <div class="mt-[30px]">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            <div class="help-block">
                <div class="container-fluid">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/support.png') }}" class="w-[120px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">Support</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="help-block">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/what-new.png') }}" class="w-[100px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">What's New</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="help-block">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/feedback.png') }}" class="w-[100px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">Feedback</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="help-block">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/chat.png') }}" class="w-[100px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">Chat With Us</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="help-block">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/features.png') }}" class="w-[100px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">Features</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="help-block">
                    <div class="flex flex-wrap w-[75%] mx-[auto] alert-shadow py-[55px] px-[15px] rounded-[20px]">
                        <div class="lg:w-3/6 md:w-3/6">
                            <div class="help-img text-center">
                                <img src="{{ asset('admin-theme/assets/images/FAQ.png') }}" class="w-[100px] mx-auto">
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-1/6">
                            <div class="help-content">
                                <ul class="list-unstyled">
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Manual Guidelines</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Virtual Repairs</li>
                                    <li class="manrope-medium text-[16px] text-[#7A86A1] flex"><img src="{{ asset('admin-theme/assets/images/list-pointer.png') }}" class="w-[25px] h-[15px] object-contain mt-[7px] mr-[5px]">Immidiate Support</li>
                                </ul>
                                <button class="bg-[#437651] rounded-[12px] manrope-bold text-[16px] text-[#fff] py-[5px] w-[80%] mt-[20px]">FAQs</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection