<div class="container w-100">
    <div class="d-flex">
        <form action="/university/add" method="post" enctype="multipart/form-data" class="me-3 w-50">
            <div class="input-group mb-3">
                <div class="input-group-text">University&nbsp;&nbsp;&nbsp;</div>
                <input type="text" class="form-control" name="university" placeholder="Enter an university name" required>
            </div>
            <input type="file" class="form-control" name="image" required>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add University</button>
            </div>
        </form>
        <div class="container">
            <h5>University List</h5>
            <table id="universityTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>University</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $universities = $this->universityModel->getAllUniversities();
                    $i = 1;
                    while ($university = $universities->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $university['name']; ?></td>
                        <td class="col-md-3">
                            <form action="/university/del" method="post">
                                <input type="hidden" name="id" value="<?php echo $university['id']; ?>">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        new DataTable('#universityTable');
    });
</script>