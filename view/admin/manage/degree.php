<div class="container w-100">
    <div class="d-flex">
        <form action="/degree/add" method="post" enctype="multipart/form-data" class="me-3 w-50">
            <div class="input-group mb-3">
                <div class="input-group-text">Degree&nbsp;&nbsp;&nbsp;</div>
                <input type="text" class="form-control" name="degree" placeholder="Enter degree" required>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add Degree</button>
            </div>
        </form>
        <div class="container">
            <h5>Degree List</h5>
            <table id="universityTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Degree</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $degrees = $this->degreeModel->getAllDegrees();
                    $i = 1;
                    while ($degree = $degrees->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $degree['title']; ?></td>
                        <td class="col-md-3">
                            <form action="/degree/del" method="post">
                                <input type="hidden" name="id" value="<?php echo $degree['id']; ?>">
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