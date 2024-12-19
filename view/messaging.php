<div class="card position-fixed bottom-0 end-0 p-0" style="min-width:21rem;">
    <div class="card-header d-flex justify-content-between p-0 bg-white">
        <button class="btn w-100 collapsed text-decoration-none text-black d-flex justify-content-between fs-5 m-0"
            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
            aria-controls="collapseOne">
            <div class="d-flex">
                <div class="position-relative">
                    <img src="/assets/images/user/<?php echo $_SESSION['profile']; ?>" width="35" height="35"
                        class="rounded-circle me-2" alt="user-image">
                    <span
                        class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-light rounded-circle"></span>
                </div>
                <h6 class="card-title me-2 pt-1 ps-1">messaging</h6>
            </div>
            <p><span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span></p>
        </button>
    </div>
    <div id="collapseOne" class="collapse w-100" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="card-body p-2">
            <div class="input-group">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
                <input type="text" id="search-friend" class="form-control" placeholder="Search friend by name">
            </div>
        </div>
        <hr class="m-0">
        <div class="card-body p-2" style="min-height:50vh;">
            <div class="w-100">
                <?php
                $followers = $this->followerModel->getAllFollowers($_SESSION['id']);
                while ($follower = $followers->fetch_assoc()) {
                    $users = $this->userModel->getUserInfo($follower['follow_id']);
                    while ($user = $users->fetch_assoc()) {
                        ?>
                        <div class="d-flex p-2" id="message-<?php echo $user['id']; ?>">
                            <img src="/assets/images/user/<?php echo $user['profile']; ?>" alt="" class="rounded-circle"
                                width="50" height="50">
                            <p class="fs-6 ms-3 mt-2"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?></p>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$followers = $this->followerModel->getAllFollowers($_SESSION['id']);
while ($follower = $followers->fetch_assoc()) {
    $users = $this->userModel->getUserInfo($follower['follow_id']);
    while ($user = $users->fetch_assoc()) {
        ?>
        <div id="conversation-<?php echo $user['id']; ?>" class="card d-none position-fixed bottom-0 end-0 zindex-1000"
            style="margin-right:22rem;min-width:30rem;min-height:60vh;">
            <div class="card-header w-100 d-flex justify-content-between bg-white">
                <div class="d-flex">
                    <div class="position-relative">
                        <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="35" height="35"
                            class="rounded-circle me-2" alt="user-image">
                    </div>
                    <h6 class="card-title me-2 pt-1 ps-1 fs-6"><a
                            href="/seeker/profile?id=<?php echo $user['id']; ?>"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?></a>
                    </h6>
                </div>
                <button class="btn btn-close" id="close_conversation-<?php echo $user['id']; ?>"></button>
            </div>
            <div class="card-body overflow-auto" style="max-height: 50vh;">
                <div class="start-0">
                    <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="60" height=60" class="rounded-circle"
                        alt="">
                    <h5 class="card-title me-2 pt-1 ps-1"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                    </h5>
                    <p class="text-muted text-wrap w-75"><?php echo $user['headline']; ?></p>
                </div>
                <?php
                for ($i = 0; $i < 10; $i++) {
                    ?>
                    <div class="start-0">
                        <h5 class="card-title me-2 pt-1 ps-1"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                        </h5>
                        <p class="text-muted text-wrap w-75"><?php echo $user['headline']; ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="card-footer">
                <textarea id="text-message-<?php echo $user['id']; ?>" placeholder="Write some message" class="form-control mb-2" rows="3"></textarea>
                <div class="d-flex justify-content-end">
                    <button id="send-message-<?php echo $user['id']; ?>" type="button" class="btn btn-primary disabled"><i class="fa fa-paper-plane"></i>&nbsp;Send</button>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<script>
    $(document).ready(function () {
        $('[id^=close_conversation-]').click(function () {
            const id = $(this).attr('id').split('-')[1];
            $('#conversation-' + id).toggleClass('d-none');
        });
        $('[id^=message-]').click(function () {
            const id = $(this).attr('id').split('-')[1];
            $('[id^=conversation-]').each(function () {
                $(this).addClass('d-none');
            });
            $('#conversation-' + id).toggleClass('d-none');
        });
        $('[id^=text-message-]').on('input', function() {
            const id = $(this).attr('id').split('-')[2];
            const msg = $(this).val();
            if (msg) {
                $('#send-message-' + id).removeClass('disabled');
            } else {
                $('#send-message-' + id).addClass('disabled');
            }
        });
    });
</script>