<?php include("Nav.php"); ?>
<style>
    .inp {
        background-color: #EEF9FF;
    }
</style>

<body>
    <div class="container text-center col-3 mt-3">
        <div class="row ">
            <div class="col">
                <p class="fs-5 fw-semibold text-primary">FORGOT PASSWORD</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="fw-bolder">Recover Your Account</p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                    style="width: 40px; height: 3px;">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    <form>
        <div class="container text-center mt-5">
            <div class="row">
                <div class="col">
                    <img src="../assets/Rectangle 11.png" alt="" class="img-fluid">
                </div>
                <div class="col-sm-6 mt-5">
                    <form method="post">
                        <div class="row ">
                            <div class="col-md-16 mb-5">
                                <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email
                                    style=" height: 55px;">
                            </div>
                            <div class="col-md-12 mb-5">
                                <input type="text" class="form-control border-0 bg-light px-4"
                                    placeholder="New Password" style="height: 55px;">
                            </div>
                            <div class="col-md-12 mb-5">
                                <input type="text" class="form-control border-0 bg-light px-4"
                                    placeholder="Confirm Password" style="height: 55px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-primary w-100 py-3" type="submit">Reset Password</button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-primary w-100 py-3" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </form>
</body>
<?php include("Footer.php"); ?>