<div class="container-fluid mt-5 bg-light">
    <div class="p-5">
        <div class="d-flex">
            <div>
                <div class="card me-3 align-self-start shadow-sm" style="width: 16rem;">
                    <img class="card-img-top" height="100" src="assets/images/cover/<?php echo $_SESSION['cover']; ?>"
                        alt="Title" />
                    <div
                        style="margin-left:20px;margin-top:-60px;border-radius:60px;width: 120px;height: 120px;background:#fff;padding:4px;">
                        <img style="border-radius:55px;" width="112" height="112"
                            src="assets/images/user/<?php echo $_SESSION['profile']; ?>" alt="Title" />
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
                <div class="card me-2 mt-2 shadow-sm align-self-start" style="width: 16rem;">
                    <div class="card-body">
                        <h4 class="card-title">Try Premium</h4>
                        <p class="card-text text-wrap">Occupation tags | tag 2 | tag 3 | tag 4</p>
                    </div>
                </div>
                <div class="card me-2 mt-2 shadow-sm align-self-start" style="width: 16rem;">
                    <div class="card-body">
                        <p class="card-text"><i class="fa fa-users"></i>&nbsp;Groups</p>
                        <p class="card-text"><i class="fa fa-calendar"></i>&nbsp;Events</p>
                        <p class="card-text"><i class="fa fa-newspaper" area-hidden="true"></i>&nbsp;Newsletters</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 me-3">
                <div class="card col-md-12 align-self-start shadow-sm mb-3">
                    <img class="card-img-top" height="200" src="assets/images/cover/<?php echo $_SESSION['cover']; ?>"
                        alt="Title" />
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Hi <?php echo $_SESSION['fname']; ?>, are you looking
                            for
                            a job right now?<br><small class="fs-6 fw-light text-secondary">your response is only
                                visible to you.</small></smal>
                        </h4>
                        <div class="row">
                            <div class="col">
                                <button
                                    class="col-md-12 border-m border-primary text-primary bg-white rounded-5 p-1">Yes</button>
                            </div>
                            <div class="col">
                                <button
                                    class="col-md-12 border-m border-primary text-primary bg-white rounded-5 p-1">No,
                                    but I'm open</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-12 align-self-start shadow-sm mb-3">
                    <div class="card-body d-flex">
                        <img style="border-radius:25px;" width="50" height="50"
                            src="assets/images/user/<?php echo $_SESSION['profile']; ?>" alt="Title" />
                        <input class="form-control ms-5 rounded-5" type="text" value="Create a post with your content"
                            data-bs-toggle="modal" data-bs-target="#newPost" readonly>
                    </div>

                    <div class="d-flex">
                        <p class="card-text col-md-4 me-1 text-center"><i
                                class="fa fa-image text-primary"></i>&nbsp;Media</p>
                        <p class="card-text col-md-4 me-1 text-center"><i
                                class="fa fa-calendar text-warning"></i>&nbsp;Event</p>
                        <p class="card-text col-md-4 text-center"><i class="fa fa-newspaper text-danger"></i>&nbsp;Write
                            Article</p>
                    </div>
                </div>
            </div>

            <div class="card col-md-3 align-self-start shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Add your feed</h4>
                        <i class="fa fa-info-circle fs-5 p-2"></i>
                    </div>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newPost">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>