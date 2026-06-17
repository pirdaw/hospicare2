<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>HOSPICARE — Login</title>
  <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Wrapper password harus block supaya tingginya mengikuti input di dalamnya */
    .password-wrapper {
      position: relative;
      display: block;
      margin-top: 5px;
    }

    /* Input password di dalam wrapper — samakan style dengan email input di login.css */
    .password-wrapper input[type="password"],
    .password-wrapper input[type="text"] {
      width: 100%;
      padding: 12px;
      padding-right: 44px;
      /* ruang untuk ikon di kanan */
      margin-top: 0;
      /* margin sudah di wrapper */
      background: #f1f7f7;
      border: none;
      border-radius: 15px;
      box-shadow:
        inset 4px 4px 8px rgba(93, 107, 107, 0.2),
        inset -4px -4px 8px rgba(255, 255, 255, 0.8);
      outline: none;
      display: block;
    }

    /* Tombol mata — absolut di tengah vertikal, pojok kanan input */
    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      margin: 0;
      color: #888;
      font-size: 15px;
      line-height: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      /* Pastikan button tidak ikut di-style oleh selector `button` di login.css */
      width: auto;
      border-radius: 0;
    }

    .toggle-password:hover {
      color: #4F6F6F;
      background: none;
    }

    .toggle-password:focus {
      outline: none;
      background: none;
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
              <i id="iconEye" class="fas fa-eye"></i>
              <i id="iconEyeOff" class="fas fa-eye-slash" style="display:none;"></i>
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