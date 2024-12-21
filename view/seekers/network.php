<div class="container-fluid bg-light mt-5 w-100 d-flex justify-content-center">
    <div class="row w-75 g-4 mt-1">
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-body" id="headingOne">
                    <button
                        class="btn w-100 collapsed text-decoration-none text-black d-flex justify-content-between fs-5"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne" style="max-height:40px;">
                        <p>Manage my network</p>
                        <p><span class="arrow-icon">
                                <i class="fa-solid fa-angle-up"></i>
                            </span></p>
                    </button>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <hr>
                    <div class="">
                        <div class="p-3 mb-3 hover">
                            <a href="/user/connection" class="text-decoration-none d-flex justify-content-between">
                                <h6><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;Connections</h6>
                                <h6>2</h6>
                            </a>
                        </div>
                        <div class="p-3 mb-3 d-flex justify-content-between hover">
                            <a href="" class="text-decoration-none d-flex justify-content-between">
                                <h6><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;Groups</h6>
                                <h6>2</h6>
                            </a>
                        </div>
                        <div class="p-3 mb-3 d-flex justify-content-between hover">
                            <a href="" class="text-decoration-none d-flex justify-content-between">
                                <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Events</h6>
                                <h6>2</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-md-12 min-vh-100">
            <div class="card mb-3">
                <div class="card-body">
                    <div>
                        <?php
                        $educations = $this->educationModel->getEducation($_SESSION['id']);
                        $uni_name = "";
                        $uni_id = 0;
                        while ($education = $educations->fetch_assoc()) {
                            $unies = $this->universityModel->getUniversity($education['institude']);
                            while ($uni = $unies->fetch_assoc()) {
                                $uni_id = $uni['id'];
                                ?>
                                <h6 class="card-title fw-light">People you may know from
                                    <?php echo $uni['name']; ?>
                                </h6>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $educations = $this->educationModel->getUsersByInstitude($uni_id);
                    $row = false;
                    $count = 0;
                    while ($education = $educations->fetch_assoc()) {
                        $users = $this->userModel->getUserInfo($education['user_id']);
                        while ($user = $users->fetch_assoc()) {
                            if ($row == false) {
                                $row = true;
                                ?>
                                <div class="row g-3 mb-3">
                                    <?php
                            }
                            if (!$this->followerModel->isFollower($_SESSION['id'], $user['id']) && $_SESSION['id'] != $user['id']) {
                                ?>
                                    <div class="col-12 col-md-3">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <div class=" d-flex justify-content-center">
                                                    <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="70"
                                                        height="70" class="rounded-circle" alt="">
                                                </div>
                                                <p class="text-center text-muted fw-bold">
                                                    <?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                                                </p>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-outline-secondary rounded-5"
                                                        href="/search/result?id=<?php echo $user['id']; ?>">View full profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                            }
                            if ($count == 3) {
                                $row = false;
                                ?>
                                </div>
                                <?php
                            }
                            $count++;
                            $count = $count % 3;
                        }
                    }
                    if ($row == true) {
                        ?>
                    </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
</div>