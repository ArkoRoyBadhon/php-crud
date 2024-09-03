<?php
include 'shared/header.php';
?>


<body>
    <?php include 'shared/nav.php' ?>

    <div class="mx-[40px]">
        <?php include 'shared/banner.php' ?>
    </div>

    <?php

    if (isset($_SESSION['user'])) {

        echo '<br>';
        echo $_SESSION["user"]["username"];
        echo '<br>';
        echo $_SESSION["user"]["email"];
        echo '<br>';
        if ($_SESSION["user"]["role"] == "user") {
            echo "done";
        }
    }


    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });
        });
    </script>
</body>

</html>