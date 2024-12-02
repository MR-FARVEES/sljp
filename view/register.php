<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 mb-5 pb-5">
            <h1 class="mt-4 mb-4 text-primary text-center"><strong>Sri Lankan Job Portal</strong></h1>
            <div class="card border-light shadow">
                <div class="card-body">
                    <h2 class="card-title text-center fs-5"><strong>Create a New Account</strong></h2>
                    <p class="card-text text-center fs-6">It's quick and easy.</p>
                    <hr>
                    <form action="/register" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="firstName"
                                                placeholder="First name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="lastName" placeholder="Surename"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="dateOfBirth" class="form-label" style="font-size:12px;">Date of
                                        Birth&nbsp;<i class="fa fa-question-circle text-secondary"></i></label>
                                    <div class="row">
                                        <div class="col">
                                            <select name="day" class="form-select">
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    if ($i == 1) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>" default><?php echo $i; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="month" class="form-select">
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $monthName = date('F', mktime(0, 0, 0, $i, 1));
                                                    if ($i == 1) {
                                                        ?>
                                                        <option value="<?php if ($i < 10) {
                                                            echo '0' . $i;
                                                        } else {
                                                            echo $i;
                                                        } ?>" default><?php echo $monthName; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php if ($i < 10) {
                                                            echo '0' . $i;
                                                        } else {
                                                            echo $i;
                                                        } ?>">
                                                            <?php echo $monthName; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="year" class="form-select">
                                                <?php
                                                $currentDate = date('Y');
                                                for ($i = $currentDate; $i >= $currentDate - 100; $i--) {
                                                    if ($i == $currentDate) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>" default><?php echo $i; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="gender" class="form-label" style="font-size:12px;">Gender&nbsp;<i
                                            class="fa fa-question-circle text-secondary"></i></label>
                                    <div class="row m-1 justify-content-between">
                                        <div class="col border rounded-3 p-2 me-3">
                                            <div class="form-radio d-flex justify-content-between">
                                                <label class="form-check-label" for="genderFemale">Male</label>
                                                <input type="radio" class="form-check-input" id="genderFemale"
                                                    name="gender" value="female">
                                            </div>
                                        </div>
                                        <div class="col border rounded-3 p-2">
                                            <div class="form-radio d-flex justify-content-between">
                                                <label class="form-check-label" for="genderMale">Female</label>
                                                <input type="radio" class="form-check-input" id="genderMale"
                                                    name="gender" value="male">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="email" placeholder="Email address" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                                <div class="mb-2">
                                    <input type="password" class="form-control" name="password" placeholder="New password" required>
                                </div>
                                <div class="mb-2">
                                    <label for="dateOfBirth" class="form-label" style="font-size:12px;">Profile Picture
                                        &nbsp;<i class="fa fa-question-circle text-secondary"></i></label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">+94</span>
                                    <input type="number" class="form-control" placeholder="Contact" name="contact"
                                        aria-describedby="basic-addon1" required>
                                </div>
                                <div class="mb-2">
                                    <input name="" class="form-control" name="nic" placeholder="NIC" required>
                                </div>
                                <div class="mb-2">
                                    <textarea name="" class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                                </div>
                                <div class="mb-2">
                                    <select name="role" class="form-select">
                                        <option value="seeker" default>Seeker</option>
                                        <option value="provider">Porvider</option>
                                    </select>
                                </div>
                                <div class="mb-2 ms-2">
                                    <lable class="text-break" style="font-family:sans-serif;font-size: 12px;">By
                                        clicking Sign Up, you agree to our Terms,
                                        Privacy Policy and Cookies Policy. You may receive SMS notifications from us and
                                        can opt
                                        out at any time.</small>

                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" name="SignUp" class="btn btn-success col-md-5">Sign Up</button>
                                </div>
                                <p class="text-center mt-2"><a href="#" class="text-decoration-none fs-5">Already have
                                        an account?</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>