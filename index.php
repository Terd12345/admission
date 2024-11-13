<?php

// include "../include/initialize.php";


?>

<?php include 'header.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pearl of The Orient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
    


<style>
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it covers everything */
        }

        .spinner {
            border: 8px solid #f3f3f3; /* Light grey */
            border-top: 8px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>








    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
    </div>

    <script>
        // Hide the loading screen once the page is fully loaded
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.display = 'none';
        });
    </script>

    <!-- HERO -->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-left" class="text-uppercase text-black fw-semibold display-1">Pearl of The Orient</h1>
                    <h5 class="text-black mt-3 mb-4" data-aos="fade-right"><mark>Pearl of the Orient Theological Seminary & Colleges is committed to provide you the cost-efficient but with high impact education degree services. We strive to provide results-oriented leaders and educators that are globally competitive.</h5></mark>
                    <div data-aos="fade-up" data-aos-delay="50">
                        <a href="./applicantsPortal" target="_blank" class="btn btn-brand me-2">Admission</a>
                        <!-- <a href="#" class="btn btn-light ms-2">Our Portfolio</a> -->
                        <a class="btn btn-brand me-2" href="./assets/printableForm/printableForm.pdf" target="_blank">Downloadable Form</a>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ABOUT -->
<section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">About us</h1>
                        <div class="line"></div>
                        <!-- <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <img src="./assets/images/bgB.jpg" alt="">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <!-- <h1>About Us</h1> -->
                    <!-- <p class="mt-3 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quo reiciendis ad.</p> -->
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-lightbulb-fill"></i>
                        </div>
                        <div>
                            <h5>Philosophy</h5>
                            <p>Pearl of the Orient Theological Seminary & Colleges Inc. believes in the vagueness of individual 
                                and it must be rested as a creation of God. We believe the quality of Education is an instrument for 
                                liberating from the bondage of poverty, quality of education must be indiscriminately accessible to
                                 all in order to realize the ultimate aim of existence.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-eye-fill"></i>
                        </div>
                        <div>
                            <h5>Vision</h5>
                            <p>Pursuit of excellence, loving God, creativity, and appreciation of nature, arts, 
                                and technology. Emphasizes spiritual formation, mastery of biblical content, 
                                and interpretation cultivation of biblical worldview and ministry skill development.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="iconbox me-4">
                            <i class="ri-focus-2-line"></i>
                        </div>
                        <div>
                            <h5>Mission</h5>
                            <p>Total development of loving God, well-disciplined, skillful, morally upright, 
                                and globally competitive Individuals, who are proud of being Filipino, their Identity, 
                                cultural heritage, and productive members of the community & society.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    



        <!-- COURSES OFFERED -->
<section id="reviews" class="section-padding bg-light" data-aos="fade-down" data-aos-delay="50">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h1 class="display-4 fw-semibold">Courses Offered</h1>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Certificate Programs -->
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold">Certificate Programs (1 Year)</h2>
                <ul class="list-unstyled">
                    <li>Certificate in Christian Evangelism</li>
                    <li>Certificate in Christian Ministry</li>
                    <li>Certificate in ECE & SPED Management</li>
                    <li>Certificate in Advanced Ministerial</li>
                    <li>Certificate in Associate Theology</li>
                </ul>
            </div>
            <!-- Bachelor Programs -->
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold">Bachelor Programs (4 Years)</h2>
                <ul class="list-unstyled">
                    <li>Bachelor of Theology</li>
                    <li>Bachelor of Theology Major in Pastoral Ministry</li>
                    <li>Bachelor of Theology Major in Chaplaincy</li>
                    <li>Bachelor of Religious Education</li>
                    <li>Bachelor of Christian Ministry Major in Human Resources & Community Development</li>
                    <li>Bachelor of Christian Ministry Major in Christian Leadership</li>
                    <li>Bachelor in Mission Major in Cross Culture</li>
                    <li>Bachelor in Christian Counseling</li>
                    <li>Bachelor of Christian Ministry in Naturopathic Medicine</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- Master Programs -->
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold">Master Programs / with Thesis (2 Years)</h2>
                <ul class="list-unstyled">
                    <li>Master in Theology</li>
                    <li>Master of Divinity</li>
                    <li>Master of Religious Education</li>
                    <li>Master of Christian Ministry in Complementary and Alternative Medicine Major in Naturopathy</li>
                    <li>Master of Christian Ministry Major in Christian Leadership</li>
                    <li>Master of Arts & Mission</li>
                    <li>Master in Christian Counseling</li>
                </ul>
            </div>
            <!-- Doctorate Programs -->
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold">Doctorate Programs / with Dissertation (3 Years)</h2>
                <ul class="list-unstyled">
                    <li>Doctor of Christian Ministry</li>
                    <li>Doctor of Ministry in Alternative Medicine</li>
                    <li>Doctor of Theology</li>
                    <li>Doctor of Religious Education</li>
                    <li>Doctor of Philosophy Major in Christian Leadership and Management</li>
                    <li>Doctor of Philosophy Major in Biblical Studies</li>
                    <li>Doctor of Philosophy in Theology</li>
                    <li>Doctor of Philosophy in Christian Apologetics</li>
                    <li>Doctor of Philosophy in Philosophy in Religion</li>
                    <li>Doctor of Philosophy Major in Pastoral Ministry</li>
                    <li>Doctor of Philosophy Major in Pastoral Guidance and Counseling</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section id="proc" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                     <h1 class="display-4 fw-semibold">What are The Requirements & Admission Procedures?</h1>
                        <div class="line"></div>
                        <!-- <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p> -->
                    </div>
                </div>
            </div>
            <div class="row" justify-content-center>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/2.png" alt="" class="mx-auto d-block">
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/guide.png" alt="">
                        </div>
                    </div>
                </div>


