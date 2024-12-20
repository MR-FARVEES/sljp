<div class="container-fluid mt-5 w-100 min-vh-100">
    <div class="d-flex justify-content-center">
        <div class="card w-50 m-5">
            <div class="card-header bg-white">
                <h5 class="text-muted fw-light">4 Connections</h5>
                <div class="d-flex justify-content-between">
                    <div class="input-group me-5">
                        <div class="input-group-text">Sort by</div>
                        <select id="sort-by" class="form-select">
                            <option value="first">First name</option>
                            <option value="last">last name</option>
                            <option value="recent" selected>Recently Added</option>
                        </select>
                    </div>
                    <div class="input-group ms-5">
                        <input type="text" id="search-connection" placeholder="Search by name" class="form-control">
                        <button class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h6 class="fs-6 text-muted">There is no connections!</h6>
                </div>
            </div>
        </div>
    </div>
</div>