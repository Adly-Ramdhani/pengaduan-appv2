<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaduan Masyarakat</title>
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
      font-family: Arial, sans-serif;
    }

    .main-wrapper {
      position: relative;
      height: 100vh;
      background-image: url('img/Masyarakat.jpg');
    }

    .main-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.4); /* Warna putih dengan transparansi lebih rendah */
        backdrop-filter: blur(3px); /* Efek blur lebih ringan */
        z-index: 1;
      }
      

    .overlay-left {
      position: absolute;
      top: 0;
      left: 0;
      width: 80%;
      height: 100%;
      background: linear-gradient(to right, #AFDDFF, #60B5FF);
      clip-path: polygon(0 0, 85% 0, 70% 100%, 0% 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 200px;
      color: white;
      z-index: 2;
    }

    .overlay-left h1 {
      font-weight: bold;
      font-style: italic;
    }

    .overlay-left p {
      margin-top: 20px;
      font-size: 1rem;
    }

    .overlay-left .btn {
      margin-top: 30px;
      background-color: #60B5FF;
      color: white;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .floating-buttons {
      position: absolute;
      top: 50%;
      right: 40px;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 20px;
      z-index: 3;
    }

    .floating-buttons .btn-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #60B5FF;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      border: none;
    }

    @media (max-width: 768px) {
      .overlay-left {
        width: 100%;
        clip-path: none;
        padding: 40px;
      }

      .floating-buttons {
        right: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="main-wrapper">
    <div class="overlay-left">
      <div>
        <h1> Pengaduan<br>Masyarakat</h1>
        <p>
            Situs web pengaduan masyarakat adalah platform daring <br> yang dirancang untuk memungkinkan warga negara <br>
             menyampaikan keluhan, aspirasi, dan laporan <br> mengenai berbagai masalah yang mereka 
             hadapi terkait <br> pelayanan publik, infrastruktur, atau isu-isu sosial lainnya.
        </p>
        <a href="{{ route('login') }}" class="btn">Login!</a>
      </div>
    </div>
  </div>
</body>
</html>
