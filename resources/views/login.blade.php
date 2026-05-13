<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>HOSPICARE</title>
    <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
  </head>
  <body>
    <div class="container">
      <!-- BAGIAN KIRIII -->
      <div class="left">
        <div class="form-box">
          <h2>Log in HOSPICARE</h2>

          <form action="{{ url('/dashboard') }}">
            <label>Email Address</label>
            <input type="email" placeholder="abcde123@gmail.com" />

            <label>Password</label>
            <input type="password" placeholder="********" />

            <button type="submit">Login</button>
          </form>
        </div>
      </div>

      <!-- BAGIAN KANANNN -->
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
