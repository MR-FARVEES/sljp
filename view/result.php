<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$users = $this->userModel->getUserInfo($id);
$user_info = null;
while ($user = $users->fetch_assoc()) {
    $user_info = $user;
}
?>
<div class="container-fluid w-100 p-5 mt-5">
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
                <div class="card">
                    <div class="d-flex">
                        <img src="/assets/images/user/<?php echo $user_info['profile']; ?>" width="80" height="80"
                            class="rounded-circle m-3" alt="">
                        <div class="mt-3">
                            <h4 class="m-0">
                                <?php echo ucfirst($user_info['first']) . " " . ucfirst($user_info['last']); ?>
                            </h4>
                            <p class="m-0 fw-normal">Headline</p>
                            <p class="m-0 text-muted mb-3">District</p>
                            <p class="text-muted"><i class="fa fa-users"></i>&nbsp;<?php
                            $followers = $this->followerModel->getFollowerCount($_SESSION['id']);
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
                                    class="btn btn-outline-secondary rounded-5">View full profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Other similer profiles</h6>

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