<br>

        </div>

        <br><br>

        <a href="/Admin_Caps/pearlLanding/applicantsPortal/index.php"><button class="btn btn-danger" style="margin-left: 45%;">Apply Now!</button></a>
    </section>










    <style>
        .theme-shadow{
            min-height: 540px;
        }
    </style>


    <!-- SERVICES -->
    <section id="services" class="section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Why Choose Us?</h1>
                        <div class="line"></div>
                        <!-- <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p> -->
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class=" theme-shadow p-lg-5 p-4" style="background-color: #4e57d4">
                        <div class="iconbox">
                            <i class="ri-pen-nib-fill" style="color: white;"></i>
                        </div>
                        <h5 class="mt-5 mb-3" style="color: white;">Reliable</h5>
                        <p style="color: white;">We exist to provide extensive biblical training for pastors, 
                            church leaders, and members. Pearl of the Orient is a Spirit-Filled 
                            Theological Seminary emphasizing spiritual formation, mastery of Biblical 
                            content and interpretation skills, cultivation of a Biblical world-view, and 
                            ministry skills development, the latter through field education and internship experiences.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250" >
                    <div class=" theme-shadow p-lg-5 p-4" style="background-color: #4e57d4">
                        <div class="iconbox">
                            <i class="ri-stack-fill" style="color: white;"></i>
                        </div>
                        <h5 class="mt-4 mb-3" style="color: white;">Accessible</h5>
                        <p style="color: white;">   Our flexible course scheduling allows students to balance family, career, and ministry without relocating. They can study online or at locations in Luzon, Visayas, and Mindanao. Students earning degrees receive PC Bible Software for access to a vast theological library. We also offer merit-based financial aid to make seminary training more affordable and continuously seek new ways to train students before graduation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class=" theme-shadow p-lg-5 p-4" style="background-color: #4e57d4; height: 540px;">
                        <div class="iconbox">
                            <i class="ri-emotion-laugh-line" style="color: white;"></i>
                        </div>
                        <h5 class="mt-4 mb-3" style="color: white;">Fascinating</h5>
                        <p style="color: white;">   Our Mission statement, which shares our commitment to 'learn the way of Jesus in order to cultivate vital communities, vital conversations, and the public good,' better expresses the core of a Pearl education. Learning the way of Jesus. Jesus taught a way of walking, a way to live characterized by a radical love of God and neighbor. How do we practice that way, and teach and lead others to do the same.</p>
                    </div>
                </div>



                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class=" theme-shadow p-lg-5 p-4" style="background-color: #4e57d4; ">
                        <div class="iconbox">
                            <i class="ri-task-fill" style="color: white;"></i>
                        </div>
                        <h5 class="mt-4 mb-3" style="color: white;">Challenging</h5>
                        <p style="color: white;">   All graduate theological education is challenging, no doubt. There are seemingly endless pages to read and scores of pages to write. But see what a Pearl graduate at a Cavite area school wrote about the support for meeting challenges at Pearl: 'Community at Pearl plays a huge part in understanding. We sit with and listen to one another, challenge, accept, push, and transform each other. I learned both in the classroom and beyond that to be a person of faith is to be a person open to embracing relationship with others, by those who both challenge and accept us. Faith doesn't happen alone. We experience God with one another, I was changed, and truly became a person of faith in my time at Pearl. At Pearl, you will be challenged by the work, the reading and writing, the depth of reflection. You will also experience a community in which the challenges can be successfully met.</p>
                    </div>
                </div>



                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class=" theme-shadow p-lg-5 p-4" style="background-color: #4e57d4;">
                        <div class="iconbox">
                            <i class="ri-pie-chart-2-fill" style="color: white;"></i>
                        </div>
                        <h5 class="mt-4 mb-3" style="color: white;">Bridging</h5>
                        <p style="color: white;">   Students and graduates from across the Philippines and some parts of the world often describe how deeply they value the community and the life-long friendships initiated here. This perception of community and friendship may come as a surprise when you also catch that Pearl is a commuter school that owns no residential housing for students. But some students have transferred to Pearl from other seminaries with housing because they found a richer community of life here. And, students who take courses online report how much the friendship and community enhance by attending week-long concentrated courses.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


    <?php

