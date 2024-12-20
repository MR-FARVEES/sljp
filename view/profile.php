<?php $id = isset($_GET['id']) ? $_GET['id'] : 0; ?>
<div class="container-fluid" style="margin:0; padding:0;">
    <div class=" d-flex justify-content-center">
        <div class="d-flex w-100 justify-content-center">
            <div class="w-75 mt-5">
                <div class="row g-3 mt-5 mb-5">
                    <?php
                    $users = $this->userModel->getUserInfo($id);
                    $user = $users->fetch_assoc();
                    ?>
                    <div class="align-self-start col-12 col-md-8 mb-3">
                        <div class="card shadow-sm mb-3">
                            <img class="card-img-top" height="240" src="/assets/images/cover/<?php if ($id == 0) {
                                echo $user_info['cover'];
                            } else {
                                echo $user['cover'];
                            } ?>" alt="Title" />
                            <div class="rounded-circle"
                                style="margin-left:20px;margin-top:-140px;width: 186px;height: 186px;background:#fff;padding:3px;">
                                <img class="rounded-circle" width="180" height="180" src="/assets/images/user/<?php if ($id == 0) {
                                    echo $user_info['profile'];
                                } else {
                                    echo $user['profile'];
                                } ?> ?>" alt="Title" />
                            </div>
                            <div class="card-body">
                                <?php
                                if ($id == 0) {
                                    ?>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn" style="margin-top:-50px;" data-bs-toggle="modal"
                                            data-bs-target="#editProfile">
                                            <i class="fa fa-pencil fs-5"></i>
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">
                                        <span class="col-12 col-md-6">
                                            <?php if ($id == 0) {
                                                echo ucfirst($user_info['first']) . " " . ucfirst($user_info['last']);
                                                ?>
                                            </span>
                                            <?php
                                            } else {
                                                ?>
                                            <span class="col-12 col-md-6">
                                                <?php
                                                echo ucfirst($user['first']) . " " . ucfirst($user['last']);
                                                ?>
                                            </span>
                                            <?php
                                            }
                                            ?>
                                    </h5>
                                    <div class="me-2">
                                        <div class="w-100">
                                            <?php
                                            $i = 0;
                                            $user_id = 0;
                                            if ($id == 0) {
                                                $user_id = $user_info['id'];
                                            } else {
                                                $user_id = $user['id'];
                                            }
                                            $educations = $this->educationModel->getEducation($user_id);
                                            while ($education = $educations->fetch_assoc()) {
                                                $unies = $this->universityModel->getUniversity($education['institude']);
                                                while ($uni = $unies->fetch_assoc()) {
                                                    ?>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <img src="/assets/images/university/<?php echo $uni['logo'] ?>"
                                                            width="30" height="30" class="border rounded-circle shadow-sm"
                                                            alt="<?php echo $uni['name'] . " Logo"; ?>">
                                                        <h6 class="ms-2 fs-6 pt-1"><?php echo $uni['name']; ?></h>
                                                    </div>
                                                    <?php
                                                }
                                                $i++;
                                            }
                                            if ($i == 0 && $id == 0) {
                                                ?>
                                                <p class="text-wrap text-secondary fs-6  text-end">
                                                    There is no Education
                                                </p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-text text-wrap">
                                    <p class="fs-6 d-inline-block text-trancate text-wrap">
                                        <?php
                                        if ($id == 0) {
                                            if ($user_info['headline'] != 'N/A') {
                                                echo $user_info['headline'];
                                            } else {
                                                echo '<span class="text-secondary">No headlines</span>';
                                            }
                                        } else {
                                            if ($user['headline'] != 'N/A') {
                                                echo $user['headline'];
                                            } else {
                                                echo '<span class="text-secondary">No headlines</span>';
                                            }
                                        }
                                        ?>
                                    </p>
                                    <p class="fw-light">
                                        <?php if ($id == 0) {
                                            echo $user_info['address'];
                                        } else {
                                            echo $user['address'];
                                        } ?>
                                    </p>
                                </div>
                                <?php
                                if ($id != 0) {
                                    ?>
                                    <p class="text-muted"><i class="fa fa-users"></i>&nbsp;<?php
                                    $followers = $this->followerModel->getFollowerCount($user['id']);
                                    while ($follower = $followers->fetch_assoc()) {
                                        echo $follower['count'];
                                    }
                                    ?> followers</p>
                                    <?php
                                    if (!$this->followerModel->isFollower($_SESSION['id'], $user['id'])) {
                                        ?>
                                        <div class="card-text d-flex justify-content-start">
                                            <input type="hidden" id="follow_id" value="<?php echo $user['id']; ?>">
                                            <button id="follow" class="btn btn-primary rounded-5 me-3"><i
                                                    class="fa fa-plus"></i>&nbsp;Follow</button>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <p class="text-muted"><i class="fa fa-users"></i>&nbsp;<?php
                                    $followers = $this->followerModel->getFollowerCount($_SESSION['id']);
                                    while ($follower = $followers->fetch_assoc()) {
                                        echo $follower['count'];
                                    }
                                    ?> followers</p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body p-4">
                                <h5 class="card-title">Description</h5>
                                <p class="card-text">
                                    <?php
                                    $user_id = 0;
                                    if ($id != 0) {
                                        $user_id = $user['id'];
                                    } else {
                                        $user_id = $user_info['id'];
                                    }
                                    $educations = $this->educationModel->getEducation($user_id);
                                    while ($education = $educations->fetch_assoc()) {
                                        if ($education['description'] == 'N/A') {
                                            echo 'Not updated';
                                        } else {
                                            echo $education['description'];
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body p-4">
                                <h5 class="card-title">Education</h5>
                                <div class="card-text p-2">
                                    <?php
                                    $user_id = 0;
                                    if ($id != 0) {
                                        $user_id = $user['id'];
                                    } else {
                                        $user_id = $user_info['id'];
                                    }
                                    $i = 0;
                                    $educations = $this->educationModel->getEducation($user_id);
                                    while ($education = $educations->fetch_assoc()) {
                                        $uni = null;
                                        $universities = $this->universityModel->getUniversity($education['institude']);
                                        while ($university = $universities->fetch_assoc()) {
                                            $uni = $university;
                                        }
                                        ?>
                                        <div class="d-flex">
                                            <img src="/assets/images/university/<?php echo $uni['logo']; ?>" width="70"
                                                height="70" alt="">
                                            <div class="ms-3 p-0">
                                                <p class="m-0 p-0fs-5 fw-bold"><?php echo $uni['name']; ?></p>
                                                <p class="m-0 p-0"><?php echo $education['degree']; ?></p>
                                                <p class="m-0 p-0 text-muted">
                                                    <?php
                                                    echo DateTime::createFromFormat('!m', $education['smonth'])->format('M') .
                                                        " " . $education['syear'] . " - " . DateTime::createFromFormat('!m', $education['emonth'])->format('M') . " " . $education['eyear'];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                    if ($i == 0)
                                        echo '<p>Not updated</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body p-4">
                                <h5 class="card-title">Education</h5>
                                <div class="card-text">
                                    <?php
                                    $user_id = 0;
                                    if ($id != 0) {
                                        $user_id = $user['id'];
                                    } else {
                                        $user_id = $user_info['id'];
                                    }
                                    $count = 0;
                                    $row = false;
                                    $skills = $this->userSkillModel->getAllSkills($user_id);
                                    while ($skill = $skills->fetch_assoc()) {
                                        if (!$row) {
                                            $row = true;
                                            ?>
                                            <div class="row g-3">
                                                <?php
                                        }
                                        ?>
                                            <div class="col-12 col-md-4">
                                                <p class="rounded-5 bg-primary text-white text-center">
                                                    <?php echo $skill['skill']; ?>
                                                </p>
                                            </div>
                                            <?php
                                            if ($count == 2) {
                                                $row = false;
                                                ?>
                                            </div>
                                            <?php
                                            }
                                            $count++;
                                            $count = $count % 3;
                                    }
                                    if ($row) {
                                        ?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="align-self-start  col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">
                                People you may know
                            </h6>
                            <p class="card-text text-wrap">
                                <?php
                                $educations = $this->educationModel->getEducation($_SESSION['id']);
                                $uni_id = 0;
                                while ($education = $educations->fetch_assoc()) {
                                    $unies = $this->universityModel->getUniversity($education['institude']);
                                    while ($uni = $unies->fetch_assoc()) {
                                        $uni_id = $uni['id'];
                                    }
                                }
                                $educations = $this->educationModel->getUsersByInstitude($uni_id);
                                while ($education = $educations->fetch_assoc()) {
                                    $users = $this->userModel->getUserInfo($education['user_id']);
                                    while ($user = $users->fetch_assoc()) {
                                        if (!$this->followerModel->isFollower($_SESSION['id'], $user['id']) && $_SESSION['id'] != $user['id']) {
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
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" tabindex="-1" id="editProfile">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/profile/update" method="post">
                <div class="modal-header">
                    <div class="d-flex justify-content-between w-100">
                        <h5 class="modal-title">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <h6 class="fw-light">* indicates required</h6>
                    <h5>Basic Info</h5>
                    <div class="mb-3 fw-light">
                        <label for="first">Firstname*</label>
                        <input type="text" id="first" class="form-control" name="first"
                            value="<?php echo $user_info['first']; ?>" required>
                    </div>
                    <div class="mb-3 fw-light">
                        <label for="last">Lastname*</label>
                        <input type="text" id="last" class="form-control" name="last"
                            value="<?php echo $user_info['last']; ?>" required>
                    </div>
                    <div class="mb-3 fw-light">
                        <label for="headline">Headline*</label>
                        <textarea name="headline" id="headline" class="form-control"
                            rows="2"><?php echo $user_info['headline']; ?></textarea>
                    </div>
                    <h5>Education</h5>
                    <div class="mb-3">
                        <label for="school">School*</label>
                        <select name="school" id="school" class="form-select" area-hidden="true">
                            <?php
                            $i = 0;
                            $educations = $this->educationModel->getEducation($_SESSION['id']);
                            while ($education = $educations->fetch_assoc()) {
                                $universities = $this->universityModel->getUniversity($education['institude']);
                                while ($university = $universities->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $university['name'] ?>"><?php echo $university['name'] ?>
                                    </option>
                                    <?php
                                    $i++;
                                }
                            }
                            if ($i == 0) {
                                ?>
                                <option value="">No Education Provided</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn text-primary btn-hover" data-bs-toggle="modal"
                            data-bs-target="#editEducation"><i class="fa fa-plus"></i>&nbsp;Add new
                            education</button>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="show-school" name="show-school" value="show" class="form-check-input"
                            style="transform:scale(1.2);" <?php if ($user_info['show_school'] == 'show') {
                                echo 'checked';
                            } ?>>
                        <label for="show-school" class="form-check-label">&nbsp;Show school in my intro</label>
                    </div>
                    <h5>Location</h5>
                    <div class="mb-3">
                        <label for="address">Address*</label>
                        <textarea name="address" id="address" class="form-control"
                            row="2"><?php echo $user_info['address']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary rounded-5">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="editEducation">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="modal-title">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-toggle="modal" data-bs-target="#editProfile"></button>
                </div>
            </div>
            <div class="modal-body" style="max-height: 500px;">
                <h6 class="fw-light">* indicates required</h6>
                <div class="mb-3">
                    <div id="alert" class="alert alert-warning d-none" role="alert">
                        Some fields are required!
                    </div>
                    <div class="dropdown" id="skill-dropdown">
                        <label for="edu-school">School*</label>
                        <input type="text" class="form-control" id="edu-school" data-bs-toggle="dropdown"
                            aria-expanded="false" placeholder="Ex: University of Kelaniya" required>
                        <ul id="schools" class="dropdown-menu w-100" aria-labelledby="edu-school">

                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="dropdown">
                        <label for="edu-degree">Degree*</label>
                        <input type="text" class="form-control" id="edu-degree" data-bs-toggle="dropdown"
                            aria-expanded="false" placeholder="Ex: Batchelor's" required>
                        <ul id="degrees" class="dropdown-menu w-100" aria-labelledby="edu-degree">

                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="dropdown">
                        <label for="edu-field">Field of Study*</label>
                        <input type="text" class="form-control" id="edu-field" data-bs-toggle="dropdown"
                            aria-expanded="false" placeholder="Ex: Business" required>
                        <ul id="edu-fields" class="dropdown-menu w-100" aria-labelledby="edu-field">

                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Start date*</label>
                    <div class="d-flex">
                        <select id="edu-start-month" class="form-select me-3" area-hidden="true">
                            <option value="month" default>Month</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $month = date('F', mktime(0, 0, 0, $i, 1));
                                ?>
                                <option value="<?php if ($i < 10) {
                                    echo '0' . $i;
                                } else {
                                    echo $i;
                                } ?>">
                                    <?php echo $month; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <select id="edu-start-year" class="form-select" area-hidden="true">
                            <option value="year" default>Year</option>
                            <?php
                            $currentDate = date('Y');
                            for ($i = $currentDate - 10; $i <= $currentDate + 20; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-">
                    <label for="">End date*</label>
                    <div class="d-flex">
                        <select id="edu-end-month" class="form-select me-3" area-hidden="true">
                            <option value="month" default>Month</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $month = date('F', mktime(0, 0, 0, $i, 1));
                                ?>
                                <option value="<?php if ($i < 10) {
                                    echo '0' . $i;
                                } else {
                                    echo $i;
                                } ?>">
                                    <?php echo $month; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <select id="edu-end-year" class="form-select" area-hidden="true">
                            <option value="year" default>Year</option>
                            <?php
                            $currentDate = date('Y');
                            for ($i = $currentDate - 10; $i <= $currentDate + 20; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="edu-grade">Grade*</label>
                    <input type="number" class="form-control" id="edu-grade" placeholder="Ex: 3.50" required>
                </div>
                <div class="mb-3">
                    <label for="edu-activities">Activities</label>
                    <textarea id="edu-activities" class="form-control"
                        placeholder="Ex: Alpha Phi Omega, Marching Band, Volleyball" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="edu-description">Description</label>
                    <textarea id="edu-description" class="form-control" rows="3"></textarea>
                </div>
                <h5>Skills</h5>
                <p>We recommend adding your top 5 used in this experience. They’ll also appear in your Skills
                    section.
                </p>
                <div id="manage-skills">
                    <div id="skills">
                    </div>
                    <button class="btn border-primary rounded-5 text-primary" id="add-skill"><i
                            class="fa fa-plus"></i>&nbsp;Add skill</button>
                </div>
            </div>
            <div class="modal-footer">
                <button id="edu-save" class="btn btn-primary rounded-5">Save</button>
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
        var skills = [];
        var universities = [];
        var degrees = [];
        var fields = [];
        var userInput = "";
        var schoolName = "";
        var degreeName = "";
        var fieldName = "";

        $.ajax({
            url: '/skills',
            data: {},
            type: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                const regex = /\[(.*?)\]/g;
                const matches = response.matchAll(regex);
                for (const match of matches) {
                    skills = match[1].split(",");
                }
            },
            error: function (xhr, status, errror) {
                console.log("ERROR: " + errror);
            }
        });

        $.ajax({
            url: '/universities',
            data: {},
            type: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                const regex = /\[(.*?)\]/g;
                const matches = response.matchAll(regex);
                for (const match of matches) {
                    universities = match[1].split(",");
                }
            },
            error: function (xhr, status, errror) {
                console.log("ERROR: " + errror);
            }
        });

        $.ajax({
            url: '/degrees',
            data: {},
            type: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                const regex = /\[(.*?)\]/g;
                const matches = response.matchAll(regex);
                for (const match of matches) {
                    degrees = match[1].split(",");
                }
            },
            error: function (xhr, status, errror) {
                console.log("ERROR: " + errror);
            }
        });

        $.ajax({
            url: '/fields',
            data: {},
            type: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                const regex = /\[(.*?)\]/g;
                const matches = response.matchAll(regex);
                for (const match of matches) {
                    fields = match[1].split(",");
                }
            },
            error: function (xhr, status, errror) {
                console.log("ERROR: " + errror);
            }
        });

        $('#add-skill').click(function () {
            $(this).addClass('d-none');
            const skill_title = $(`
                <div class="dropdown" id="skill-dropdown">
                    <input 
                        type="text" 
                        class="form-control" 
                        id="skill-input" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false" 
                        placeholder="Skill (Ex: Project Management)"
                    >
                    <ul id="titles" class="dropdown-menu w-100" aria-labelledby="skill-input">
                        
                    </ul>
                </div>
            `);
            // const drop_down = $(`<ul></ul>`);
            $('#manage-skills').append(skill_title);
            skill_title.find('#skill-input').on("keydown", function (evt) {
                if (evt.key === "Backspace") {
                    const tmp = skill_title.val();
                    userInput = tmp.slice(0, tmp.length - 1);
                } else if (evt.key === "Shift" || evt.key === "Alt") {

                } else {
                    userInput += evt.key;
                }
                const matchingElements = $.grep(skills, function (element) {
                    return element.toLowerCase().includes(userInput.toLowerCase()) ||
                        element.toLowerCase().startsWith(userInput.toLowerCase()) ||
                        element.toLowerCase().endsWith(userInput.toLowerCase());
                });
                skill_title.find('#titles').empty();
                matchingElements.forEach(skill => {
                    const button = $(`<li><button class="dropdown-item">${skill}</button></li>`);
                    skill_title.find('ul').append(button);
                    button.find('button').click(function () {
                        const skill = $(`
                            <div class="d-flex p-1 ps-3 rounded-5 col-md-6">
                                <h6 class="">${this.innerText}</h6>
                                <button class="btn btn-close text-white me-2"></button>
                            </div>
                        `);
                        skill_title.remove();
                        $('#add-skill').removeClass('d-none');
                        $('#skills').append(skill);
                        skill.find('button').click(function () {
                            skill.remove();
                        });
                    });
                });
            });
        });

        $('#edu-save').click(function () {
            const school = $('#edu-school').val().trim();
            const degree = $('#edu-degree').val().trim();
            const field = $('#edu-field').val().trim();
            const start_month = $('#edu-start-month').val().trim();
            const start_year = $('#edu-start-year').val().trim();
            const end_month = $('#edu-end-month').val().trim();
            const end_year = $('#edu-end-year').val().trim();
            const grade = $('#edu-grade').val().trim();
            const activities = $('#edu-activities').val().trim();
            const description = $('#edu-description').val().trim();
            var skills = [];

            $('#skills div h6').each(function () {
                skills.push($(this).text().trim());
            });

            if (school && degree && field && start_month != "Month" && start_year != "Year" &&
                end_month != "Month" && end_year != "Year" && grade && activities && description) {
                const formData = new FormData();
                formData.append('school', school);
                formData.append('degree', degree);
                formData.append('field', field);
                formData.append('start-month', start_month);
                formData.append('start-year', start_year);
                formData.append('end-month', end_month);
                formData.append('end-year', end_year);
                formData.append('grade', grade);
                formData.append('activities', activities);
                formData.append('description', description);
                formData.append('skills', skills);

                $.ajax({
                    url: '/education/add',
                    data: formData,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        const regex = /\[(.*?)\]/g;
                        const matches = response.matchAll(regex);
                        var id = 0;
                        for (const match of matches) {
                            id = match[1].split(",");
                        }
                        $('#school').append(`<option value="${id}">${school}</option>`);
                        $('#editEducation').modal('hide');
                        $('#editProfile').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.log("ERROR: " + error);
                    }
                });
            } else {
                $('#alert').removeClass('d-none');
            }
        });

        $('#edu-school').on("keydown", function (evt) {
            if (evt.key == "Backspace") {
                const tmp = $('#edu-school').val();
                schoolName = tmp.slice(0, tmp.length - 1);
            } else if (evt.key === "Shift" || evt.key === "Alt") {

            } else {
                schoolName += evt.key;
            }

            const matchingElements = $.grep(universities, function (element) {
                return element.toLowerCase().includes(schoolName.toLowerCase()) ||
                    element.toLowerCase().startsWith(schoolName.toLowerCase()) ||
                    element.toLowerCase().endsWith(schoolName.toLowerCase());
            });

            $('#schools').empty();
            matchingElements.forEach(university => {
                const button = $(`<li><button class="dropdown-item">${university}</button></li>`);
                button.find('button').click(function () {
                    $('#edu-school').val(university);
                });
                $('#schools').append(button);
            });
        });

        $('#edu-degree').on("keydown", function (evt) {
            if (evt.key == "Backspace") {
                const tmp = $('#edu-degree').val();
                degreeName = tmp.slice(0, tmp.length - 1);
            } else if (evt.key === "Shift" || evt.key === "Alt") {

            } else {
                degreeName += evt.key;
            }

            const matchingElements = $.grep(degrees, function (element) {
                return element.toLowerCase().includes(degreeName.toLowerCase()) ||
                    element.toLowerCase().startsWith(degreeName.toLowerCase()) ||
                    element.toLowerCase().endsWith(degreeName.toLowerCase());
            });

            $('#degrees').empty();
            matchingElements.forEach(degree => {
                const button = $(`<li><button class="dropdown-item">${degree}</button></li>`);
                button.find('button').click(function () {
                    $('#edu-degree').val(degree);
                });
                $('#degrees').append(button);
            });
        });

        $('#edu-field').on("keydown", function (evt) {
            if (evt.key == "Backspace") {
                const tmp = $('#edu-field').val();
                fieldName = tmp.slice(0, tmp.length - 1);
            } else if (evt.key === "Shift" || evt.key === "Alt") {

            } else {
                fieldName += evt.key;
            }

            const matchingElements = $.grep(fields, function (element) {
                return element.toLowerCase().includes(fieldName.toLowerCase()) ||
                    element.toLowerCase().startsWith(fieldName.toLowerCase()) ||
                    element.toLowerCase().endsWith(fieldName.toLowerCase());
            });

            $('#edu-fields').empty();
            matchingElements.forEach(field => {
                const button = $(`<li><button class="dropdown-item">${field}</button></li>`);
                button.find('button').click(function () {
                    $('#edu-field').val(field);
                });
                $('#edu-fields').append(button);
            });
        });

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