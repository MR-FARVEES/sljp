<div class="container-fluid min-vh-100 bg-light">
    <div class="d-flex justify-content-center">
        <div class="w-75 mt-5 pt-4">
            <div class="row g-4">
                <div class="col-12 col-md-3">
                    <div class="card align-self-start shadow-sm mb-3">
                        <img class="card-img-top" height="100"
                            src="/assets/images/cover/<?php echo $_SESSION['cover']; ?>" alt="Title" />
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
                                        <img src="/assets/images/university/<?php echo $uni_info['logo']; ?>" width="30"
                                            height="30" class="rounded-circle">
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title m-0">Top job picks for you</h5>
                            <small class="card-text">Based on your profile, preferences, and activity like applies, searches, and saves</small>
                            <?php
                            $jobs = $this->jobModel->getJobs();
                            $hst = false;
                            while ($job = $jobs->fetch_assoc()) {
                                $user_skills = $this->userSkillModel->getAllSkills($_SESSION['id']);
                                $skills = [];
                                while ($user_skill = $user_skills->fetch_assoc()) {
                                    array_push($skills, $user_skill['skill']);
                                }
                                $job_skills = $this->jobSkillModel->getJobSkills($job['id']);
                                while ($job_skill = $job_skills->fetch_assoc()) {
                                    if (in_array($job_skill['skill'], $skills)) {
                                        $companies = $this->companyModel->getCompanyById($job['company_id']);
                                        while ($company = $companies->fetch_assoc()) {
                                            if ($hst) {
                                                echo "<hr>";
                                                $hst = false;
                                            }
                            ?>
                            <div class="mt-2">
                            <a href="/seeker/job/collection?jobId=<?php echo $job['id']; ?>" class="text-decoration-none">
                                <div class="d-flex">
                                    <img src="/assets/images/company/logo/<?php echo $company['logo']; ?>" width="50" height="50"
                                        class="" alt="">
                                    <div class="ms-3">
                                        <h6 class="card-title m-0 click-hover"><?php echo $job['title']; ?></h6>
                                        <p class="card-text text-black m-0"><?php echo $company['name']; ?></p>
                                        <p class="card-text text-black m-0 text-muted"><?php echo $job['location'] . " (" . $job['type'] . ")"; ?></p>
                                        <p class="card-text text-black m-0 text-muted"><small><?php echo 'LKR ' . ($job['salary'] / 1000000) * 12 . "M/yr"; ?></small></p>

                                    </div>
                                </div>
                            </a>
                            </div>
                            <?php
                                            $hst = true;
                                        }
                                        break;
                                    }
                                }
                            }
                            ?>
                        </div>
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
                                        <small class="text-muted"><?php echo $user['headline']; ?></small><br>
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
</div>