<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row w-auto">
        <!-- Left Side -->
        <div class="col-md-6 text-center text-md-start mb-4">
            <h1 class="fw-bold text-primary" style="font-size: 3rem;">Sri Lankan Job Portal</h1>
            <p class="fs-5">SLJP helps you find jobs with the companies & government.</p>
        </div>
        <!-- Right Side -->
        <div class="col-md-6">
            <div class="bg-white p-4 rounded shadow-lg ">
                <form action="/login" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Email address or phone number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Log in</button>
                    <div class="text-center mb-3">
                        <a href="#" class="text-decoration-none">Forgotten password?</a>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="/register" class="btn btn-success">Create new account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>