<div class="container ms-5 me-5">
    <div class="d-flex p-5">
        <div class="me-3">
            <div class="card shadow-sm mt-5 ms-5" style="min-width: 60rem;">
                <img class="card-img-top" height="240" src="/assets/images/cover/<?php echo $user_info['cover']; ?>"
                    alt="Title" />
                <div class="rounded-circle"
                    style="margin-left:20px;margin-top:-140px;width: 186px;height: 186px;background:#fff;padding:3px;">
                    <img class="rounded-circle" width="180" height="180"
                        src="/assets/images/user/<?php echo $user_info['profile']; ?>" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn" style="margin-top:-50px;" data-bs-toggle="modal"
                            data-bs-target="#editProfile">
                            <i class="fa fa-pencil fs-5"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">
                            <?php echo ucfirst($user_info['first']) . " " . ucfirst($user_info['last']); ?>&nbsp;
                            <span class=" text-secondary border p-1 pe-2 ps-2 border-secondary rounded-5"
                                style="font-size:12px;">
                                <i class="fa fa-shield"></i>&nbsp;verify now</span>
                        </h5>
                        <div>
                            <div class="d-flex justify-content-between">
                                <img src="/assets/images/cover/<?php echo $user_info['cover']; ?>" width="50"
                                    height="50" class="rounded-circle" alt="">
                                <p class="text-wrap w-75">
                                    University of Kelaniya Sri Lanka
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="card-text text-wrap">
                        <small>Occupation tags | tag 2 | tag 3 | tag 4</small><br>
                        <small>addr</small><br>
                        <small>uni</small>
                    </p>
                </div>
            </div>
        </div>
        <div>
            <div class="card align-self-start mt-5 shadow-sm" style="min-width:22rem;">
                <img class="card-img-top" height="100" src="/assets/images/cover/<?php echo $_SESSION['cover']; ?>"
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
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="editProfile">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
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
                        while ($row = $educations->fetch_assoc()) {
                            $res = $uniModel->getUniversity($row['institude']);
                            $university = null;
                            while ($nrow = $res->fetch_assoc()) {
                                $university = $nrow['institude'];
                            }
                            if ($i == 0) {
                                ?>
                                <option value="<?php echo $university; ?>" default><?php echo $university; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $university; ?>"><?php echo $university; ?></option>
                                <?php
                            }
                            $i++;
                        }
                        if ($i == 0) {
                            ?>
                            <option value="Please Select" default>Please Select</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn text-primary btn-hover" data-bs-toggle="modal" data-bs-target="#editEducation"><i
                            class="fa fa-plus"></i>&nbsp;Add new education</button>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="show-school" name="show-shool" class="form-check-input"
                        style="transform:scale(1.2);">
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
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="editEducation">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="modal-title">Add Education</h5>
                    <button class="btn btn-close" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#editProfile"></button>
                </div>
            </div>
            <div class="modal-body" style="max-height: 500px;">
                <h6 class="fw-light">* indicates required</h6>
                <div class="mb-3">
                    <div class="alert alert-warning" role="alert">
                        A simple warning alert—check it out!
                    </div>
                    <label for="edu-school">School*</label>
                    <input type="text" class="form-control" id="edu-school" placeholder="Ex: University of Kelaniya"
                        required>
                </div>
                <div class="mb-3">
                    <label for="edu-degree">Degree*</label>
                    <input type="text" class="form-control" id="edu-degree" placeholder="Ex: Batchelor's" required>
                </div>
                <div class="mb-3">
                    <label for="edu-field">Field of study*</label>
                    <input type="text" class="form-control" id="edu-field" placeholder="Ex: Computing Technology"
                        required>
                </div>
                <div class="mb-3">
                    <label for="">Start date*</label>
                    <div class="d-flex">
                        <select id="edu-start-month" class="form-select me-3" area-hidden="true">
                            <option value="month" default>Month</option>
                        </select>
                        <select id="edu-start-year" class="form-select" area-hidden="true">
                            <option value="year" default>Year</option>
                        </select>
                    </div>
                </div>
                <div class="mb-">
                    <label for="">End date*</label>
                    <div class="d-flex">
                        <select id="edu-end-month" class="form-select me-3" area-hidden="true">
                            <option value="month" default>Month</option>
                        </select>
                        <select id="edu-end-year" class="form-select" area-hidden="true">
                            <option value="year" default>Year</option>
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
                <p>We recommend adding your top 5 used in this experience. They’ll also appear in your Skills section.
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

<script>
    $(document).ready(function () {
        var skills = [];
        var userInput = "";

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

            if (school && degree && field && start_month != "Month" && start_year != "Year" &&
                end_month != "Month" && end_year != "Year" && grade && activities && description) {
                const formData = new FormData();
                formData.append('school', school);
                formData.append('degree', degree);
                formData.append('field', field);
                formData.append('start-month', start_month);
                formData.append('start-yeare', start_year);
                formData.append('end-month', end_month);
                formData.append('end-year', end_year);
                formData.append('grade', grade);
                formData.append('activities', activities);
                formData.append('description', description);

                $.ajax({
                    url: '/education/submit',
                    data: formData,
                    type: post,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                    },
                    error: function (xhr, status, error) {
                        console.log("ERROR: " + error);
                    }
                });
            } else {
                console.log("some fields are required");
            }
        });
    });
</script>