<nav class="navbar navbar-expand-lg fixed-top bg-white">
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
                        if ($path->getPath() == "/seeker") {
                    ?>
                        <li class="nav-item  rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/seeker"><i class="fa fa-home"></i>&nbsp;Home</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker">Home</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/seeker/network") {
                    ?>
                        <li class="nav-item  rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/seeker/network"><i class="fa fa-globe"></i>&nbsp;Network</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/network">Network</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/seeker/job") {
                    ?>
                        <li class="nav-item  rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/seeker/job"><i class="fa fa-briefcase"></i>&nbsp;Job</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/job">Job</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/seeker/chat") {
                    ?>
                        <li class="nav-item  rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/seeker/chat"><i class="fa fa-comments"></i>&nbsp;Chat</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/chat">Chat</a>
                        </li>
                    <?php } ?>
                    <?php
                        if ($path->getPath() == "/seeker/profile") {
                    ?>
                        <li class="nav-item  rounded col-md-1">
                            <a class="nav-link text-primary text-center" aria-current="page" href="/seeker/profile"><i class="fa fa-user"></i>&nbsp;Profile</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/profile">Profile</a>
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