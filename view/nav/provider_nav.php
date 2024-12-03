<nav class="navbar navbar-expand-lg fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-primary" href="/"><?php echo $_SESSION["lname"] . ","; ?></a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SLJP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php
                        if ($path->getPath() == "/provider") {
                    ?>
                        <li class="nav-item  rounded col-md-1 text-center">
                            <a class="nav-link text-primary" aria-current="page" href="/provider"><i class="fa fa-home"></i>&nbsp;Home</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/provider">Home</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/provider/network") {
                    ?>
                        <li class="nav-item  rounded col-md-1 text-center">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/network"><i class="fa fa-globe"></i>&nbsp;Network</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/network">Network</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/provider/job") {
                    ?>
                        <li class="nav-item  rounded col-md-1 text-center">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/job"><i class="fa fa-briefcase"></i>&nbsp;Job</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/job">Job</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/provider/chat") {
                    ?>
                        <li class="nav-item  rounded col-md-1 text-center">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/chat"><i class="fa fa-comment"></i>&nbsp;Chat</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/chat">Chat</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/provider/profile") {
                    ?>
                        <li class="nav-item  rounded col-md-1 text-center">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/profile"><i class="fa fa-user"></i>&nbsp;Profile</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/provider/profile">Profile</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <a href="/logout" class="btn btn-secondary">Logout&nbsp;<i class="fa fa-sign-out"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>