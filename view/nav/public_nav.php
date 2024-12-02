<nav class="navbar navbar-expand-lg fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-primary" href="/">SLJP</a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SLJP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php
                        if ($path->getPath() == "/") {
                    ?>
                        <li class="nav-item border border-primary rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/"><i class="fa fa-home"></i>&nbsp;Home</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/">Home</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/about") {
                    ?>
                        <li class="nav-item border border-primary rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/about"><i class="fa fa-users"></i>&nbsp;About</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/about">About</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/contact") {
                    ?>
                        <li class="nav-item border border-primary rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/contact"><i class="fa fa-phone"></i>&nbsp;Contact</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/contact">Contact</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <a href="/login" class="btn btn-primary">Login&nbsp;<i class="fa fa-sign-in"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>