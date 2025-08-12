<?php
include_once "db.php";
include("header.php");
$services = mysqli_query($conn, "select * from service ORDER BY id DESC LIMIT 4");


?>

<section id="home-section" class="hero">
    <img src="images/blob-shape-3.svg" class="svg-blob" alt="Colorlib Free Template">
    <div class="home-slider owl-carousel">
        <div class="slider-item">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <div class="one-third order-md-last">
                        <div class="img" style="background-image:url(images/bg_1.jpg);">
                            <div class="overlay"></div>
                        </div>
                        <div class="bg-primary">
                            <div class="vr"><span class="pl-3 py-4"
                                    style="background-image: url(images/bg_1-1.jpg);">Greece</span></div>
                        </div>
                    </div>
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading pl-5">Discover Greece</span>
                            <h1 class="mb-4 mt-3">Explore Your Travel Destinations like never before</h1>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia. It is a paradisematic country.</p>

                            <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Discover <span
                                        class="ion-ios-arrow-forward"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <div class="one-third order-md-last">
                        <div class="img" style="background-image:url(images/bg_2.jpg);">
                            <div class="overlay"></div>
                        </div>
                        <div class="vr"><span class="pl-3 py-4"
                                style="background-image: url(images/bg_2-2.jpg);">Africa</span></div>
                    </div>
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading pl-5">Discover Africa</span>
                            <h1 class="mb-4 mt-3">Never Stop Exploring</span></h1>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia. It is a paradisematic country.</p>

                            <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Discover <span
                                        class="ion-ios-arrow-forward"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-services-2" id="services-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Unique &amp; Healthy</span>
                <h2 class="mb-4">Our Services</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($services)) { ?>
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services text-center d-block">
                        <div class="icon justify-content-center align-items-center d-flex"><span
                                class="<?php echo $row['icon']; ?>"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3"><?php echo $row['title']; ?></h3>
                            <p><?php echo $row['content']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>