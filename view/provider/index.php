<?php
$post_to = isset($_POST["post_to"]) ? $_POST['post_to'] : 'anyone';
$comment = "";
?>
<div class="container-fluid mt-5 bg-light">
    <div class="p-5">
        <div class="row g-4">
            <div class="col-12 col-md-3">
                <div class="card align-self-start shadow-sm mb-3">
                    <img class="card-img-top" height="100" src="assets/images/cover/<?php echo $_SESSION['cover']; ?>"
                        alt="Title" />
                    <div
                        style="margin-left:20px;margin-top:-60px;border-radius:60px;width: 120px;height: 120px;background:#fff;padding:4px;">
                        <img style="border-radius:55px;" width="112" height="112"
                            src="/assets/images/user/<?php echo $_SESSION['profile']; ?>" alt="Title" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']); ?>&nbsp;<i
                                class="fa fa-shield text-secondary"></i>
                        </h5>
                        <?php
                        $headline = "";
                        $users = $this->userModel->getUserInfo($_SESSION['id']);
                        while ($user = $users->fetch_assoc()) {
                            $educations = $this->educationModel->getEducation($user['id']);
                            $uni_info = null;
                            $headline = $user['headline'];
                            while ($education = $educations->fetch_assoc()) {
                                $universities = $this->universityModel->getUniversity($education['institude']);
                                while ($university = $universities->fetch_assoc()) {
                                    $uni_info = $university;
                                }
                            }
                            if ($user['headline'] != 'N/A') {
                                ?>
                                <p><?php echo $user['headline']; ?></p>
                                <div class="d-flex">
                                    <img src="/assets/images/university/<?php echo $uni_info['logo']; ?>" width="30" height="30"
                                        class="rounded-circle">
                                    <p class="p-1"><?php echo $uni_info['name']; ?></p>
                                </div>
                                <?php
                            } else {
                                ?>
                                <a href="/seeker/profile" class="text-decoration-none">
                                    <small class="text-muted">Edit Profile&nbsp;&nbsp;
                                        <i class="fa fa-pen"></i></small></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="card shadow-sm align-self-start">
                    <div class="card-body">
                        <a href="/seeker/network" class="text-decoration-none">
                            <p class="card-text"><i class="fa fa-users"></i>&nbsp;&nbsp;Network</p>
                        </a>
                        <a href="/seeker/profile" class="text-decoration-none">
                            <p class="card-text"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Profile</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card align-self-start shadow-sm mb-3">
                    <div class="d-flex justify-content-center">
                        <img class="card-img-top w-75" height="200" src="assets/images/web/info.jpg" alt="Title" />
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Hi <?php echo $_SESSION['fname']; ?>, are you looking
                            for
                            a hiring people right now?<br><small class="fs-6 fw-light text-secondary">your response is
                                only
                                visible to you.</small></smal>
                        </h4>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <button
                                    class="w-100 border-m border-primary text-primary bg-white rounded-5 p-1">Yes</button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="w-100 border-m border-primary text-primary bg-white rounded-5 p-1">No,
                                    but I'm open</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card align-self-start shadow-sm mb-3">
                    <div class="card-body d-flex">
                        <img style="border-radius:25px;" width="50" height="50"
                            src="assets/images/user/<?php echo $_SESSION['profile']; ?>" alt="Title" />
                        <input class="form-control ms-5 rounded-5" type="text" value="Create a post with your content"
                            data-bs-toggle="modal" data-bs-target="#newPost" readonly>
                    </div>

                    <div class="d-flex ms-5">
                        <p class="card-text col-md-4 me-1 text-center"><i
                                class="fa fa-image text-primary"></i>&nbsp;&nbsp;Media</p>
                        <p class="card-text col-md-4 me-1 text-center"><i
                                class="fa fa-calendar text-warning"></i>&nbsp;&nbsp;Event</p>
                        <p class="card-text col-md-4 text-center"><i
                                class="fa fa-newspaper text-danger"></i>&nbsp;&nbsp;Write
                            Article</p>
                    </div>
                </div>
                <!-- all posts comes here! -->
                <div id="all-posts">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card align-self-start shadow-sm">
                    <div class="card-body p-0">
                        <div class="d-flex w-100 justify-content-between p-3">
                            <h6>Add to your feed</h6>
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <?php
                        $heads = explode("|", $headline);
                        $users = $this->userModel->getUsersByHeadlineMatching(array_map('trim', $heads));
                        while ($user = $users->fetch_assoc()) {
                            if ($user['id'] != $_SESSION['id'] && !$this->followerModel->isFollower($_SESSION['id'], $user['id'])) {
                                ?>
                                <div class="d-flex p-3">
                                    <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="50" height="50"
                                        class="rounded-circle" alt="">
                                    <div class="ms-2 pt-1">
                                        <strong>
                                            <?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                                        </strong><br>
                                        <small
                                            class="text-muted"><?php if ($user['headline'] != 'N/A') {
                                                echo $user['headline'];
                                            } else {
                                                echo "No headlines";
                                            } ?></small><br>
                                        <a class="btn btn-outline-secondary rounded-5 mt-2"
                                            href="/search/result?id=<?php echo $user['id']; ?>">View full profile</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade col-md-12" id="newPost">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex hover-secondary" data-bs-toggle="modal" data-bs-target="#postSettings">
                    <div class="me-3">
                        <img src="assets/images/user/<?php echo $_SESSION['profile']; ?>" width="60" height="60"
                            class="m-3" style="border-radius: 30px;" alt="">
                    </div>
                    <div class="mt-3">
                        <h1 class="modal-title fs-5">
                            <?php echo ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']); ?>&nbsp;&nbsp;<i
                                class="fa fa-caret-down text-secon"></i>
                        </h1>
                        <p class="fs-6">Post to <span id="post_to"></span></p>
                    </div>
                </div>
                <button style="margin-top:-70px;" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_index" value="<?php echo $_SESSION['id']; ?>">
                <div class="overflow-auto" style="max-height:50vh;">
                    <textarea id="scrollableTextarea" class="form-control fs-5 border-0 mb-3"
                        placeholder="What do you want to talk about?" rows="8"></textarea>
                    <img id="post-image" src="" class="w-100 rounded-1" style="display: none;" alt="">
                </div>
                <div class="d-flex">
                    <i class="m-4 fa fa-image fs-4 text-primary" id="image"></i>
                    <input type="file" id="fileInput" style="display:none;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="post_submit" class="btn btn-primary rounded-5">Post</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="postSettings">
    <div class="modal-dialog modal-dialog-centered modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Post Settings</h1>
                <button class="btn-close" data-bs-toggle="modal" data-bs-target="#newPost"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="">
                <p class="modal-text fs-4 ms-3 mt-4">Who can see your post?</p>
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="any"><i class="fa fa-globe icon-cover"></i>&nbsp;&nbsp;Anyone</label>
                    <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="any"
                        id="anyone" name="post_to" value="anyone">
                </div>
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="conn"><i class="fa fa-users icon-cover"></i>&nbsp;&nbsp;Connections
                        only</label>
                    <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="conn"
                        id="connections" name="post_to" value="connections">
                </div>
                <hr>
                <div class="d-flex justify-content-end p-3" style="margin-right:20px;">
                    <div class="col-md-1 me-4">
                        <button class="btn border-primary rounded-5 text-primary" data-bs-toggle="modal"
                            data-bs-target="#newPost">Back</button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary rounded-5" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#newPost">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var full = $('#post_desc').text();
        var visible = full.substring(0, 200);
        $('#post_desc').text(visible);
        $('#read-more').click(function () {
            var text = $('#post_desc');
            if (text.text() == visible) {
                text.text(full);
                $('#read-more').text(" ...less");
            } else {
                text.text(visible);
                $('#read-more').text(" ...more");
            }
        });
        var checked = 'anyone';
        $('input[name="post_to"]').each(function () {
            if ($(this).val() == 'anyone') {
                $(this).prop('checked', true);
                $('#post_to').text(checked);
            }
        });
        $('input[name="post_to"]').click(function () {
            const checked = $(this).val();
            $('#post_to').text(checked);
        });
        $('#image').click(function () {
            $('#fileInput').click();
        });
        $('#post_submit').click(function () {
            const postText = $('#scrollableTextarea').val();
            const fileInput = $('#fileInput');
            const formData = new FormData();
            if (postText) {
                formData.append('post_text', postText);
                const file = fileInput[0].files[0];
                if (file) {
                    formData.append('file', file);
                }
                $.ajax({
                    url: '/user/post',
                    data: formData,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#newPost').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        console.log('ERROR: ' + error);
                    }
                });
            }
        });
        $('#fileInput').on('change', function (event) {
            const fileInput = $(this);
            const file = fileInput[0].files[0];

            if (file) {
                var reader = new FileReader();
                reader.onloadend = function () {
                    var base64Image = reader.result;
                    $('#post-image').attr('src', base64Image).show();
                };
                reader.readAsDataURL(file);
            }
        });
        var posts = [];
        const updatePosts = () => {
            $.ajax({
                url: '/user/post/all',
                data: {},
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    const regex = /\[(.*?)\]/g;
                    const matches = response.matchAll(regex);
                    for (const match of matches) {
                        $.each(match[1].split('<#>'), function (idx, value) {
                            if (value) {
                                const post_info = value.split('<>');
                                const post_view = $(`
                                    <div class="card align-self-start shadow-sm mb-3">
                                        <div class="p-3">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/user/${post_info[0]}" width="40" height="40"
                                                        alt="User Image" class="rounded-circle">
                                                    <div class="d-flex align-items-start">
                                                        <h1 class="card-title fs-6 fw-bold mb-0 ms-2"><a class="text-decoration-none text-black post-hover" href="/search/result?id=${post_info[5]}">${post_info[1]}</a></h1>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center" style="margin-top:-30px;">
                                                    <button class="btn btn-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-caret-down"></i>
                                                    </button>
                                                    <button class="btn btn-link p-0 ms-2" data-bs-dismiss="card" aria-label="Close">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="post" class="p-2">
                                                <small id="post_desc" class="text-wrap" style="font-size:14px;">${post_info[2]}</small>
                                                <span id="read-more" class="text-secondary"
                                                    style="cursor: pointer;font-size:14px;">&nbsp;...more</span>
                                                <img src="/assets/images/post/${post_info[3]}" class="card-img-top mt-2" alt="">
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-secondary">17 comments</small>
                                                </div>
                                                <hr style="margint-top:-50px;">
                                                <div class="d-flex justify-content-between">
                                                    <div class="col-md-3 text-center"><i class="fa fa-heart"></i>&nbsp;Like</div>
                                                    <div class="col-md-3 text-center"><i class="fa fa-commenting"></i>&nbsp;Comment</div>
                                                    <div class="col-md-3 text-center"><i class="fa fa-repeat"></i>&nbsp;Repost</div>
                                                    <div class="col-md-3 text-center"><i class="fa fa-paper-plane"></i>&nbsp;Send</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                if (!posts.includes(post_info[4])) {
                                    posts.push(post_info[4]);
                                    $('#all-posts').prepend(post_view);
                                }
                            }
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log("ERROR: " + error);
                }
            });
        }
        setInterval(updatePosts, 1000);
    });
</script>