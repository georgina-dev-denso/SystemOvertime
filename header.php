<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Team Leader website</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Unicons: Biblioteca de iconos -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Favicons -->
  <link href="Avilon/Avilon/assets/img/favicon.png" rel="icon">
  <link href="Avilon/Avilon/assets/img/apple-touch-icon.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="style.css" rel="stylesheet">

  <!-- Scripts for PDF generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <!-- Custom Scripts -->
  <script src="registro.js"></script>
  <script src="password-toggle.js"></script>
  <script src="operaciones.js"></script>
  <script src="guardarovertime.js"></script>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="header-left">
        <ul class="navbar-left d-flex align-items-center">            
          <li class="user-info">
              <?php include('infoUser.php'); ?>
            </li> 
            <li><a class="nav-link scrollto active" href="index.php">Inicio</a></li>  
            <li><a href="annualplan.php">Dashboard</a></li>
            <li><a class="nav-link scrollto active" href="#Visualizar">Visualizaciones</a></li>
        </ul>
      </div>

      <div class="header-right d-flex align-items-center">
        <div id="logo">
          <h1><a href="index.php">Overtime Website</a></h1>
        </div>
        <li class="logout-icon">
          <a href="login.html" id="logout-link">
            <i class="bi bi-power" style="font-size: 26px;"></i>
          </a>
        </li>
      </div>
    </div>
  </header>
