<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$users = $this->userModel->getUserInfo($id);
$user_info = null;
while ($user = $users->fetch_assoc()) {
    $user_info = $user;
}
?>
<div class="container-fluid w-100 p-5 mt-5 min-vh-100">
    <div class="d-flex justify-content-center">
        <div class="row g-4 w-100">
            <div class="col-12 col-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">On this page</h5>
                        <p class="card-text">Posts by <?php echo ucfirst($user_info['last']); ?><br>People</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card mb-3">
                    <div class="d-flex">
                        <img src="/assets/images/user/<?php echo $user_info['profile']; ?>" width="80" height="80"
                            class="rounded-circle m-3" alt="">
                        <div class="mt-3">
                            <h4 class="m-0">
                                <?php echo ucfirst($user_info['first']) . " " . ucfirst($user_info['last']); ?>
                            </h4>
                            <p class="m-0 fw-normal"><?php echo $user_info['headline']; ?></p>
                            <p class="m-0 text-muted mb-3"><?php echo $user_info['address']; ?></p>
                            <p class="text-muted"><i class="fa fa-users"></i>&nbsp;<?php
                            $followers = $this->followerModel->getFollowerCount($user_info['id']);
                            while ($follower = $followers->fetch_assoc()) {
                                echo $follower['count'];
                            }
                            ?> followers</p>
                            <div class="d-flex mb-3">
                                <?php
                                if (!$this->followerModel->isFollower($_SESSION['id'], $user_info['id'])) {
                                    ?>
                                    <input type="hidden" id="follow_id" value="<?php echo $user_info['id']; ?>">
                                    <button id="follow" class="btn btn-primary rounded-5 me-3"><i
                                            class="fa fa-plus"></i>&nbsp;follow</button>
                                    <?php
                                }
                                ?>
                                <a href="/seeker/profile?id=<?php echo $user_info['id']; ?>"
                                    class="btn btn-outline-secondary rounded-5 border-2">View full profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i = 0;
                $posts = $this->postModel->getMyPosts($user_info['id']);
                while ($post = $posts->fetch_assoc()) {
                    ?>
                    <div class="card align-self-start shadow-sm mb-3">
                        <div class="p-3">
                            <div class="d-flex justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/images/user/<?php echo $user_info['profile']; ?>" width="40"
                                        height="40" alt="User Image" class="rounded-circle">
                                    <div class="d-flex align-items-start">
                                        <h1 class="card-title fs-6 fw-bold mb-0 ms-2"><a
                                                class="text-decoration-none text-black post-hover"
                                                href="/search/result?id=<?php echo $user_info['id'] ?>">
                                                <?php echo ucfirst($user_info['first']) . " " . ucfirst($user_info['last']); ?>
                                            </a></h1>
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
                                <small id="post_desc" class="text-wrap"
                                    style="font-size:14px;"><?php echo $post['post_text']; ?></small>
                                <span id="read-more" class="text-secondary"
                                    style="cursor: pointer;font-size:14px;">&nbsp;...more</span>
                                <img src="/assets/images/post/<?php echo $post['post_source']; ?>" class="card-img-top mt-2"
                                    alt="">
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
                    <?php
                    $i++;
                }
                if ($i == 0) {
                    ?>
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title">Post info</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center">There is no posts</p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-12 col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Other similer profiles</h5>
                        <?php
                        $heads = explode("|", $user_info['headline']);
                        $users = $this->userModel->getUsersByHeadlineMatching(array_map('trim', $heads));
                        $hr_sts = false;
                        while ($user = $users->fetch_assoc()) {
                            if ($user['id'] == $user_info['id']) {
                                continue;
                            }
                            if ($hr_sts) {
                                ?>
                                <hr>
                                <?php
                            }
                            ?>
                            <div class="d-flex  mt-3">
                                <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="50" height="50"
                                    class="rounded-circle me-3" alt="">
                                <div class="ms-2">
                                    <h6 class="m-0"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                                    </h6>
                                    <p class="text-wrap text-muted"><?php echo $user['headline']; ?></p>
                                    <div class="d-flex justify-content-start">
                                        <button class="btn btn-primary pt-0 pb-0 rounded-5 me-2"><i
                                                class="fa fa-plus"></i>&nbsp;&nbsp;Follow</button>
                                        <a href="/search/result?id=<?php echo $user['id']; ?>" class="btn btn-outline-secondary pt-0 pb-0 border-2 rounded-5"><i
                                                class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $hr_sts = true;
                        }
                        ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Related people</h5>
                        <?php
                        $educations = $this->educationModel->getEducation($user_info['id']);
                        $uni_id = 0;
                        while ($education = $educations->fetch_assoc()) {
                            $unies = $this->universityModel->getUniversity($education['institude']);
                            while ($uni = $unies->fetch_assoc()) {
                                $uni_id = $uni['id'];
                            }
                        }
                        $hr_sts = false;
                        $educations = $this->educationModel->getUsersByInstitude($uni_id);
                        while ($education = $educations->fetch_assoc()) {
                            $users = $this->userModel->getUserInfo($education['user_id']);
                            while ($user = $users->fetch_assoc()) {
                                if ($user['id'] == $_SESSION['id'] || $this->followerModel->isFollower($_SESSION['id'], $user['id'])) {
                                    continue;
                                }
                                if ($hr_sts) {
                                    ?>
                                    <hr>
                                    <?php
                                }
                                ?>
                                <div class="d-flex  mt-3">
                                    <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="50" height="50"
                                        class="rounded-circle me-3" alt="">
                                    <div class="ms-2">
                                        <h6 class="m-0"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                                        </h6>
                                        <p class="text-wrap text-muted"><?php echo $user['headline']; ?></p>
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-primary pt-0 pb-0 rounded-5 me-2"><i
                                                    class="fa fa-plus"></i>&nbsp;&nbsp;Follow</button>
                                            <a href="/search/result?id=<?php echo $user['id']; ?>" class="btn btn-outline-secondary pt-0 pb-0 border-2 rounded-5"><i
                                                    class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $hr_sts = true;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="followRequest">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Follow Request Send</h5>
                <button class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="modal-text text-wrap">Follow request send, wait until user accept your request!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#follow').click(function () {
            const formData = new FormData();
            formData.append('user_id', $('#follow_id').val());
            $.ajax({
                url: '/user/follow',
                data: formData,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#followRequest').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log('ERROR: ' + error);
                }
            });
        });
    });
</script>