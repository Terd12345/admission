
<?php

include 'header.php';
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">





<style>
    .card {
    height: 100%; /* Ensures all cards have the same height */
}
</style>


    <section id="news-section" class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <!-- News Card 1 -->
            <div class="col-md-4 mb-4 d-flex">
                <a href="news_view.php" class="text-decoration-none text-dark flex-fill">
                    <div class="card border-0 shadow-sm rounded flex-fill">
                        <div class="position-relative">
                            <img src="assets/images/1.jpg" class="card-img-top rounded-top" alt="News Image 1">
                            <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom" style="background-color: #d32f2f;">Oct 15, 2024</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Exciting News Headline</h5>
                            <p class="card-text">A brief description of the news article. It gives a glimpse into the content and entices readers to learn more...</p>
                            <span class="text-primary fw-semibold mt-auto">Read More</span>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- News Card 2 -->
            <div class="col-md-4 mb-4 d-flex">
                <a href="/news2" class="text-decoration-none text-dark flex-fill">
                    <div class="card border-0 shadow-sm rounded flex-fill">
                        <div class="position-relative">
                            <img src="./assets/images/news2.jpg" class="card-img-top rounded-top" alt="News Image 2">
                            <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom">Oct 12, 2024</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Another Exciting Update</h5>
                            <p class="card-text">Catch up on the latest developments and insights that have recently made headlines...</p>
                            <span class="text-primary fw-semibold mt-auto">Read More</span>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- News Card 3 -->
            <div class="col-md-4 mb-4 d-flex">
                <a href="/news3" class="text-decoration-none text-dark flex-fill">
                    <div class="card border-0 shadow-sm rounded flex-fill">
                        <div class="position-relative">
                            <img src="./assets/images/news3.jpg" class="card-img-top rounded-top" alt="News Image 3">
                            <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom">Oct 10, 2024</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Latest Event Recap</h5>
                            <p class="card-text">A quick look at the recent event that brought together people, ideas, and amazing moments...</p>
                            <span class="text-primary fw-semibold mt-auto">Read More</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>










<?php include 'footer.php'; ?>