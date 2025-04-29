<?php include('Nav.php') ?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">FORGOT PASSWORD</p>
            <p>Recover Your Account</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                style="width: 100px; height: 3px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-5 mb-3 mt-5">
            <div class="container bg-white text-center mt-5">
                <form action="" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <label for="" class="float-start">Email</label>
                            <input type="text" class="form-control bg-light" placeholder="Email">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="float-start">New Password</label>
                            <input type="text" class="form-control bg-light" placeholder="New Password">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="float-start">Confirm Password</label>
                            <input type="text" class="form-control bg-light" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4 pb-4">
                        <div class="col-6 text-center">
                            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-primary w-100" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col">
            <img src="../assets/Forgot password-rafiki (1) 1.png" alt="" class="img-fluid">
        </div>
    </div>
</div>


<?php include('Footer.php') ?>