class Database {
    public $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->conn = new mysqli($host, $user, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close() {
        $this->conn->close();
    }
}

$mydb = new Database('localhost', 'root', '', 'admin_caps');

function getTotalApplicants($mydb) {
    $sql = "SELECT COUNT(*) as total_applicants FROM applicants";
    $result = mysqli_query($mydb->conn, $sql) or die(mysqli_error($mydb->conn));
    $row = mysqli_fetch_array($result);
    return $row['total_applicants'];
}

// Update the queries for courses and instructors
$dash_category_query = "SELECT COUNT(*) AS total_courses FROM course"; 
$dash_category_query_run = mysqli_query($mydb->conn, $dash_category_query);
$row = mysqli_fetch_assoc($dash_category_query_run);
$total_courses = $row['total_courses'];

$dash_category_query = "SELECT COUNT(*) AS total_instructors FROM instructors"; 
$dash_category_query_run = mysqli_query($mydb->conn, $dash_category_query);
$row = mysqli_fetch_assoc($dash_category_query_run);
$total_instructors = $row['total_instructors'];

$total_applicants = getTotalApplicants($mydb);

$mydb->close(); // Close the database connection
?>

<!-- COUNTER -->
<section id="counter" class="section-padding">
    <div class="container text-center">
        <div class="row g-4">
            
            <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                <h1 class="text-white display-4"><?php echo number_format($total_applicants); ?></h1>
                <h6 class="text-uppercase mb-0 text-white mt-3">Total Applicants</h6>
            </div>

            <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                <h1 class="text-white display-4"><?php echo number_format($total_courses); ?></h1>
                <h6 class="text-uppercase mb-0 text-white mt-3">Total Courses</h6>
            </div>

            <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                <h1 class="text-white display-4"><?php echo number_format($total_instructors); ?></h1>
                <h6 class="text-uppercase mb-0 text-white mt-3">Total Instructors</h6>
            </div>

        </div>
    </div>
</section>





    <!-- PORTFOLIO -->
    <section id="portfolio" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Gallery</h1>
                        <div class="line"></div>
                        <p>Pearl of the Orient Theological Seminary & Colleges is committed to provide you the cost-efficient but with high impact education degree services. We strive to provide results-oriented leaders and educators that are globally competitive.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/bgB.jpg" alt="">
                        </div>
                        <a href="./assets/images/bgB.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/1.jpg" alt="">
                        </div>
                        <a href="./assets/images/1.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/canteen.jpg" alt="">
                        </div>
                        <a href="./assets/images/canteen.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/music.jpg" alt="">
                        </div>
                        <a href="./assets/images/music.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/lib.jpg" alt="">
                        </div>
                        <a href="./assets/images/lib.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/r.jpg" alt="">
                        </div>
                        <a href="./assets/images/r.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <a href="./assets/images/complete.pdf" style="border: 3px solid black;" class="btn col-12 button-center" target="_blank">VIEW FUll PDF</a>
            </div>
        </div>
    </section>



    <!-- CONTACT -->
    <section class="section-padding bg-light" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 text-white fw-semibold">Contact Us</h1>
                        <div class="line bg-white"></div>
                        <p class="text-white">we'd like to hear something from you</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="250">
                <div class="col-lg-8">
                    <form action="send.php" class="row g-3 p-lg-5 p-4 bg-white theme-shadow" method="POST">

                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" name="fname" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" name="lname" placeholder="Enter last name" required>
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email address" required>            
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="text" class="form-control" name="subject" placeholder="Enter subject" required>
                        </div>
                        <div class="form-group col-lg-12">
                            <textarea name="message" rows="5" class="form-control" name="message" placeholder="Enter Message" required></textarea>
                        </div>
                        <div class="form-group col-lg-12 d-grid">
                            <button type="submit" name="send" class="btn btn-brand">Send Message</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>





    <section>
        <div class="container" style="margin-bottom: 15%;">
        <!-- Location Map Section -->
        <div class="row mt-5" id="map">
            <div class="col-lg-12">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.832129415245!2d120.99392493983865!3d14.321181776777037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d7f9833b56cd%3A0xc8d882ea10e20519!2sPearl%20of%20the%20orient%20international%20auxiliary%20chaplains%20values%20educator%20Inc!5e0!3m2!1sen!2sph!4v1726367120593!5m2!1sen!2sph"
                        width="100%"
                        height="450"
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                        aria-hidden="false"
                        tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>


    



<?php include 'footer.php'; ?>

  
</body>

</html>