<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Pengaduan Masyarakat</title>

  <!-- Bootstrap CSS & Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .left-panel {
      flex: 1;
      background: linear-gradient(to bottom right, #a5d6f9, #60b5ff);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px;
      color: white;
    }

    .left-panel .content {
      width: 100%;
      max-width: 400px;
    }

    .left-panel h1 {
      font-size: 2.5rem;
      font-weight: bold;
      font-style: italic;
      margin-bottom: 30px;
    }

    .form-label {
      color: #fff;
    }

    .form-control {
      border-radius: 10px;
      border: none;
      padding: 10px 15px;
    }

    .input-group-text {
      background-color: white;
      border: none;
    }

    .btn-login {
      background-color: white;
      color: #60b5ff;
      font-weight: bold;
      width: 100%;
      border: 2px solid white;
      border-radius: 10px;
      transition: 0.3s ease;
    }

    .btn-login:hover {
      background-color: transparent;
      color: white;
    }

    .right-panel {
      flex: 1;
      background: url('img/Masyarakat.jpg') center center / cover no-repeat;
      filter: blur(2px) brightness(0.8);
    }

    .register-link {
      margin-top: 15px;
      text-align: center;
    }

    .register-link a {
      color: white;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
      }

      .right-panel {
        display: none;
      }

      .left-panel {
        width: 100%;
        padding: 30px;
        justify-content: flex-start;
      }

      .left-panel h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

<div class="login-wrapper">
  <div class="left-panel">
    <div class="content">
      <h1>Pengaduan<br>Masyarakat</h1>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
          </div>
          @error('email')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          @error('password')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-login mt-3">Login</button>

        <div class="register-link">
          <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
        </div>
      </form>
    </div>
  </div>
  <div class="right-panel"></div>
</div>

</body>
</html>
