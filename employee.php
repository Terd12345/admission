<?php include 'header.php'; ?>


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


<section class=" section-padding" id="admin" data-aos="fade-down">
        <h1>Meet Our Admins</h1>

        <section class="trustees">
    <div class="trustee-profile left">
        <img src="./assets/images/elowilyn_rosas.png" alt="Profile Picture of Rodel R. Manzo">
        <div class="text-content">
            <h2>Elowilyn F. Rosas</h2>
            <p class="role">Information Technology</p>
        </div>
    </div>

    <div class="trustee-profile right">
    <img src="./assets/images/ezra_arguelles.png" alt="Profile Picture of Rodel R. Manzo">
        <div class="text-content">
            <h2>Ezrah E. Arguelles</h2>
            <p class="role">Humanitarian Chaplain</p>
        </div>
    </div>

    <div class="trustee-profile left">
    <img src="./assets/images/noimi_bayong.png" alt="Profile Picture of Rodel R. Manzo">
        <div class="text-content">
            <h2>Noime B. Bayong</h2>
            <p class="role">Logistic</p><br>
        </div>
    </div>


</section>
    </section>



    <section class=" section-padding" id="faculty" data-aos="fade-down">
    <h1 class="section-title">Meet Our Faculty</h1>

    <div class="trustees">
        <div class="trustee-profile">
            <img src="./assets/images/abner.png" alt="Profile Picture of Rodel R. Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Abner P. Tuballes</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/lorenzo.png" alt="Profile Picture of Bobby M. Brimon" class="profile-pic">
            <div class="text-content">
                <h2>Lorenzo Paul B. De Leon</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/yolly.png" alt="Profile Picture of Lelanie D. Perido" class="profile-pic">
            <div class="text-content">
                <h2>Yolly F. Fampulme</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/eric.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Eric R. Lazarte</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/ronald.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Ronald P. Manalo</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/miller.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Miller B. Tadeo</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/rizal.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Rizal Mendoza Vidallo Ced. D.</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/danilo.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Danilo S. Rosario Jr.</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/pascual.png" alt="Profile Picture of Michelle Joy Manzo" class="profile-pic">
            <div class="text-content">
                <h2>Janet C. Pascual</h2>
                <p class="role"></p>
            </div>
        </div>

        <div class="trustee-profile">
            <img src="./assets/images/bacani.png" alt="Profile Picture of Cemee Faith M. Escarilla" class="profile-pic">
            <div class="text-content">
                <h2>MA. Luz P. Bacani-Dasmarinas, Ed.D Ph.D ., DBA</h2>
                <p class="role"></p>
            </div>
        </div>
    </div>

</section>


    <section class="board-of-trustees section-padding" id="board" data-aos="fade-down">
        <h1>Meet Our Board of Trustees</h1>

        <section class="trustees">
    <div class="trustee-profile left">
        <img src="./assets/images/rodel_manzo.png" alt="Profile Picture of Rodel R. Manzo">
        <div class="text-content">
            <h2>Rodel R. Manzo D.Min, Ed.D</h2>
            <p class="role">President</p>
        </div>
    </div>

    <div class="trustee-profile right">
        <div class="text-content">
            <h2>Bobby M. Brimon D.Min, Ced.D</h2>
            <p class="role">Vice-President</p>
        </div>
    </div>

    <div class="trustee-profile left">
        <div class="text-content">
            <h2>Lelanie D. Perido Ced.D Ed.D</h2>
            <p class="role">Secretary</p>
        </div>
    </div>

    <div class="trustee-profile right">
        <div class="text-content">
            <h2>Michelle Joy Manzo</h2>
            <p class="role">Treasurer</p>
        </div>
    </div>

    <div class="trustee-profile left">
        <div class="text-content">
            <h2>Cemee Faith M. Escarilla, M.R.E</h2>
            <p class="role">Board</p>
        </div>
    </div>

   </section>
    </section>





    <?php include 'footer.php'; ?>