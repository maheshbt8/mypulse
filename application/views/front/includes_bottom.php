<!-- js-->
    <script src="<?=base_url('assets/front/')?>js/jquery-2.2.3.min.js"></script>
<!-- js-->
<!-- Banner Responsiveslides -->
    <script src="<?=base_url('assets/front/')?>js/responsiveslides.min.js"></script>
    <script>
        // You can also use "$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $("#slider3").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
<!-- // Banner Responsiveslides -->
<!-- stats -->
    <script src="<?=base_url('assets/front/')?>js/jquery.waypoints.min.js"></script>
    <script src="<?=base_url('assets/front/')?>js/jquery.countup.js"></script>
        <script>
            $('.counter').countUp();
        </script>
<!-- //stats -->
<!--pop-up-box -->
    <script src="<?=base_url('assets/front/')?>js/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
        });
    </script>
    <!-- //pop-up-box -->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/front/')?>js/bootstrap.min.js ">
    </script>
    <!-- //Bootstrap Core JavaScript -->


