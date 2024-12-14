<div class="container w-100">
    <div class="d-flex">
        <form action="/skill/add" method="post" class="ms-3 w-50">
            <h5>Create Skill</h5>
            <div class="input-group mb-3">
                <div class="input-group-text">Create new skill</div>
                <input type="text" name="skill" class="form-control" placeholder="Enter new skill" required>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Create Skill</button>
            </div>
        </form>
        <div class="container w-50">
            <h5>Skill List</h5>
            <table class="table table-striped" id="skillTable">
                <thead>
                    <th>#</th>
                    <th>Skill</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $skills = $this->skillModel->getAllSkills();
                    $i = 1;
                    while ($skill = $skills->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $skill['title']; ?></td>
                        <td class="col-md-3">
                            <form action="/skill/del" method="post">
                                <input type="hidden" name="id" value="<?php echo $skill["id"]; ?>">
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
       new DataTable('#skillTable');
    });
</script>