<?php
$company_id = isset($_GET['company']) ? $_GET['company'] : 0;
$jobId = isset($_GET['jobId']) ? $_GET['jobId'] : 0;
?>
<div class="container-fluid min-vh-100 bg-light">
    <div class="d-flex justify-content-center">
        <div class="w-75 mt-5 pt-2 mb-5">
            <div class="row g-0" style="min-height:90vh;">
                <div class="col-12 col-md-4">
                    <div class="card"
                        style="max-height:90vh;min-height:90vh;border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                        <div class="card-header bg-white p-3">
                            <h6 class="card-title m-0">Your job posts</h6>
                        </div>
                        <div class="card-body h-100 overflow-auto p-0 m-0">
                            <?php
                            $j = 0;
                            $company = null;
                            $companies = $this->companyModel->getCompanyById($company_id);
                            while ($cmp = $companies->fetch_assoc()) {
                                $company = $cmp;
                            }
                            $jobs = $this->jobModel->getAllJobs($company['id']);
                            while ($job = $jobs->fetch_assoc()) {
                                ?>
                                <div class="job-hover p-3">
                                    <a href="?company=<?php echo $company_id; ?>&jobId=<?php echo $job['id']; ?>"
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
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card"
                        style="max-height:90vh;min-height:90vh;border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem;">
                        <div class="card-body h-100 overflow-auto p-0">
                            <?php
                            if ($jobId == 0) {
                                ?>
                                <div class="align-items-center h-100">
                                    <img src="/assets/images/web/job_search.jpg" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h4 class="text-muted">Select a job to view applicants</h4>
                                    </div>
                                </div>
                                <?php
                            } else {
                                $selectedjob = null;
                                $jobs = $this->jobModel->getJob($jobId);
                                while ($job = $jobs->fetch_assoc()) {
                                    $selectedjob = $job;
                                }
                                $companies = $this->companyModel->getCompanyById($company_id);
                                $cmp = null;
                                while ($company = $companies->fetch_assoc()) {
                                    $cmp = $company;
                                    ?>
                                    <div class="p-3">
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
                                            <p class="rounded me-2 ps-2 pe-2"
                                                style="background-color: rgba(190, 185, 185, 0.7);">
                                                <?php echo $selectedjob['type']; ?>
                                            </p>
                                            <p class="rounded me-2 ps-2 pe-2"
                                                style="background-color: rgba(125, 218, 88, 0.5);"><i
                                                    class="fa fa-check"></i>&nbsp;<?php echo $selectedjob['place']; ?></p>
                                        </div>
                                        <table class="table table-striped mt-3" id="applicants">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Degree</th>
                                                    <th>Contact</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $j = 0;
                                                $applicants = $this->applicantModel->getAllApplicants($jobId);
                                                while ($applicant = $applicants->fetch_assoc()) {
                                                    $education = null;
                                                    $educations = $this->educationModel->getEducation($applicant['applicant']);
                                                    while ($edu = $educations->fetch_assoc()) {
                                                        $education = $edu;
                                                    }
                                                    $user = null;
                                                    $users = $this->userModel->getUserInfo($applicant['applicant']);
                                                    while ($u = $users->fetch_assoc()) {
                                                        $user = $u;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$j; ?></td>
                                                        <td><?php echo $user['first'] . ' ' . $user['last']; ?>
                                                        </td>
                                                        <td><?php echo $education['degree']; ?></td>
                                                        <td><?php echo $user['contact']; ?></td>
                                                        <td class="d-flex">
                                                            <a href="mailto:<?php echo $user['email']; ?>"
                                                                class="btn btn-sm btn-primary me-2"><i class="fa fa-envelope"></i>&nbsp;Email</a>
                                                            <a href="/seeker/profile?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>&nbsp;View profile</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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

<script>
    $(document).ready(() => {
        $('#applicants').DataTable();
    });
</script>