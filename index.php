<?php
include 'shared/header.php';
?>


<body>
    <?php include 'shared/nav.php' ?>

    

    <div class="mx-[40px]">
        <?php include 'shared/banner.php' ?>
    </div>


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