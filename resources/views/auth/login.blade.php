<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>HOSPICARE — Login</title>
  <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
  <style>
    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 44px;
      width: 100%;
    }

    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      color: #888;
      font-size: 16px;
      line-height: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toggle-password:hover {
      color: #4F6F6F;
    }

    .toggle-password:focus {
      outline: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- BAGIAN KIRI -->
    <div class="left">
      <div class="form-box">
        <h2>Log in HOSPICARE</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
          @csrf

          <label>Email Address</label>
          <input type="email" name="email" placeholder="admin@hospicare.id" value="{{ old('email') }}" required />

          <label>Password</label>
          <div class="password-wrapper">
            <input type="password" name="password" id="passwordInput" placeholder="********" required />
            <button type="button" class="toggle-password" id="togglePassword" onclick="togglePasswordVisibility()"
              title="Tampilkan/Sembunyikan Password">
              <!-- ikon mata terbuka (default) -->
              <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <!-- ikon mata dicoret (saat password terlihat) -->
              <svg id="iconEyeOff" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                style="display:none;">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8
                         a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4
                         c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07
                         a3 3 0 1 1-4.24-4.24" />
                <line x1="1" y1="1" x2="23" y2="23" />
              </svg>
            </button>
          </div>

          <button type="submit">Login</button>
        </form>
      </div>
    </div>

    <!-- BAGIAN KANAN -->
    <div class="right">
      <div class="circle-content">
        <h1>HOSPICARE SYSTEM</h1>
        <p>Sistem Pendaftaran Rumah Sakit</p>
        <div class="ikon">Rumah Sakit Graha Sehat</div>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      var input = document.getElementById('passwordInput');
      var eyeOn = document.getElementById('iconEye');
      var eyeOff = document.getElementById('iconEyeOff');

      if (input.type === 'password') {
        input.type = 'text';
        eyeOn.style.display = 'none';
        eyeOff.style.display = 'block';
      } else {
        input.type = 'password';
        eyeOn.style.display = 'block';
        eyeOff.style.display = 'none';
      }
    }
  </script>
</body>

</html>