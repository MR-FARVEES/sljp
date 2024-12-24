<?php
$jobId = isset($_GET['jobId']) ? $_GET['jobId'] : null;
?>
<div class="container-fluid min-vh-100 bg-light">
    <div class="d-flex justify-content-center">
        <div class="w-75 mt-5 pt-2 mb-5">
            <div class="row g-0" style="min-height:90vh;">
                <div class="col-12 col-md-6">
                    <div class="card"
                        style="max-height:90vh;min-height:90vh;border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                        <div class="card-header bg-white p-3">
                            <h6 class="card-title m-0">Top job picks for you</h6>
                            <p class="card-text text-muted"><small>Based on your profile, preferences, and activity like
                                    applies, searches, and saves</small></p>
                        </div>
                        <div class="card-body h-100 overflow-auto p-0 m-0">
                            <?php
                            $js = $this->jobModel->getJob($jobId);
                            $selectedjob = null;
                            while ($j = $js->fetch_assoc()) {
                                $selectedjob = $j;
                                $titles = explode(" ", $j['title']);
                                $jobs = $this->jobModel->getJobsByTitle($titles);
                                while ($job = $jobs->fetch_assoc()) {
                                    $companies = $this->companyModel->getCompanyById($job['company_id']);
                                    while ($company = $companies->fetch_assoc()) {
                                        ?>
                                        <div class="p-2" style="background-color: <?php if ($job['id'] == $jobId) {
                                            echo 'rgba(186, 186, 255, 0.2)';
                                        } else {
                                            echo 'white';
                                        } ?>;">
                                            <a href="/seeker/job/collection?jobId=<?php echo $job['id']; ?>"
                                                class="text-decoration-none">
                                                <div class="d-flex">
                                                    <img src="/assets/images/company/logo/<?php echo $company['logo']; ?>"
                                                        width="50" height="50" class="" alt="">
                                                    <div class="ms-3">
                                                        <h6 class="card-title m-0 click-hover"><?php echo $job['title']; ?></h6>
                                                        <p class="card-text text-black m-0"><?php echo $company['name']; ?></p>
                                                        <p class="card-text text-black m-0 text-muted">
                                                            <?php echo $job['location'] . " (" . $job['type'] . ")"; ?>
                                                        </p>
                                                        <p class="card-text text-black m-0 text-muted">
                                                            <small><?php echo 'LKR ' . ($job['salary'] / 1000000) * 12 . "M/yr"; ?></small>
                                                        </p>

                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card"
                        style="max-height:90vh;min-height:90vh;border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem;">
                        <div class="card-body h-100 overflow-auto">
                            <?php
                            $companies = $this->companyModel->getCompanyById($selectedjob['company_id']);
                            $cmp = null;
                            while ($company = $companies->fetch_assoc()) {
                                $cmp = $company;
                                ?>
                                <div class="d-flex justify-content-start">
                                    <img src="/assets/images/company/logo/<?php echo $company['logo']; ?>" width="50"
                                        height="50" alt="">
                                    <p class="pt-2 ms-2"><?php echo $company['name']; ?></p>
                                </div>
                                <h4 class="pt-3 pb-3"><?php echo $selectedjob['title']; ?></h4>
                                <p class="text-muted m-0">
                                    <?php echo $company['location'] . ' ' . $this->findAgo(new DateTime($selectedjob['posted_at'])); ?>
                                </p>
                                <div class="d-flex mt-2">
                                    <p class="rounded me-2 ps-2 pe-2" style="background-color: rgba(190, 185, 185, 0.7);">
                                        <?php echo $selectedjob['type']; ?>
                                    </p>
                                    <p class="rounded me-2 ps-2 pe-2" style="background-color: rgba(125, 218, 88, 0.5);"><i
                                            class="fa fa-check"></i>&nbsp;<?php echo $selectedjob['place']; ?></p>
                                </div>
                                <input type="hidden" id="job_id" value="<?php echo $selectedjob['id']; ?>">
                                <button type="button" id="apply-job" class="btn btn-primary rounded-5"><i
                                        class="fa fa-check"></i>&nbsp;Apply JOB</button>
                                <p class="fs-5 fw-medium pt-2">Employer you can reach out to</p>
                                <?php
                                $providers = $this->userModel->getUserInfo($company['founder']);
                                $provider = null;
                                while ($user = $providers->fetch_assoc()) {
                                    $provider = $user;
                                }
                                ?>
                                <div class="row border rounded shadow-sm m-1">
                                    <div class="col-12 col-md-3 p-2">
                                        <img src="/assets/images/user/<?php echo $provider['profile']; ?>"
                                            style="max-width:100px;" class="rounded-circle" alt="">
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <h5 class="card-title pt-3">
                                            <?php echo ucfirst($provider['first']) . ' ' . ucfirst($provider['last']); ?>
                                        </h5>
                                        <p class="card-text text-muted"><?php echo $provider['headline']; ?></p>
                                    </div>
                                </div>
                                <p class="fs-5 fw-medium pt-2">About the job</p>
                                <p class="fs-6 pt-2"><?php echo $selectedjob['description']; ?></p>
                                <p class="fs-5 fw-medium pt-5">See how you can compare other applicants</p>
                                <?php
                                $count = 0;
                                $applicants = $this->jobApplicantModel->getApplicantsCount($selectedjob['id']);
                                while ($applicant = $applicants->fetch_assoc()) {
                                    $count = $applicant['count'];
                                }
                                $applicants = $this->jobApplicantModel->getAllApplicants($selectedjob['id']);
                                $entry = [];
                                $senior = [];
                                $director = [];
                                $bedu = [];
                                $medu = [];
                                $mbaEdu = [];
                                $other = [];
                                while ($applicant = $applicants->fetch_assoc()) {
                                    $educations = $this->educationModel->getEducation($applicant['applicant']);
                                    while ($education = $educations->fetch_assoc()) {
                                        if (str_starts_with(strtoupper($education['degree']), 'B')) {
                                            $bedu[] = $education;
                                        } else if (str_starts_with(strtoupper($education['degree']), 'M')) {
                                            $medu[] = $education;
                                        } else if (str_starts_with(strtoupper($education['degree']), 'MBA')) {
                                            $mbaEdu[] = $education;
                                        } else {
                                            $other[] = $education;
                                        }
                                    }
                                    $users = $this->userModel->getUserInfo($applicant['applicant']);
                                    while ($user = $users->fetch_assoc()) {
                                        if (str_contains(strtoupper($user['headline']), 'SENIOR')) {
                                            $senior[] = $user;
                                        } else if (str_contains(strtoupper($user['headline']), 'DIRECTOR')) {
                                            $director[] = $user;
                                        } else {
                                            $entry[] = $user;
                                        }
                                    }
                                }
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="fs-6 fw-medium m-0 mt-3">Applicants for this job</p>
                                        <p class="m-0 fw-bold"><?php echo $count; ?> <span
                                                class="fw-light"><small>Applicants</small></span></p>
                                        <p class="m-0 fw-bold"><?php echo $count; ?> <span
                                                class="fw-light"><small>Applicants in the
                                                    past day</small></span></p>
                                        <p class="fs-6 fw-medium mt-3 m-0">Applicants senior level</p>
                                        <p class="m-0 fw-bold"><span
                                                class="fw-normal"><small><?php echo (count($entry) / $count) * 100; ?>%
                                                    Entry level
                                                    applicant</small></span></p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar"
                                                aria-valuenow="<?php echo (count($entry) / $count) * 100 ?>"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo (count($entry) / $count) * 100 ?>%">
                                            </div>
                                        </div>
                                        <p class="m-0 fw-bold"><span
                                                class="fw-normal"><small><?php echo (count($senior) / $count) * 100; ?>%
                                                    Senior
                                                    level applicant</small></span></p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar"
                                                aria-valuenow="<?php echo (count($senior) / $count) * 100 ?>"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo (count($senior) / $count) * 100 ?>%">
                                            </div>
                                        </div>
                                        <p class="m-0 fw-bold"><span
                                                class="fw-normal"><small><?php echo (count($director) / $count) * 100; ?>%
                                                    Director
                                                    level applicant</small></span></p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar"
                                                aria-valuenow="<?php echo (count($director) / $count) * 100 ?>"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo (count($director) / $count) * 100 ?>%">
                                            </div>
                                        </div>
                                        <p class="fs-6 fw-medium m-0 mt-3">Applicants education level</p>
                                        <div class="d-flex">
                                            <p class="text-end fs-3 fw-medium" style="width:50px;">
                                                <?php echo (count($bedu) / $count) * 100; ?></p>
                                            <p style="margin-top:12px;">% have a Bachelor's Degree</p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="text-end fs-3 fw-medium" style="width:50px;">
                                                <?php echo (count($medu) / $count) * 100; ?></p>
                                            <p style="margin-top:12px;">% have a Master's Degree</p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="text-end fs-3 fw-medium" style="width:50px;">
                                                <?php echo (count($mbaEdu) / $count) * 100; ?></p>
                                            <p style="margin-top:12px;">% have a Master of Business Administration</p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="text-end fs-3 fw-medium" style="width:50px;">
                                                <?php echo (count($other) / $count) * 100; ?></p>
                                            <p style="margin-top:12px;">% have other degrees</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="applyInfo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title">Job Info</h5>
                <button class="btn btn-close fs-6" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <span class="modal-text">You have applied the <span
                        class="text-danger"><?php echo $selectedjob['title']; ?></span> now! wait for the confirmation
                    from <span class="text-primary"><?php echo $cmp['name']; ?></span>. If you eligible for this <span
                        class="text-danger"><?php echo $selectedjob['title']; ?></span>, <span
                        class="text-primary"><?php echo $cmp['name']; ?></span> will call you!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary rounded-5" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        const print = (data) => {
            console.log(data);
        }
        $('#apply-job').click(() => {
            print('work');
            const formData = new FormData();
            formData.append('job_id', $('#job_id').val());
            $.ajax({
                url: '/seeker/job/apply',
                data: formData,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#applyInfo').modal('show');
                },
                error: function (xhr, status, error) {
                    print('ERROR: ' + error);
                }
            });
        });
    });
</script>