<?php
// Fetch contact details
include('includes/contact_data.php');
?>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow animate__animated animate__fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.2s">
                <h4 class="text-white mb-3 footer-title">Quick Link</h4>
                <a class="btn btn-link footer-link" href="about.php">About Us</a>
                <a class="btn btn-link footer-link" href="contact.php">Contact Us</a>
                <a class="btn btn-link footer-link" href="admin/">Admin Login</a>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
                <h4 class="text-white mb-3 footer-title">Contact</h4>
                <p class="mb-2">
                    <i class="fa fa-map-marker-alt me-3 text-primary"></i>
                    <?php echo isset($contacts['Office']) ? $contacts['Office'] : 'Not Available'; ?>
                </p>
                <p class="mb-2">
                    <i class="fa fa-phone-alt me-3 text-primary"></i>
                    <?php echo isset($contacts['Mobile']) ? $contacts['Mobile'] : 'Not Available'; ?>
                </p>
                <p class="mb-2">
                    <i class="fa fa-envelope me-3 text-primary"></i>
                    <?php echo isset($contacts['Email']) ? $contacts['Email'] : 'Not Available'; ?>
                </p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social animate-hover" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social animate-hover" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social animate-hover" href="#"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social animate-hover" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Gallery -->
            <div class="col-lg-3 col-md-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.6s">
                <h4 class="text-white mb-3 footer-title">Gallery</h4>
                <div class="row g-2 pt-2">
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-1.jpg" alt=""></div>
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-2.jpg" alt=""></div>
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-3.jpg" alt=""></div>
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-4.jpg" alt=""></div>
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-5.jpg" alt=""></div>
                    <div class="col-4"><img class="img-fluid bg-light p-1 gallery-img" src="img/course-6.jpg" alt=""></div>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.8s">
                <h4 class="text-white mb-3 footer-title">Newsletter</h4>
                <p>Stay updated with our latest courses & news.</p>
                <form action="subscribe.php" method="POST">
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5 newsletter-input" type="email"
                            name="email" placeholder="Your email" required>
                        <button type="submit"
                            class="btn btn-gradient py-2 position-absolute top-0 end-0 mt-2 me-2 animate-hover">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer CSS -->
<style>
    .footer-title {
        position: relative;
        display: inline-block;
        animation: glow 2s infinite alternate;
    }

    .footer-title::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(45deg, #007bff, #00d4ff);
        border-radius: 2px;
    }

    .footer-link {
        color: #bbb !important;
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        color: #00d4ff !important;
        transform: translateX(6px);
    }

    .btn-social {
        transition: all 0.4s ease;
        border-radius: 50%;
    }

    .btn-social:hover {
        transform: scale(1.3) rotate(15deg);
        background: linear-gradient(45deg, #007bff, #00d4ff);
        border: none;
        color: #fff !important;
    }

    .gallery-img {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .gallery-img:hover {
        transform: scale(1.15) rotate(2deg);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
    }

    .newsletter-input {
        border-radius: 30px;
        box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.2);
    }

    .btn-gradient {
        background: linear-gradient(45deg, #007bff, #00d4ff);
        border: none;
        border-radius: 25px;
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #00d4ff, #007bff);
        transform: scale(1.1);
    }

    @keyframes glow {
        from {
            text-shadow: 0 0 5px #007bff, 0 0 10px #00d4ff;
        }

        to {
            text-shadow: 0 0 20px #00d4ff, 0 0 30px #007bff;
        }
    }
</style>
