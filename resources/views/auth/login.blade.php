<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login </title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('tinydash/dark/css/simplebar.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('tinydash/dark/css/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('tinydash/dark/css/app-dark.css') }}" id="darkTheme">

  <style>
    body { font-family: 'Poppins', sans-serif; background: radial-gradient(circle at 20% 20%, #1a1f2b, #0d1117); color: #fff; }
    .login-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius:16px; box-shadow:0 0 30px rgba(0,0,0,0.4); padding:2rem 2.5rem; }
    .form-control { background-color: rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); color:#fff; border-radius:12px; padding:0.8rem 1rem; }
    .form-control:focus { background-color: rgba(255,255,255,0.15); border-color: #0d6efd; box-shadow:0 0 0 0.2rem rgba(13,110,253,0.25); color:#fff; }
    .btn-primary { border-radius:12px; padding:0.75rem; font-weight:600; background:linear-gradient(135deg,#007bff,#6610f2); border:none; }
    .btn-primary:hover { background:linear-gradient(135deg,#0056b3,#520dc2); transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,123,255,0.3); }
    .invalid-feedback { display:block; font-size:0.85rem; color:#ff6b6b; margin-top:0.25rem; text-align:left; }
    .alert { border-radius:10px; }
    .login-title { font-weight:600; font-size:1.3rem; margin-bottom:1.5rem; letter-spacing:0.5px; }
  </style>
</head>

<body class="dark">
  <div class="wrapper vh-100 d-flex justify-content-center align-items-center">
    <form class="login-card text-center col-lg-3 col-md-5 col-10" method="POST" action="{{ route('login.proses') }}">
      @csrf

      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 120 120" xml:space="preserve">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15" />
          </g>
        </svg>
      </a>

      <h1 class="login-title">Sign In to Your Account</h1>

      {{-- Error dari Auth --}}
      @if(session('error'))
        <div class="alert alert-danger text-left py-2 px-3 mb-3">{{ session('error') }}</div>
      @endif

      {{-- Input Email --}}
      <div class="form-group mb-3 text-left">
        <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
               placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Input Password --}}
      <div class="form-group mb-3 text-left">
        <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror"
               placeholder="Password" name="password" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <label class="mb-0">
          <input type="checkbox" name="remember" value="1"> <small>Remember me</small>
        </label>
        <a href="#" class="text-primary small">Forgot password?</a>
      </div>

      <button type="submit" class="btn btn-primary btn-block w-100">Login</button>

      <small>
        <p class="mt-4 text-muted small">Don't have an account?
          <a href="#" class="text-white">Register</a>
        </p>
        <p class="mt-4 text-muted small">Back to Home page?
          <a href="{{ route('welcome') }}" class="text-white">Dashboard</a>
        </p>
      </small>
      <p class="mt-4 text-muted small">© 2025</p>
    </form>
  </div>

  <!-- JS -->
  <script src="{{ asset('tinydash/dark/js/jquery.min.js') }}"></script>
  <script src="{{ asset('tinydash/dark/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

  @if(session('success'))
  <script>
    Swal.fire({
      title: "Berhasil!",
      text: @json(session('success')),
      icon: "success",
      showConfirmButton: true,
      confirmButtonText: "OK",
      timer: 3000,
      timerProgressBar: true
    });
  </script>
  @endif
  
  @if(session('error'))
  <script>
    Swal.fire({
      title: "Gagal!",
      text: @json(session('error')),
      icon: "error",
      showConfirmButton: true,
      confirmButtonText: "OK",
      timer: 4000,
      timerProgressBar: true
    });
  </script>
  @endif  
</body>
</html>
