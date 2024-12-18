<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container-fluid">
        <a class="navbar-brand me-auto text-primary" href="/"><?php echo $_SESSION["lname"] . ","; ?></a>
        <div id="search-container fixed-top" class="dropdown">
            <input type="hidden" id="user_id" value="<?php echo $_SESSION['id'] ?>">
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
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page"
                                href="/seeker">&nbsp;Home</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker">Home</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/network") {
                        ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page"
                                href="/seeker/network">&nbsp;Network</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/network">Network</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/job") {
                        ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page"
                                href="/seeker/job">&nbsp;Job</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/job">Job</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/chat") {
                        ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page"
                                href="/seeker/chat">&nbsp;Chat</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item  me-2 ms-2">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/chat">Chat</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($path->getPath() == "/seeker/profile") {
                        ?>
                        <li class="nav-item me-2 ms-2">
                            <a class="nav-link text-primary text-center fw-bold" aria-current="page"
                                href="/seeker/profile">&nbsp;Profile</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item  me-2 ms-2">
                            <a class="nav-link text-primary" aria-current="page" href="/seeker/profile">Profile</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="dropdown col-md-3">
            <input type="hidden" id="nuser_id" value="<?php echo $_SESSION['id']; ?>">
            <button type="button" id="notification-btn" data-bs-toggle="dropdown" class="btn btn-primary rounded-5 position-relative me-3 ms-2">
                <i class="fa fa-bell"></i>
            </button>
            <div id="notification-view" class="dropdown-menu w-100 mt-2 pt-3 ps-2 pe-2">
            </div>
        </div>
        <a href="/logout" class="btn btn-secondary">Logout&nbsp;<i class="fa fa-sign-out"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        $('#search-global').on('input', function () {
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
                    success: function (response) {
                        const regex = /\[(.*?)\]/g;
                        const matches = response.matchAll(regex);
                        for (const match of matches) {
                            $.each(match[1].split('<@>'), function (idx, user) {
                                const user_view = $(`
                                    <div class="d-flex justify-content-start w-100 pt-2 pe-3 ps-3 hover">
                                    </div>
                                `);
                                if (user) {
                                    const user_info = [];
                                    $.each(user.split('<#>'), function (cell, data) {
                                        if (data) {
                                            user_info.push(data);
                                        }
                                    });
                                    if ($('#user-id').val() != user_info[0]) {
                                        user_view.append($(`<img src="/assets/images/user/${user_info[10]}" class="rounded-circle p-0 m-0" width="30" height="30">`));
                                        user_view.append($(`<p class="fs-6 ps-3"><a href="/search/result?id=${user_info[0]}" class="text-decoration-none text-black">${user_info[1]} ${user_info[2]}</a></p>`));
                                        $('#fields').append(user_view);
                                    }
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        2
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
        $('#notification-btn').click(function() {
            const id = $('#nuser_id').val();
            const formData = new FormData();
            formData.append('user_id', id);
            $.ajax({
                url:'/user/follow/request',
                data:formData,
                type:'post',
                contentType:false,
                processData:false,
                success:function(response) {
                    $('#notification-view').empty();
                    const regex = /\[(.*?)\]/g;
                    const matches = response.matchAll(regex);
                    for (const match of matches) {
                        const notifications = [];
                        $.each(match[1].split('<@>'), function(idx, value) {
                            if (value != '') {
                                notifications.push(value);
                            }
                        });
                        $.each(notifications, function(idx, value) {
                            $.each(value.split('<#>'), function(itm, data) {
                                if (data) {
                                    const data_info = [];
                                    const followRequestView = $(`
                                        <div class="row g-2 mb-3">
                                            <input type="hidden" id="evt_data">
                                            <input type="hidden" id="evt_type">
                                            <input type="hidden" id="nid">
                                            <div class="col-12 col-md-2" id="profile-pic">
                                            </div>
                                            <div class="col-12 col-md-6" id="profile-name">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-primary rounded-5 me-3" id="accept">
                                                        <i class="fa fa-plus"></i></button>
                                                    <button class="btn btn-outline-danger rounded-5" id="ignore">
                                                        <i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                    $.each(data.split('<>'), function(i, v){
                                        if (v) {
                                            data_info.push(v);
                                        }
                                    });
                                    followRequestView.find('#evt_data').val(`${data_info[3]}`);
                                    followRequestView.find('#evt_type').val(`${data_info[4]}`);
                                    followRequestView.find('#nid').val(`${data_info[5]}`);
                                    followRequestView.find('#profile-pic').append(
                                        $(`<img src="/assets/images/user/${data_info[2]}" width="35" height="35" class="rounded-circle" alt="user_image">`)
                                    );
                                    followRequestView.find('#profile-name').append(
                                        $(`<p class="fw-bold mt-1 ms-2">${data_info[1]}</p>`)
                                    );
                                    followRequestView.find('#accept').click(function() {
                                        const evt_data = followRequestView.find('#evt_data').val();
                                        const evt_type = followRequestView.find('#evt_type').val();
                                        const nid = followRequestView.find('#nid').val();
                                        const formData = new FormData();
                                        formData.append('evt_data', evt_data);
                                        formData.append('evt_type', evt_type);
                                        formData.append('nid', nid);
                                        $.ajax({
                                            url:'/user/follow/add',
                                            data:formData,
                                            type:'post',
                                            contentType:false,
                                            processData:false,
                                            success:function(response) {
                                                followRequestView.remove();
                                            },
                                            error:function(xhr, status, error) {
                                                console.log("ERROR: " + error);
                                            }
                                        });
                                    });
                                    followRequestView.find('#ignore').click(function() {
                                        const evt_data = followRequestView.find('#evt_data').val();
                                        const evt_type = followRequestView.find('#evt_type').val();
                                        const nid = followRequestView.find('#nid').val();
                                        const formData = new FormData();
                                        formData.append('evt_data', evt_data);
                                        formData.append('evt_type', evt_type);
                                        formData.append('nid', nid);
                                        $.ajax({
                                            url:'/user/follow/ignore',
                                            data:formData,
                                            type:'post',
                                            contentType:false,
                                            processData:false,
                                            success:function(response) {
                                                followRequestView.remove();
                                            },
                                            error:function(xhr, status, error) {
                                                console.log("ERROR: " + error);
                                            }
                                        });
                                    });
                                    if (data_info[0] == 'follow') {
                                        $('#notification-view').append(followRequestView);
                                    }
                                }
                            });
                        });
                    }
                },
                error:function(xhr, status, error) {
                    console.log('ERROR: ' + error);
                }
            });
        });
        const checkNotification = async () => {
            const formData = new FormData();
            const id = $('#user_id').val();
            formData.append('user_id', id);
            $.ajax({
                url:'/user/notification',
                data:formData,
                type: 'post',
                contentType: false,
                processData: false,
                success:function(response) {
                    const regex = /\[(.*?)\]/g;
                    const matches = response.matchAll(regex);
                    for (const match of matches) {
                        const json_data = JSON.parse(match[1]);
                        const notifications = json_data['notification']['count'];
                        $('#notification-btn').find('span').remove();
                        const notification_view = $(`
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            </span>
                        `);
                        if (notifications > 0) {
                            notification_view.text(notifications);
                            $('#notification-btn').append(notification_view);
                        } 
                    }
                },
                error:function(xhr, status, error) {
                    console.log("ERROR: " + error);
                }
            });
        };
        setInterval(checkNotification, 1000);
    });
</script>