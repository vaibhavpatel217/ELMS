<?php
session_start();
?>
<?php
include_once('includes/style.php')
  ?>

<body class="hold-transition login-page">

  <!-- 🎓 Background Slideshow (e-learning themed) -->
  <div class="bg-slideshow">
    <img src="dist/img/slide1.jpg" class="slide active" alt="E-learning 1">
    <img src="dist/img/slide2.jpg" class="slide" alt="E-learning 2">
    <img src="dist/img/slide3.jpg" class="slide" alt="E-learning 3">
    <img src="dist/img/slide4.jpg" class="slide" alt="E-learning 4">
  </div>

  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="dashboard.php" class="h1"><b>E</b>-learning</a>
      </div>
      <div class="card-body">

        <?php
        if (isset($_SESSION['error'])) {
          ?>
          <p class="login-box-msg text-danger"><?php echo $_SESSION['error']; ?></p>
          <?php
          unset($_SESSION['error']);
        }
        ?>

        <form action="login_check.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control custom-input" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text custom-icon">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control custom-input" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text custom-icon">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block custom-btn">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include_once('includes/script.php')
    ?>

  <!-- Background Slideshow CSS -->
  <style>
    /* Input fields */
    .custom-input {
      border-radius: 8px;
      border: 1px solid #ced4da;
      padding: 10px 15px;
      font-size: 15px;
      color: #333;
      transition: all 0.3s ease;
    }

    .custom-input::placeholder {
      color: #6c757d;
      /* soft gray placeholder */
      font-style: italic;
    }

    /* Input focus */
    .custom-input:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
      outline: none;
    }

    /* Icon background */
    .custom-icon {
      background-color: #007bff;
      /* blue background */
      color: #fff;
      /* white icon */
      border-radius: 0 8px 8px 0;
    }

    /* Button styling */
    .custom-btn {
      background-color: #007bff;
      border: none;
      border-radius: 8px;
      padding: 10px 0;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .custom-btn:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
      position: relative;
      height: 100vh;
    }

    .bg-slideshow {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .bg-slideshow img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
    }

    .bg-slideshow img.active {
      opacity: 1;
    }

    .login-box {
      z-index: 10;
      position: relative;
    }
  </style>

  <!-- Slideshow Script -->
  <script>
    let slides = document.querySelectorAll('.bg-slideshow img');
    let current = 0;

    function showSlide() {
      slides[current].classList.remove('active');
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }

    setInterval(showSlide, 3000); // Change every 3 seconds
  </script>