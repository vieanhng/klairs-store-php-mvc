
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10 col-xxl-4">
            <div class="text-center" style="margin-bottom: -48px;"><img src="<?=getUrl('public/assets/admin/img/logo.webp')?>" width="164" height="164" /></div>
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h5 class="fs-4 fw-bold text-dark mb-4">Đăng nhập</h5>
                        </div>
                        <form id="login-form" class="user" action="<?=getUrl('admin/users/login')?>" method="post">
                            <div class="text-dark mb-3"><label class="form-label" for=InputEmail"">Email</label><input id="InputEmail" class="form-control form-control-sm" type="email" aria-describedby="emailHelp" placeholder="Nhập email" name="email" /></div>
                            <div class="text-dark mb-3">
                                <label class="form-label" for="InputPassword">Mật khẩu</label>
                                <input id="InputPassword" class="form-control form-control-sm" type="password" placeholder="Nhập mật khẩu" name="password" />
                                <?php if(!empty($data['errEmail'])):?>
                                    <label id="password-error" class="error" for="password"><?= $data['errEmail'] ?></label>
                                <?php endif;?>
                                <?php if( !empty($data['errPassword'])):?>
                                    <label id="password-error" class="error" for="password"><?=$data['errPassword'] ?></label>
                                <?php endif;?>
                            </div>

                            <button class="btn btn-primary btn-sm d-block w-100" type="submit">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
<script>
    $(document).ready(function () {
        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Vui lòng nhập địa chỉ email",
                    email: "Vui lòng nhập đúng địa chỉ email"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu ít nhất phải có 6 ký tự"
                }
            },
            submitHandler: function(form) {
                // If form is valid, submit it
                form.submit();
            }
        });
    });
</script>
