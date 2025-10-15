<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login HDNVerse | Portal Masa Kini</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
<link rel="icon" type="image/png" href="{{ asset ('assets/splash/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/vendor/bootstrap/css/bootstrap.min.css') }}">

<link rel="manifest" href="/manifest.json">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('assets/splash/css/main.css') }}">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="login-login100" style="background-image: url('{{ asset ('assets/splash/images/img-06.jpg') }}');">
      <div class="wrap-login100 p-t-60 p-b-30" style="padding-top: 10px;">

        <span class="login100-form-title p-b-45">
          <img width="70%" src="{{ asset ('assets/splash/images/hdnverse.png') }}" alt="AVATAR">
        </span>
        @error('login_gagal')
        {{-- <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span> --}}
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{-- <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span> --}}
          <span class="alert-inner--text"><strong>Error!</strong> {{ $message }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @enderror
        @if($errors->has('email'))
        <span class="error" style="color:red"><b style="font-size:12px">Pastikan Email yang ada masukan benar!!</b></span>   
        @endif

        @if($errors->has('password'))
        <span class="error" style="color:red"><b style="font-size:12px">Password wajib diisi!!</b></span>   
        @endif
        
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
            <input class="input100" type="text" name="email" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user"></i>
            </span>
          </div>

          <div class="wrap-input100 m-b-10">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock"></i>
            </span>
          </div>

          <div class="container-login100-form-btn p-t-10">
            <button class="babantos100-form-btn" id="login">
              Login
            </button>
          </div>
        </form>   
      </div>
    </div>




<!--===============================================================================================-->  
<script src="{{ asset ('assets/splash/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset ('assets/splash/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset ('assets/splash/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset ('assets/splash/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset ('assets/splash/js/main.js') }}"></script>

<script type="text/javascript">

    // $('#login').on('click', function () {

   //        window.location.href = '/mobile/homes';

   //    });

  function Google(){

    window.location.href = '/mobile/auth/google';

  }

</script>

</body>
</html>