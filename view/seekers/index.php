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
                        <p class="card-text text-wrap">
                            <small>Occupation tags | tag 2 | tag 3 | tag 4</small><br>
                            <small>addr</small><br>
                            <small>uni</small>
                        </p>
                    </div>
                </div>
                <div class="card shadow-sm align-self-start mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Try Premium</h4>
                        <p class="card-text text-wrap">Occupation tags | tag 2 | tag 3 | tag 4</p>
                    </div>
                </div>
                <div class="card shadow-sm align-self-start">
                    <div class="card-body">
                        <p class="card-text"><i class="fa fa-users"></i>&nbsp;Groups</p>
                        <p class="card-text"><i class="fa fa-calendar"></i>&nbsp;Events</p>
                        <p class="card-text"><i class="fa fa-newspaper" area-hidden="true"></i>&nbsp;Newsletters</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card align-self-start shadow-sm mb-3">
                    <img class="card-img-top" height="200" src="assets/images/cover/<?php echo $_SESSION['cover']; ?>"
                        alt="Title" />
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Hi <?php echo $_SESSION['fname']; ?>, are you looking
                            for
                            a job right now?<br><small class="fs-6 fw-light text-secondary">your response is only
                                visible to you.</small></smal>
                        </h4>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <button
                                    class="w-100 border-m border-primary text-primary bg-white rounded-5 p-1">Yes</button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button
                                    class="w-100 border-m border-primary text-primary bg-white rounded-5 p-1">No,
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
                <div class="card align-self-start shadow-sm mb-3">
                    <div class="p-3">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/user/<?php echo $_SESSION['profile']; ?>" width="40" height="40"
                                    alt="User Image" class="rounded-circle">
                                <div class="d-flex align-items-start">
                                    <h1 class="card-title fs-6 fw-bold mb-0 ms-2">
                                        <?php echo ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']); ?>
                                    </h1>
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
                            <small id="post_desc" class="text-wrap" style="font-size:14px;">
                                This test message asdfl adf asdf asdf asldf asdlf asd flsad lf;asdf;askdf ;asd ;fas;d
                                fsadflashfkasdfl sdflas dlfalskdf lasdf lsajdf lasjdf laskdf hasdf oasgdf sadklfj s
                                kldfklsdak lisa flsa hfosdhlkf hsahlkdf ilsaduf ohrf;fjgpoidsf;ogmad;shf askldfl
                                sahdflk;sa filusah flashdf aslf</small>
                            <span id="read-more" class="text-secondary"
                                style="cursor: pointer;font-size:14px;">&nbsp;...more</span>
                            <img src="/assets/images/cover/default.jpg" class="card-img-top mt-2" alt="">
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
            </div>
            <div class="col-12 col-md-3">
                <div class="card align-self-start shadow-sm">
                    <div class="card-body p-5">

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
                        <p class="fs-6">Post to <?php echo ucfirst($post_to); ?></p>
                    </div>
                </div>
                <button style="margin-top:-70px;" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea id="scrollableTextarea" class="form-control fs-5 border-0"
                    placeholder="What do you want to talk about?" rows="10"></textarea>
                <div class="d-flex">
                    <i class="m-4 fa fa-image text-secondary"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded-5">Post</button>
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
                    <?php if ($post_to == "anyone") { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="any"
                            name="post_to" value="anyone" checked>
                    <?php } else { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="any"
                            name="post_to" value="anyone">
                    <?php } ?>
                </div>
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="conn"><i class="fa fa-users icon-cover"></i>&nbsp;&nbsp;Connections
                        only</label>
                    <?php if ($post_to == "connections") { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="conn"
                            name="post_to" value="connections" checked>
                    <?php } else { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="conn"
                            name="post_to" value="connections">
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-between hover" data-bs-toggle="modal" data-bs-target="#commentControl">
                    <p class="pt-3 ps-3 fs-5">Comment Control</p>
                    <i class="fa fa-caret-right pt-4 pe-3"></i>
                </div>
                <hr>
                <div class="d-flex justify-content-end p-3" style="margin-right:20px;">
                    <div class="col-md-1 me-4">
                        <button class="btn border-primary rounded-5 text-primary" data-bs-toggle="modal"
                            data-bs-target="#newPost">Back</button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary rounded-5">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="commentControl">
    <div class="modal-dialog modal-dialog-centered modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Comment Control</h1>
                <button class="btn-close" data-bs-toggle="modal" data-bs-target="#newPost"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="">
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="any_com"><i class="fa fa-globe icon-cover"></i>&nbsp;&nbsp;Anyone</label>
                    <?php if ($comment == "anyone") { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="any_com"
                            name="comment" value="anyone" checked>
                    <?php } else { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="any_com"
                            name="comment" value="anyone">
                    <?php } ?>
                </div>
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="con_com"><i class="fa fa-users icon-cover"></i>&nbsp;&nbsp;Connections
                        only</label>
                    <?php if ($comment == "connections") { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="con_com"
                            name="comment" value="connections" checked>
                    <?php } else { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="con_com"
                            name="comment" value="connections">
                    <?php } ?>
                </div>
                <div class="ps-5 pe-3 pt-3 pb-3 hover d-flex justify-content-between">
                    <label class="fs-5" for="no_com"><i class="fa fa-users icon-cover"></i>&nbsp;&nbsp;No one
                        only</label>
                    <?php if ($comment == "connections") { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="no_com"
                            name="comment" value="connections" checked>
                    <?php } else { ?>
                        <input type="radio" class="form-check-input scale-1" style="margin: 25px 0 25px 0;" id="no_com"
                            name="comment" value="connections">
                    <?php } ?>
                </div>
                <hr>
                <div class="d-flex justify-content-end p-3" style="margin-right:20px;">
                    <div class="col-md-1 me-4">
                        <button class="btn border-primary rounded-5 text-primary" data-bs-toggle="modal"
                            data-bs-target="#post">Back</button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary rounded-5">Done</button>
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
    });
</script>