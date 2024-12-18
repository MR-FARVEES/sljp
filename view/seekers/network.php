<div class="container-fluid bg-light mt-5 w-100 d-flex justify-content-center">
    <div class="row w-75 g-4 mt-1">
        <div class="col-md-4">
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
        </div>
        <div class="col-12 col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <div class="d-flex">
                        <h5 class="card-title fw-light">Invitations</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="/assets/images/user/<?php echo $_SESSION['profile']; ?>" width="60" height="60"
                                class="rounded-circle" alt="">
                            <div>
                                <h6 class="fw-light mt-3 ms-3">Newsletter</h6>
                                <p class="fs-6 ms-3">Alex Xu invited you to subscribe to ByteByteGo Newsletter</p>
                            </div>
                        </div>
                        <div class="d-flex mt-4" style="max-height: 40px;">
                            <button class="btn border-secondary rounded-5 text-secondary me-2">Ignore</button>
                            <button class="btn border-primary rounded-5 text-primary">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fw-light">Achieve your goals faster with premium</h5>
                        <button class="btn btn-close"></button>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-warning rounded-5 text-danger">Try Premium for LKR0</button><br>
                    <small>1-month free trial. We’ll remind you 7 days before your trial ends.</small>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title fw-light">People you may know based on your recent activity</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title fw-light">People you may know from University of Kelaniya Sri Lanka</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title fw-light">Popular people to follow across SLJP</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>