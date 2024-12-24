<div class="card position-fixed bottom-0 end-0 p-0" style="min-width:21rem;">
    <div class="card-header d-flex justify-content-between p-0 bg-white">
        <button class="btn w-100 collapsed text-decoration-none text-black d-flex justify-content-between fs-5 m-0"
            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
            aria-controls="collapseOne">
            <div class="d-flex">
                <div class="position-relative">
                    <img src="/assets/images/user/<?php echo $_SESSION['profile']; ?>" width="35" height="35"
                        class="rounded-circle me-2" alt="user-image">
                    <span
                        class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-light rounded-circle"></span>
                </div>
                <h6 class="card-title me-2 pt-1 ps-1">messaging</h6>
            </div>
            <p><span class="arrow-icon"><i class="fa-solid fa-angle-down"></i></span></p>
        </button>
    </div>
    <div id="collapseOne" class="collapse w-100" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="card-body p-2">
            <div class="input-group">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
                <input type="text" id="search-friend" class="form-control" placeholder="Search friend by name">
            </div>
        </div>
        <hr class="m-0">
        <div class="card-body p-2" style="min-height:50vh;">
            <div class="w-100">
                <input type="hidden" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" id="profile_image" value="<?php echo $_SESSION['profile']; ?>">
                <?php
                $followers = $this->followerModel->getAllFollowers($_SESSION['id']);
                while ($follower = $followers->fetch_assoc()) {
                    $users = $this->userModel->getUserInfo($follower['follow_id']);
                    while ($user = $users->fetch_assoc()) {
                        ?>
                        <div class="d-flex p-2" id="message-<?php echo $user['id']; ?>">
                            <img src="/assets/images/user/<?php echo $user['profile']; ?>" alt="" class="rounded-circle"
                                width="50" height="50">
                            <p class="fs-6 ms-3 mt-2"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?></p>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$followers = $this->followerModel->getAllFollowers($_SESSION['id']);
while ($follower = $followers->fetch_assoc()) {
    $users = $this->userModel->getUserInfo($follower['follow_id']);
    while ($user = $users->fetch_assoc()) {
        ?>
        <div id="conversation-<?php echo $user['id']; ?>" class="card d-none position-fixed bottom-0 end-0 zindex-1000"
            style="margin-right:22rem;min-width:40rem;min-height:60vh;">
            <div class="card-header w-100 d-flex justify-content-between bg-white">
                <div class="d-flex">
                    <div class="position-relative">
                        <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="35" height="35"
                            class="rounded-circle me-2" alt="user-image">
                    </div>
                    <h6 class="card-title me-2 pt-1 ps-1 fs-6"><a
                            href="/seeker/profile?id=<?php echo $user['id']; ?>"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?></a>
                    </h6>
                </div>
                <button class="btn btn-close" id="close_conversation-<?php echo $user['id']; ?>"></button>
            </div>
            <div class="card-body overflow-auto" style="max-height: 50vh;">
                <div class="start-0">
                    <img src="/assets/images/user/<?php echo $user['profile']; ?>" width="60" height=60" class="rounded-circle"
                        alt="">
                    <h5 class="card-title me-2 pt-1 ps-1"><?php echo ucfirst($user['first']) . " " . ucfirst($user['last']); ?>
                    </h5>
                    <p class="text-muted text-wrap w-75">
                        <?php
                        if ($user['headline'] != 'N/A') {
                            echo $user['headline'];
                        } else {
                            echo '<small class="text-muted">No headines&nbsp;&nbsp;</small>';
                        }
                        ?>
                    </p>
                </div>
                <hr>
                <div class="w-100" id="message-container-<?php echo $user['id']; ?>">
                </div>
            </div>
            <div class="card-footer">
                <textarea id="text-message-<?php echo $user['id']; ?>" placeholder="Write some message"
                    class="form-control mb-2" rows="3"></textarea>
                <div class="d-flex justify-content-end">
                    <button id="send-message-<?php echo $user['id']; ?>" type="button" class="btn btn-primary disabled"><i
                            class="fa fa-paper-plane"></i>&nbsp;Send</button>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<script>
    $(document).ready(function () {
        $('[id^=close_conversation-]').click(function () {
            const id = $(this).attr('id').split('-')[1];
            $('#conversation-' + id).toggleClass('d-none');
        });
        $('[id^=message-]').click(function () {
            const id = $(this).attr('id').split('-')[1];
            $('[id^=conversation-]').each(function () {
                $(this).addClass('d-none');
            });
            $('#conversation-' + id).toggleClass('d-none');
        });
        $('[id^=text-message-]').on('input', function () {
            const id = $(this).attr('id').split('-')[2];
            const msg = $(this).val();
            if (msg) {
                $('#send-message-' + id).removeClass('disabled');
            } else {
                $('#send-message-' + id).addClass('disabled');
            }
        });
        $('[id^=send-message-]').click(function () {
            const id = $(this).attr('id').split('-')[2];
            const formData = new FormData();
            formData.append('user_id', id);
            formData.append('message', $("#text-message-" + id).val());
            $.ajax({
                url: '/user/message/send',
                data: formData,
                type: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#text-message-" + id).val('');
                },
                error: function (xhr, status, error) {
                    console.log('ERROR: ' + error);
                }
            });
        });
        const message_structure = [];
        function updateMessages() {
            $('[id^=message-container-]').each(function () {
                const id = $(this).attr('id').split('-')[2];
                const idAttr = $(this).attr('id');
                const existingItem = message_structure.find(item => item.hasOwnProperty(idAttr));
                if (!existingItem) {
                    message_structure.push({ [idAttr]: [] });
                }
                const myId = $('#user_id').val();
                const formData = new FormData();
                formData.append('user_id', id);
                $.ajax({
                    url: '/user/message/all',
                    data: formData,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        const regex = /\[(.*?)\]/g;
                        const matches = response.matchAll(regex);
                        for (const match of matches) {
                            $.each(match[1].split('<#>'), function (index, element) {
                                if (element) {
                                    const msg_info = element.split('<>');
                                    const msg_view = $(`
                                        <div>
                                            <div class="d-flex justify-content-start" id="profile">
                                            </div>
                                        </div>
                                    `);
                                    $.each(message_structure, function (sid, sdata) {
                                        if (sdata[idAttr]) {
                                            if (!sdata[idAttr].includes(msg_info[0])) {
                                                sdata[idAttr].push(msg_info[0]);
                                                const post_view = $(`
                                                    <div class="card align-self-start shadow-sm mb-3">
                                                        <div class="p-3">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <div class="d-flex align-items-center">
                                                                    <img width="40" height="40"
                                                                        alt="User Image" class="rounded-circle" id="user-profile">
                                                                    <div class="d-flex align-items-start">
                                                                        <h1 class="card-title fs-6 fw-bold mb-0 ms-2"><a class="text-decoration-none text-black post-hover" id="user-link"></a></h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="post" class="p-2">
                                                                <input type="hidden" id="temp">
                                                                <small id="post_desc" class="text-wrap" style="font-size:14px;"></small>
                                                                <img id="post_source" class="card-img-top mt-2" alt="">                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                `);
                                                if (msg_info[1] == myId) {
                                                    const profile_pic = $(`
                                                        <img src="/assets/images/user/${$('#profile_image').val()}" class="rounded-circle me-2" width="30" height="30">
                                                        <p>Me</p>
                                                    `);
                                                    if (msg_info[5] == "post") {
                                                        const formData = new FormData();
                                                        formData.append('post_id', msg_info[3]);
                                                        $.ajax({
                                                            url:'/user/repost/data',
                                                            data:formData,
                                                            type:'post',
                                                            contentType:false,
                                                            processData:false,
                                                            success:(res) => {
                                                                const regex = /\[(.*?)\]/g;
                                                                const matches = res.matchAll(regex);
                                                                for (const match of matches) {
                                                                    $.each(match[1].split('<#>'), function (idx, value) {
                                                                        if (value) {
                                                                            const post_info = value.split('<>');
                                                                            post_view.css({
                                                                                "max-width":"30rem"
                                                                            });
                                                                            post_view.find('#user-profile').replaceWith(() => {
                                                                                return $('<img>', {
                                                                                    id: "msger-profile",
                                                                                    src: "/assets/images/user/"+post_info[0],
                                                                                    width: "30",
                                                                                    height: "30",
                                                                                    class: "rounded-circle"
                                                                                });
                                                                            });
                                                                            post_view.find('#user-link').replaceWith(() => {
                                                                                return $('<a>', {
                                                                                    id: "user_link",
                                                                                    href: "/search/result?id="+post_info[5],
                                                                                    text: post_info[1],
                                                                                    class: "text-decoration-none text-black post-hover"
                                                                                });
                                                                            });
                                                                            post_view.find('#post_desc').html(post_info[2]);
                                                                            post_view.find('#post_source').replaceWith(() => {
                                                                            return $('<img>', {
                                                                                id: "repost_source",
                                                                                src: "/assets/images/post/"+post_info[3],
                                                                                class: "card-img-top mt-2"
                                                                            });
                                                                        });
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        });
                                                        const ctr = $('<div class="d-flex justify-content-center"></div>');
                                                        ctr.append(post_view);
                                                        msg_view.append(ctr);
                                                        msg_view.find('#profile').append(profile_pic);
                                                        $('#message-container-' + id).append(msg_view);
                                                    } else {
                                                        msg_view.append(`<p class="text-muted text-wrap fs-6" style="margin-left:35px;">${msg_info[3]}</p>`);
                                                        msg_view.find('#profile').append(profile_pic);
                                                        $('#message-container-' + id).append(msg_view);
                                                    }
                                                } else {
                                                    const profile_pic = $(`
                                                        <img src="/assets/images/user/${msg_info[6]}" class="rounded-circle me-2" width="30" height="30" >
                                                        <p>${msg_info[7]}</p>
                                                    `);
                                                    if (msg_info[5] == "post") {

                                                    } else {
                                                        msg_view.append(`<p class="text-muted text-wrap fs-6" style="margin-left:35px;">${msg_info[3]}</p>`);
                                                        msg_view.find('#profile').append(profile_pic);
                                                        $('#message-container-' + id).append(msg_view);
                                                    }
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('ERROR: ' + error);
                    }
                });

            });
        }
        setInterval(updateMessages, 1000);
    });
</script>