<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'skill';
?>
<div class="container-fluid w-100 mt-5 bg-white" style="margin: 0; padding: 0;">
    <div class="d-flex">
        <nav class="bg-light min-vh-100">
            <div class="m-5">
                <img src="/assets/images/user/<?php echo $_SESSION['profile']; ?>" class="rounded-circle" width="150" height="150" alt="">
                <h5 class="mt-3 mb-2 text-center"><?php echo ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']); ?></h5>
                <h5 class="text-center">Admin</h5>
            </div>
            <div class="d-flex m-3 flex-column">
                <?php 
                if ($page == 'skill') {
                ?>
                <a href="?page=skill" class="text-decoration-none fs-6 btn btn-primary text-start mb-3">
                    <i class="fa fa-wrench"></i>&nbsp;Skills</a>
                <?php
                } else {
                ?>
                <a href="?page=skill" class="text-decoration-none fs-6 text-start mb-3" style="color:#33a5ff;">
                    <i class="fa fa-wrench"></i>&nbsp;Skills</a>
                <?php
                }
                ?>
                <?php
                if ($page == 'university') {
                ?>
                <a href="?page=university" class="text-decoration-none fs-6 btn btn-primary text-start mb-3">
                    <i class="fa fa-building"></i>&nbsp;Universities</a>
                <?php
                } else {
                ?>
                <a href="?page=university" class="text-decoration-none fs-6 text-start mb-3" style="color:#33a5ff;">
                    <i class="fa fa-building"></i>&nbsp;Universities</a>
                <?php
                }
                ?>
                <?php
                if ($page == 'degree') {
                ?>
                <a href="?page=degree" class="text-decoration-none fs-6 btn btn-primary text-start mb-3">
                    <i class="fa fa-graduation-cap"></i>&nbsp;Degrees</a>
                <?php
                } else {
                ?>
                <a href="?page=degree" class="text-decoration-none fs-6 text-start mb-3" style="color:#33a5ff;">
                    <i class="fa fa-graduation-cap"></i>&nbsp;Degrees</a>
                <?php
                }
                ?>
                <?php
                if ($page == 'field') {
                ?>
                <a href="?page=field" class="text-decoration-none fs-6 btn btn-primary text-start mb-3">
                    <i class="fa fa-search-plus"></i>&nbsp;Field</a>
                <?php
                } else {
                ?>
                <a href="?page=field" class="text-decoration-none fs-6 text-start mb-3" style="color:#33a5ff;">
                    <i class="fa fa-search-plus"></i>&nbsp;Field</a>
                <?php
                }
                ?>
            </div>    
        </nav>
        <div class="flex-grow-1 min-vh-100 mt-5">
            <?php
            switch ($page) {
                case 'skill':
                    include_once __DIR__ . '/manage/skill.php';
                    break;
                case 'university':
                    include_once __DIR__ .'/manage/university.php';
                    break;
                case 'degree':
                    include_once __DIR__ .'/manage/degree.php';
                    break;
                case 'field':
                    include_once __DIR__ .'/manage/field.php';
                    break;
            }
            ?>
        </div>
    </div>
</div>