<html>

<head>
    <title>
        Guava
    </title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/media.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/output.css')}}">
</head>

<body>
    <div class="wrapper bg-[#EFEFEF] fixed w-full h-full">
        <div class="h-screen flex items-center justify-center">
            <div class="grid grid-cols-2 gap-4">
                <div class="signin-logo" style="width:500px;">
                    <!-- Logo or image can go here -->
                </div>
                <div class="signin-form w-full mx-auto">
                    <form class="" action="{{ route('superadmin.login') }}" method="post">
                        @csrf
                        <h3 class="manrope-bold text-[28px] text-[#374557] mb-[20px]">
                            Reset Password
                        </h3>
                        <label class="manrope-medium text-[13px] text-[#2C323E] block">
                            Email Address
                        </label>
                        <input class="rounded-[10px] bg-[#FFFFFF] w-full h-[45px] px-[15px] mt-[10px] 
                        manrope-normal placeholder:text-[#c5c5c5] text-[#3D3D3D] focus:border-[grey] 
                        focus:border-[1px] focus:border-solid focus:outline-none @error('email') border-red-500 @enderror"
                            type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address">

                        <label class="manrope-medium text-[13px] text-[#2C323E] block mt-[20px]">
                            New Password
                        </label>
                        <div class="relative">
                            <input class="rounded-[10px] bg-[#FFFFFF] w-full h-[45px] px-[15px] mt-[10px] 
                        manrope-normal placeholder:text-[#c5c5c5] text-[#3D3D3D] focus:border-[grey] 
                        focus:border-[1px] focus:border-solid focus:outline-none @error('password') border-red-500 @enderror"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter Password">
                            <!-- <button type="button"
                                class=""> -->
                                <i class="fas fa-eye-slash toggle-password absolute right-[10px] top-[20px] text-[#84818A]" id="togglePassword"></i>
                            <!-- </button> -->
                        </div>
                        <label class="manrope-medium text-[13px] text-[#2C323E] block mt-[20px]">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input
                                class="rounded-[10px] bg-[#FFFFFF] w-full h-[45px] px-[15px] mt-[10px] 
                        manrope-normal placeholder:text-[#c5c5c5] text-[#3D3D3D] focus:border-[grey] 
                        focus:border-[1px] focus:border-solid focus:outline-none @error('password') border-red-500 @enderror"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter Password">
                                <i class="fas fa-eye-slash toggle-password absolute right-[10px] top-[20px] text-[#84818A]" id="togglePassword"></i>
                        </div>


                <!-- <div class="grid grid-cols-2 gap-4 mt-[20px]">
                    <div class="flex items-center">
                        <input checked id="checked-checkbox" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm 
                                focus:ring-gray-500 checked:bg-gray">
                        <label for="checked-checkbox" class="ms-2 text-[#3D3D3D] 
                                manrope-medium text-[13px]">Remember me?</label>
                    </div>
                    <p class="text-right">
                        <a href="#" class="text-[#3D3D3D] manrope-medium text-[13px]">
                            Forgot Password?
                        </a>
                    </p>
                </div> -->

                <button class="w-full bg-gradient-to-b from-gray-400 to-gray-700 text-white 
                        manrope-medium py-[8px] rounded-[10px] mt-[30px]" type="submit">
                    Reset Password
                </button>
                </form>
            </div>
        </div>
    </div>

    </div>
</body>
<script src="{{asset('admin-theme/assets/js/jquery-3.7.1.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.9.1/cdn.js"></script>
<script src="{{asset('admin-theme/assets/js/custom-script.js')}}"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>