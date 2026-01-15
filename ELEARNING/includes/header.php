<?php
// session_start();
?>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0 animate__animated animate__fadeInDown">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">
            <i class="fa fa-book me-3 text-gradient"></i>E-LEARNING
        </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse animate__animated animate__fadeIn" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link  nav-animate">Home</a>
            <a href="about.php" class="nav-item nav-link nav-animate">About</a>
            <a href="courses.php" class="nav-item nav-link nav-animate">Courses</a>
            <div class="nav-item dropdown nav-animate">
                <div class="dropdown-menu fade-down m-0">
                    <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                    <a href="404.php" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="feedback.php" class="nav-item nav-link nav-animate">Feedback</a>
            <a href="contact.php" class="nav-item nav-link nav-animate">Contact</a>
            <a href="logout.php" class="nav-item nav-link nav-animate">Logout</a>
        </div>
        <h3 class="btn btn-primary py-3 px-lg-5 d-none d-lg-block animate__animated animate__pulse animate__infinite">
            Welcome,
            <?php echo htmlspecialchars(isset($_SESSION['student_name']) ? $_SESSION['student_name'] : 'Guest'); ?>
        </h3>
    </div>
</nav>
<!-- Navbar End -->

<!-- Custom CSS Animation -->
<style>
    /* Smooth hover effect for nav links */
    .nav-animate {
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    .nav-animate::after {
        content: "";
        position: absolute;
        width: 0%;
        height: 3px;
        bottom: 0;
        left: 0;
        background: linear-gradient(45deg, #007bff, #00d4ff);
        transition: width 0.3s ease-in-out;
    }

    .nav-animate:hover::after {
        width: 100%;
    }

    .nav-animate:hover {
        color: #007bff !important;
        transform: translateY(-3px);
    }

    /* Gradient effect on logo icon */
    .text-gradient {
        background: linear-gradient(45deg, #007bff, #00d4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Animate.css link */
</style>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->