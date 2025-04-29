<?php include('Nav.php') ?>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <p class="text-primary fs-5">CREATE YOUR STARTUP</p>
            <p>Your Journey to Success <br> Starts Here</p>
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
    <form class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">My Company Name</label>
                <input type="text" class="form-control bg-light" placeholder="Name of the company">
            </div>
            <div class="col-md-4 mb-3">
            <label for="" class="float-start">Is developing</label>
            <select class="form-select bg-light">
                    <option selected>Is developing</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">To help</label>
                <input type="text" class="form-control bg-light" placeholder="A defined audience">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">To solve</label>
                <input type="text" class="form-control bg-light" placeholder="Solve a problem">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">With</label>
            <input type="text" class="form-control bg-light" placeholder="Secret sauce">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">We compete in the growing </label>
                <input type="text" class="form-control bg-light" placeholder="Defined market">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">Which last year was a</label>
                <input type="text" class="form-control bg-light" placeholder="Defined value">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">We are similar to competitor 1</label>
                <input type="text" class="form-control bg-light" placeholder="Competitor 1">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">Competitor 2</label>
                <input type="text" class="form-control bg-light" placeholder="Competitor 2">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">But we </label>
                <input type="text" class="form-control bg-light" placeholder="One key differentiator">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">Currently we have</label>
                <input type="text" class="form-control bg-light" placeholder="Current state of product/team">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">We are looking for</label>
                <input type="text" class="form-control bg-light" placeholder="The ask">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">To help us</label>
                <input type="text" class="form-control bg-light" placeholder="What you would do with the ask">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="float-start">In exchange of</label>
                <input type="text" class="form-control bg-light" placeholder="Amount of equity offering">
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-6 text-center">
                <button class="btn btn-primary w-100" type="submit">Pitch My Idea </button>
            </div>
        </div>
    </form>

</div>
<?php include('Footer.php') ?>