<?php include('Entrepreneur_nav.php') ?>
<style>
    .img {
        opacity: 0.4;
    }

    .box1 {
        height: 100px;
        width: 300px;
        background-color: #06A3DA;
    }

    .box2 {
        height: 100px;
        width: 350px;
        background-color: #EEF9FF;
    }
</style>
<div class="continer">
    <img src="../assets/unsplash_46bom4lObsA.png" alt="" class="img-fluid img">
</div>
<div class="container my-5">
    <div class="row align-items-center">
        <!-- Left Side: Content -->
        <div class="col-lg-6">
            <!-- Top Cards Row -->
            <div class="row g-3">
                <!-- Box 1 -->
                <div class="col-md-6">
                    <div class="box1 shadow-lg rounded-3 p-3 bg-dark text-light">
                        <div class="d-flex align-items-center gap-3">
                            <img src="../assets/Group 206.png" alt="Image" class="img-fluid" style="height: 50px;">
                            <div>
                                <h2 class="mb-0 text-light">Top Mentors</h2>
                                <h4 class="text-light">12345</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="col-md-6">
                    <div class="box2 shadow-lg rounded-3 p-3 bg-light">
                        <div class="d-flex align-items-center gap-3">
                            <img src="../assets/Group 206.png" alt="Image" class="img-fluid" style="max-width: 100px;">
                            <div>
                                <h2 class="text-primary mb-0">Top Investors</h2>
                                <h4 class="text-primary">12345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Row -->
            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <img src="../assets/fa6-solid_share.png" alt="Image" class="img-fluid" style="max-width: 50px;">
                        <h5 class="mb-0">Reply within 24 hours</h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <img src="../assets/fa6-solid_share.png" alt="Image" class="img-fluid" style="max-width: 50px;">
                        <h5 class="mb-0">24 hrs telephone support</h5>
                    </div>
                </div>
            </div>

            <!-- Paragraph -->
            <p class="lh-base fw-medium mt-4" style="text-align: justify;">
                Entrepreneur is your ultimate resource for everything related to starting, growing,
                and managing your business. Whether you are a seasoned entrepreneur or just
                beginning your journey, our platform offers a wealth of information, tools,
                and inspiration to help you succeed.
            </p>

            <!-- Contact Info -->
            <div class="d-flex align-items-center gap-3 mt-4">
                <img src="../assets/Group 205.png" alt="Image" class="img-fluid" style="max-width: 100px;">
                <div class="ps-3">
                    <h4 class="mb-1">Call to ask any question</h4>
                    <h6 class="text-primary">+012 345 6789</h6>
                </div>
            </div>
        </div>

        <!-- Right Side: Image -->
        <div class="col-lg-6 mt-5 mt-lg-0 text-center">
            <img src="../assets/unsplash_gMsnXqILjp4.png" alt="" class="img-fluid rounded-3 w-100">
        </div>
    </div>
</div>

<?php include('Footer.php') ?>