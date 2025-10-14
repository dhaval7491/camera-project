<html>

<head>
    <title>
        Guava - Forgot Password
    </title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/media.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/output.css')}}">
    <link rel="stylesheet" href="{{asset('admin-theme/assets/css/custom-style.css')}}">
</head>

<body>
    <div class="wrapper fixed w-full h-full" style="background-color: #EFEFEF; overflow: hidden;">
        <div class="flex items-center justify-center" style="height: 100vh; padding: 30px 20px;">
            <div class="bg-white" style="border-radius: 30px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); max-width: 500px; width: 100%; padding: 40px;">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <h3 class="manrope-bold text-center" style="font-size: 32px; color: #374557; margin-bottom: 15px;">
                        Forgot Password
                    </h3>

                    <p class="manrope-normal text-center" style="font-size: 15px; color: #344563; margin-bottom: 30px;">
                        Enter your email address and we'll send you a link to reset your password.
                    </p>

                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[10px] mb-4" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-[10px] mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <label class="manrope-semibold" style="font-size: 16px; color: #374557; display: block; margin-bottom: 10px;">
                        Email Address
                    </label>
                    <input class="manrope-normal w-full @error('email') border-red-500 @enderror"
                        style="border-radius: 15px; background-color: #F5F5F5; height: 50px; padding: 0 15px; margin-bottom: 30px; font-size: 15px; color: #344563; border: 1px solid transparent; outline: none;"
                        type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>

                    <button class="w-full text-white manrope-semibold" style="background: linear-gradient(to bottom, #9CA3AF, #374151); font-size: 17px; padding: 13px; border-radius: 15px; border: none; cursor: pointer;" type="submit">
                        Send Reset Link
                    </button>

                    <p class="text-center manrope-medium" style="margin-top: 20px;">
                        <a href="{{ route('superadmin.login.page') }}" style="color: #374557; font-size: 15px; text-decoration: none;">
                            Back to Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="{{asset('admin-theme/assets/js/jquery-3.7.1.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.9.1/cdn.js"></script>
<script src="{{asset('admin-theme/assets/js/custom-script.js')}}"></script>

</html>
