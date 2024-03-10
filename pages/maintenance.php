<?php include 'header.php' ?>

<body class="dark-mode" style="height: auto;">
<div class="container mt-5" style="text-align:center">
<div class="row">
<div class="col" id="lottie-animation"></div>
</div>

    <div class="col-12">
    <h3> We Are Under Maintenance</h3>
    <p> Please Wait A Moment</p>
    <p id="hlogin">...</p>
    </div>
    </div>

    <script>
        const animationPath = '../assets/lottie/mt.json';

        // Set up Lottie animation
        const animationContainer = document.getElementById('lottie-animation');
        const animation = lottie.loadAnimation({
            container: animationContainer,
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: animationPath
        });
    </script>

    <?php include 'footer.php'; ?>