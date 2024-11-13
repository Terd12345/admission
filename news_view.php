<?php

include "header.php";

?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">






    <html>
 <head>
  <title>
   News Article
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .main-content {
            background-color: white;
            padding: 20px;
            max-width: 800px;
            margin-right: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-content h1 {
            font-size: 28px;
            color: #333;
        }
        .main-content .author {
            font-size: 14px;
            color: #fff;
            background-color: #d32f2f;
            padding: 5px 10px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .main-content .date {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .main-content .social-buttons {
            margin-bottom: 20px;
        }
        .main-content .social-buttons button {
            background-color: #3b5998;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-right: 5px;
            cursor: pointer;
        }
        .main-content .social-buttons button.twitter {
            background-color: #1da1f2;
        }
        .main-content .social-buttons button.pinterest {
            background-color: #bd081c;
        }
        .main-content .social-buttons button.email {
            background-color: #666;
        }
        .main-content .social-buttons button.share {
            background-color: #4caf50;
        }
        .main-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .sidebar {
            max-width: 300px;
        }
        .sidebar .popular-news {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar .popular-news h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .sidebar .popular-news .news-item {
            display: flex;
            margin-bottom: 20px;
        }
        .sidebar .popular-news .news-item img {
            max-width: 80px;
            height: auto;
            margin-right: 10px;
        }
        .sidebar .popular-news .news-item .news-info {
            max-width: 200px;
        }
        .sidebar .popular-news .news-item .news-info h3 {
            font-size: 14px;
            color: #333;
            margin: 0;
        }
        .sidebar .popular-news .news-item .news-info .date {
            font-size: 12px;
            color: #666;
        }
        .sidebar .popular-news .news-item .news-info .tag {
            font-size: 12px;
            color: #fff;
            background-color: #d32f2f;
            padding: 2px 5px;
            display: inline-block;
            margin-top: 5px;
        }
  </style>
 </head>
 <body>

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

  <div class="container">
   <div class="main-content">
    <div class="author">
     <!-- BY: LEAN KARLO S. TOLENTINO, PECE, PH.D. -->
    </div>
    <div class="date">
     Posted July 29, 2024
    </div>
    <h1>
     Team TINIG Triumphs at SUC Fair 2024 INNOVAR Student Category
    </h1>
    <div class="social-buttons">
     
    </div>
    <img alt="Team TINIG at SUC Fair 2024 holding their awards" height="400" src="https://storage.googleapis.com/a1aa/image/5tr1BXrPOY6kOJWUnFo9Xtjt3COCnk29KArCYZINKDlXWG7E.jpg" width="800"/>
    <p>for description</p>   
</div>
   <div class="sidebar">
    <div class="popular-news">
     <h2>
      Popular News
     </h2>
     <div class="news-item">
      <a href="news_view.php?id=1" class="text-decoration-none">
                <img alt="Architecture Licensure Board Passer" height="80" src="https://storage.googleapis.com/a1aa/image/eB1Fyh1pp4zmFa4WXoX7TQLDK1QEbo7eiR7sgOdtfgoTzyYnA.jpg" width="80"/>
                <div class="news-info">
                    <h3>Architecture Licensure Board Passer</h3>
                    <div class="tag">TUP MANILA</div>
                    <div class="date">February 02, 2023</div>
                </div>
            </a>
     </div>
     <div class="news-item">
      <img alt="Maximizing Academic Excellence: A Collaborative Workshop with Department Heads, Directors, Heads, and Deans" height="80" src="https://storage.googleapis.com/a1aa/image/mzQbWepxfWhiuk3DY1FLVFXyae8GUVWcs6R9T9idU8ZjzyYnA.jpg" width="80"/>
      <div class="news-info">
       <h3>
        Maximizing Academic Excellence: A Collaborative Workshop with Department Heads, Directors, Heads, and Deans
       </h3>
       <div class="tag">
        TUPOVAA FB PAGE
       </div>
       <div class="date">
        April 11, 2023
        <hr>
       </div>
      </div>
     </div>
     <div class="news-item">
      <img alt="PASUC President Says CHED To Review NBC 461 Guidelines" height="80" src="https://storage.googleapis.com/a1aa/image/FZreLoVxfoqWIU3RWvNSpvlf0E69TqGb6InA3y04dGnKzyYnA.jpg" width="80"/>
      <div class="news-info">
       <h3>
        PASUC President Says CHED To Review NBC 461 Guidelines
       </h3>
       <div class="tag">
        PROF. RENATO BUTCH R. BITUONAN
       </div>
       <div class="date">
        January 15, 2019
       </div>
       <hr>
      </div>
     </div>
     <div class="news-item">
      <img alt="Career Placement and Migration Services Seminar" height="80" src="https://storage.googleapis.com/a1aa/image/LW6cDWcOenS4c6or8hEM9QRX3WNtL3FvWktuggXOQ2h2sM2JA.jpg" width="80"/>
      <div class="news-info">
       <h3>
        Career Placement and Migration Services Seminar
       </h3>
       <div class="tag">
        ENRICO S. LUCENA, RGC
       </div>
       <div class="date">
        April 14, 2023
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>








    <?php include 'footer.php'; ?>