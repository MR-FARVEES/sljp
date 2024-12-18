<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-primary" href="/"><?php echo $_SESSION["lname"] . ","; ?></a>
        <div id="search-container fixed-top" class="dropdown">
            <input type="hidden" id="user-id" value="<?php echo $_SESSION['id'] ?>">
            <input type="text" class="form-control ms-5" id="search-global" data-bs-toggle="dropdown"
                aria-expanded="false" placeholder="Search" required>
            <div id="fields" class="dropdown-menu ms-5 mt-2" style="width: 350px;" aria-labelledby="edu-field">

            </div>
        </div>
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
                        <li class="nav-item rounded col-md-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page" href="/seeker">&nbsp;Home</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker">Home</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/network") {
                        ?>
                        <li class="nav-item rounded col-md-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page" href="/seeker/network">&nbsp;Network</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/network">Network</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/job") {
                        ?>
                        <li class="nav-item rounded col-md-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page" href="/seeker/job">&nbsp;Job</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/job">Job</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/chat") {
                        ?>
                        <li class="nav-item rounded col-md-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page" href="/seeker/chat">&nbsp;Chat</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/chat">Chat</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/profile") {
                        ?>
                        <li class="nav-item rounded col-md-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page" href="/seeker/profile">&nbsp;Profile</a>
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
<script>
    $(document).ready(function () {
        $('#search-global').css({
            'width': '250px',
            'transition': 'width 0.5s ease',
        });
        $('#search-global').focus(function () {
            $('#search-global').css({
                'width': '350px',
                'transition': 'width 0.5s ease',
            });
            if ($(this).val() == '') {
                $('#fields').empty();
                $('#fields').append($(`
                    <div class="ms-3">
                        <h6 class="text-muted">Recent</h6>
                    </div>
                `));
            }
        });
        $('#search-global').blur(function () {
            $('#search-global').css({
                'width': '250px',
                'transition': 'width 0.5s ease',
            });
        });
        $('#search-global').on('input', function() {
            const query = $(this).val();
            if (query) {
                $('#fields').empty();
                const formData = new FormData();
                formData.append('query', query);
                $.ajax({
                    url: '/search/global',
                    data: formData,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        const regex = /\[(.*?)\]/g;
                        const matches = response.matchAll(regex);
                        for (const match of matches) {
                            $.each(match[1].split('<@>'), function(idx, user) {
                                const user_view = $(`
                                    <div class="d-flex justify-content-start w-100 pt-2 pe-3 ps-3 hover">
                                    </div>
                                `);
                                if (user) {
                                    const user_info = [];
                                    $.each(user.split('<#>'), function(cell, data) {
                                        if (data) {
                                            user_info.push(data);
                                        }
                                    });
                                    if ($('#user-id').val() != user_info[0]) {   
                                        user_view.append($(`<img src="/assets/images/user/${user_info[10]}" class="rounded-circle p-0 m-0" width="30" height="30">`));
                                        user_view.append($(`<p class="fs-6 ps-3"><a href="/seeker/profile?id=${user_info[0]}" class="text-decoration-none text-black">${user_info[1]} ${user_info[2]}</a></p>`));
                                        $('#fields').append(user_view);  
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {2
                        console.log("ERROR: " + error);
                    }
                });
            } else {
                $('#fields').empty();
                const recent = $(`
                    <div class="ms-3">
                        <h6 class="text-muted">Recent</h6>
                    </div>
                `);
                $('#fields').append(recent);
            }
        });
    });
</script>