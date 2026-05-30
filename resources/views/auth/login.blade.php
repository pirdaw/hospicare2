<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>HOSPICARE — Login</title>
  <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
  <div class="container">
    <!-- BAGIAN KIRI -->
    <div class="left">
      <div class="form-box">
        <h2>Log in HOSPICARE</h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        {{-- Form login yang benar: method POST, action ke route login.post, ada @csrf, ada name --}}
        <form action="{{ route('login.post') }}" method="POST">
          @csrf

          <label>Email Address</label>
          <input type="email" name="email" placeholder="admin@hospicare.id" value="{{ old('email') }}" required />

          <label>Password</label>
          <input type="password" name="password" placeholder="********" required />

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
</body>

</html>