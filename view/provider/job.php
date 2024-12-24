<div class="container-fluid min-vh-100 bg-light">
    <div class="d-flex justify-content-center">
        <div class="w-75 mt-5 pt-5">
            <div class="row g-3">
                <?php
                $i = 0;
                $company_id = 0;
                $companies = $this->companyModel->getCompany($_SESSION['id']);
                while ($company = $companies->fetch_assoc()) {
                    $company_id = $company['id'];
                    ?>
                    <div class="col-12 col-md-9">
                        <div class="card mb-3">
                            <img src="/assets/images/cover/<?php echo $company['cover']; ?>" class="card-img-top"
                                height="250" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Post a new job for <span
                                        class="text-primary fw-bold"><?php echo $company['name']; ?></span></h5>
                                <div class="d-flex justify-content-end">
                                    <a href="/provider/job/applicant?company=<?php echo $company['id']; ?>" class="btn btn-primary col-md-3 me-2"><i
                                            class="fa fa-eye"></i>&nbsp;See all
                                        applicants</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#postJob"
                                        class="btn btn-success col-md-3"><i class="fa fa-briefcase"></i>&nbsp;Post new
                                        Job</button>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Manage job posts</h5>
                                <table class="table table-bubble" id="jobList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job</th>
                                            <th>Vacancy</th>
                                            <th>Posted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $j = 0;
                                        $jobs = $this->jobModel->getAllJobs($company['id']);
                                        while ($job = $jobs->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$j ?></td>
                                                <td><?php echo htmlspecialchars($job['title']); ?></td>
                                                <td><?php echo htmlspecialchars($job['vacancy']); ?></td>
                                                <td><?php echo date('M d Y', strtotime($job['posted_at'])); ?></td>
                                                <td class="col-md-4">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#update-skill-<?php echo $job['id']; ?>"
                                                        class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;Update
                                                        skills</button>
                                                    <button class="btn btn-danger"><i
                                                            class="fa fa-trash"></i>&nbsp;Remove</button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                if ($i == 0) {
                    ?>
                    <?php
                }
                ?>
                <div class="col-12 col-md-3">
                    <div class="card col-12">
                        <div class="card-header">
                            <h5 class="card-title">My Company</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $i = 0;
                            $companies = $this->companyModel->getCompany($_SESSION['id']);
                            while ($company = $companies->fetch_assoc()) {
                                ?>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <img src="/assets/images/company/logo/<?php echo $company['logo']; ?>"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="hidden" id="company_id" value="<?php echo $company['id']; ?>">
                                        <p class="fs-6 fw-bold m-0"><?php echo $company['name']; ?></p>
                                        <p class="text-muted fs-6 m-0"><?php echo $company['location']; ?></p>
                                        <p class="text-muted"><small>Started from
                                                <?php echo $company['founded_at']; ?></small></p>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                            if ($i == 0) {
                                ?>
                                <p class="card-text text-muted text-center">You haven't update yet!</p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-outline-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#companyModal"><i class="fa fa-refresh"></i>&nbsp;Update
                                        Company</button>
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
<div class="modal" id="postJob">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Post a new job</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pb-2" style="max-height: 75vh; overflow-y: auto;">
                <div class="row">
                    <div class="mb-2 col-12 col-md-6">
                        <label for="title">Job title*</label>
                        <input type="text" id="title" class="form-control" name="title">
                    </div>
                    <div class="mb-2 col-12 col-md-6">
                        <label for="location">Location*</label>
                        <input type="text" id="location" class="form-control" name="location">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-2">
                        <label for="place">Workplace*</label>
                        <select name="place" class="form-select" id="place">
                            <option value="On-Site">On-Site</option>
                            <option value="Remote">Remote</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <label for="type">Job type*</label>
                        <select name="type" class="form-select" id="type">
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Internship">Internship</option>
                            <option value="Contract">Contract</option>
                            <option value="Temporary">Temporary</option>
                            <option value="Volenteer">Volenteer</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col-12 col-md-6">
                        <label for="salary">Salary*</label>
                        <input type="number" class="form-control" name="salary" id="salary">
                    </div>
                    <div class="mb-2 col-12 col-md-6">
                        <label for="vacancy">Salary*</label>
                        <input type="number" class="form-control" name="vacancy" id="vancancy">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="description">Description*</label>
                        <div class="border-2 border-secondary">
                            <div id="editor" class="overflow-auto mb-2" style="max-height:100vh;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="skills">Skill Requirements*</label>
                        <div class="dropdown">
                            <div class="dropdown d-flex justify-content-between">
                                <input type="text" id="skill-input" data-bs-toggle="dropdown" class="form-control me-2"
                                    placeholder="Enter Skill">
                                <button class="btn btn-primary" style="width:100px;" id="addSkill">
                                    <i class="fa fa-plus"></i>&nbsp;Add
                                </button>
                                <ul class="dropdown-menu w-100 p-0" id="jobSkills">

                                </ul>
                            </div>
                        </div>
                        <table class="table table-striped" id="skillTable">
                            <thead>
                                <tr>
                                    <th>Skill</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary rounded-5" type="button" id="send"><i
                        class="fa fa-plus"></i>&nbsp;Post</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="companyModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new company</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/company/add" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-text w-25">Name</div>
                        <input type="text" name="name" class="form-control" placeholder="Enter company name" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text w-25">Location</div>
                        <input type="text" name="location" class="form-control" placeholder="Enter where your location"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text w-25">Industry</div>
                        <input type="text" name="industry" class="form-control" placeholder="Enter your industry"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text w-25">Website</div>
                        <input type="text" name="website" class="form-control" placeholder="Enter your website"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="cover">Cover Picture*</label>
                        <input type="file" id="cover" name="cover" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo">Logo*</label>
                        <input type="file" id="logo" name="logo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary rounded-5"><i class="fa fa-plus"></i>&nbsp;Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$jobs = $this->jobModel->getAllJobs($company_id);
while ($job = $jobs->fetch_assoc()) {
    ?>
    <div class="modal" id="update-skill-<?php echo $job['id']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Job Skills</h5>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body overflow-auto" style="max-height: 60vh;">
                    <form action=""></form>
                    <table class="table table-striped" id="updateSkillTable">
                        <thead>
                            <tr>
                                <th>Skill</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $skills = $this->jobSkillModel->getJobSkills($job['id']);
                            $i = 0;
                            while ($skill = $skills->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $skill['skill']; ?></td>
                                    <td><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            if ($i == 0) {
                                ?>
                                <tr>
                                    <td colspan="3">Not available</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-body">
                    <div class="d-flex w-100">
                        <div class="dropdown w-100 me-2">
                            <input type="text" id="new-skill-<?php echo $job['id']; ?>" data-bs-toggle="dropdown"
                                class="form-control" placeholder="Enter skill">
                            <ul id="newSkills-<?php echo $job['id']; ?>" class="dropdown-menu w-100 overflow-auto"
                                style="max-height:300px;"></ul>
                        </div>
                        <button class="btn btn-primary me-2" style="width:100px;"
                            id="add-skill-<?php echo $job['id']; ?>"><i class="fa fa-plus"></i>&nbsp;Add</button>
                        <button class="btn btn-primary" style="width:150px;" id="update-skills-<?php echo $job['id']; ?>"><i
                                class="fa fa-refresh"></i>&nbsp;Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<script>
    $(document).ready(function () {
        $('#jobList').DataTable({
            autoWidth: false,
            columnDefs: [
                { targets: '_all', defaultContent: '' }
            ]
        });
        $('#skillTable').DataTable();
        const print = (data) => {
            console.log(data);
        }
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
        var jobs = [];
        var skills = [];
        var query = "";
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
        $('#skill-input').on('keydown', (event) => {
            if (event.key == 'Alt' || event.key == 'Ctrl') {
            } else if (event.key == 'Backspace') {
                const temp = $('#skill-input').val();
                query = temp.slice(0, temp.length - 1);
            } else {
                query += event.key;
            }
            const matchingElements = $.grep(skills, (element) => {
                if (element) {
                    return element.toLowerCase().startsWith(query.toLowerCase()) ||
                        element.toLowerCase().endsWith(query.toLowerCase());
                }
            });
            $('#jobSkills').empty();
            matchingElements.forEach((skill) => {
                const view = $(`
                    <li class="hover p-2">${skill}</li>
                `);
                view.click(() => {
                    $('#skill-input').val(skill);
                });
                $('#jobSkills').append(view);
            });
        });
        $('#addSkill').click(() => {
            if ($('#skill-input').val()) {
                const tr = $(`
                    <tr>
                        <td class="col-md-8">${$('#skill-input').val()}</td>
                        <td class="col-md-4"><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button></td>
                    </tr>
                `);
                $('#skillTable').find('tbody').append(tr);
                tr.find('button').click(() => {
                    tr.remove();
                })
                $('#skill-input').val('');
            }
        });
        $('[id^=new-skill-]').on('keydown', (event) => {
            const id = $(event.target).attr('id').split('-')[2];
            if (event.key == 'Alt' || event.key == 'Ctrl') {
            } else if (event.key == 'Backspace') {
                const temp = $('#new-skill-' + id).val();
                query = temp.slice(0, temp.length - 1);
            } else {
                query += event.key;
            }
            const matchingElements = $.grep(skills, (element) => {
                if (element) {
                    return element.toLowerCase().startsWith(query.toLowerCase()) ||
                        element.toLowerCase().endsWith(query.toLowerCase());
                }
            });
            print(id);
            $('#newSkills-' + id).empty();
            matchingElements.forEach((skill) => {
                const view = $(`
                    <li class="hover p-2">${skill}</li>
                `);
                view.click(() => {
                    $('#new-skill-' + id).val(skill);
                });
                $('#newSkills-' + id).append(view);
            });
        });
        $('[id^=add-skill-]').on('click', (event) => {
            const id = $(event.target).attr('id').split('-')[2];
            const skill = $('#new-skill-' + id).val();
            if (skill) {
                var found = false;
                $('#updateSkillTable').find('tbody tr').each((id, element) => {
                    if ($(element).children().length > 1) {
                        if ($($(element).children()[0]).text() == skill) {
                            found = true;
                        }
                    }
                });
                const tr = $(`
                    <tr>
                        <td class="col-md-8">${skill}</td>
                        <td class="col-md-4"><button class="btn btn-danger" id="remove-skill"><i class="fa fa-trash"></i>&nbsp;Remove</button></td>
                    </tr>
                `);
                if (!found) {
                    $('#updateSkillTable').find('tbody').append(tr);
                }
                $('#new-skill-' + id).val('');
            }
        });
        $('#updateSkillTable').find('tbody tr').each((id, element) => {
            if ($(element).children().length > 1) {
                $($(element).children()[1]).find('button').click(() => {
                    $(element).remove();
                });
            }
        });
        $('[id^=update-skills-]').click((event) => {
            const id = $(event.target).attr('id').split('-')[2];
            const skillList = [];
            $('#updateSkillTable').find('tbody tr').each((id, element) => {
                if ($(element).children().length > 1) {
                    skillList.push($($(element).children()[0]).text());
                }
            });
            const formData = new FormData();
            formData.append('job_id', id);
            formData.append('skills', JSON.stringify(skillList));
            $.ajax({
                url: '/provider/job/skill/update',
                data: formData,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    window.location.reload(true);
                },
                error: function (xhr, status, error) {
                    print('ERROR: ' + error);
                }
            });
        });
        $('#send').click(() => {
            const title = $('#title').val();
            const location = $('#location').val();
            const place = $('#place').val();
            const vacancy = $('#vancancy').val();
            const type = $('#type').val();
            const salary = $('#salary').val();
            const company_id = $('#company_id').val();
            const description = quill.getSemanticHTML();
            const skillList = [];
            $('#skillTable').find('tbody tr').each((id, element) => {
                if ($(element).children().length > 1) {
                    skillList.push($($(element).children()[0]).text());
                }
            });

            const formData = new FormData();
            formData.append('title', title);
            formData.append('location', location);
            formData.append('place', place);
            formData.append('type', type);
            formData.append('salary', salary);
            formData.append('description', description);
            formData.append('company_id', company_id);
            formData.append('vacancy', vacancy);
            formData.append('skills', JSON.stringify(skillList));

            $.ajax({
                url: '/provider/job/add',
                data: formData,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    window.location.reload(true);
                },
                error: function (xhr, status, error) {
                    print('ERROR: ' + error);
                }
            });

            $('#title').val('');
            $('#location').val('');
            $('#place').val('');
            $('#type').val('');
            $('#salary').val('');
            $('#skillTable').find('tbody').empty();
            print(skillList);
        });
    });
</script>