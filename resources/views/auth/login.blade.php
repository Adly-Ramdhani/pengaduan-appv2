<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    html, body {
        height: 100%;
        margin: 0;
        width: 100%;
    }

    .container-fluid {
        height: 100vh;
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .login-card {
        display: flex;
        width: 100%;
        max-width: 1000px;
        height: 600px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        flex-direction: row;
    }

    .login-card .left,
    .login-card .right {
        flex: 1;
    }

    .login-card .left {
        background: #eef2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card .right {
        background: #4A90E2;
        padding: 60px 40px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-control {
        border-radius: 20px;
    }

    .btn-primary {
        width: 100%;
        border-radius: 20px;
    }

    @media (max-width: 768px) {
        .login-card {
            flex-direction: column;
            height: auto;
        }

        .login-card .left {
            padding: 20px;
            height: 200px;
        }

        .login-card .right {
            padding: 40px 20px;
        }
    }

    @media (max-width: 480px) {
        .login-card .right h3 {
            font-size: 1.4rem;
        }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="login-card">
      <div class="left">
        <img src="img/logo-pengaduan.png" alt="Illustration" class="img-fluid" style="max-height: 200px;">
      </div>
      <div class="right">
        <h3 class="text-center mb-4">Sign in to your account</h3>
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            @error('email')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" class="form-control" id="password" name="password" required>
              <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                <i class="bi bi-eye" id="eyeIcon"></i>
              </span>
            </div>
            @error('password')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <div class="text-center mt-3">
            <a class="text-white" href="{{ route('register') }}">Register</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      eyeIcon.classList.toggle('bi-eye');
      eyeIcon.classList.toggle('bi-eye-slash');
    });
  </script>
</body>
</html>
