<nav class="navbar navbar-expand-lg fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-primary" href="/"><?php echo $_SESSION["lname"] . ","; ?></a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SLJP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1">
                    <?php
                        if ($path->getPath() == "/admin") {
                    ?>
                        <li class="nav-item  rounded col-md-2">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/admin">
                                <i class="fa fa-tachometer"></i>&nbsp;Dashboard</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/admin">Dashboard</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <a href="/logout" class="btn btn-secondary">Logout</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>