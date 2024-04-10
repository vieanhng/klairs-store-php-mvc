
<?php require_once ROOT ."/views/inc/header.php" ?>
<div class="breadcrumb">
    <div class="container">
        <h2>Đăng nhập</h2>
    </div>
</div>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-sm-8 col-12">
            <div class="contact-form mb-5">
                <form id="loginForm" method="post">
                    <div class="input-validator">
                        <label class="label" for="email">Email</label>
                        <input class="mt-3" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="input-validator">
                        <label class="label" for="password">Mật khẩu</label>
                        <input class="mt-3" type="password" name="password" placeholder="Password">
                        <?php if(!empty($data['errEmail'])):?>
                        <label id="password-error" class="error" for="password"><?= $data['errEmail'] ?></label>
                        <?php endif;?>
                        <?php if( !empty($data['errPassword'])):?>
                            <label id="password-error" class="error" for="password"><?=$data['errPassword'] ?></label>
                        <?php endif;?>
                    </div>

                    <a href="<?=getUrl('users/resetPassword')?>">Quên mật khẩu</a>
                    <input class="btn -dark" type="submit" style="float: right" value="ĐĂNG NHẬP">
                </form>
            </div>

        </div>
        <div class="col-12 text-center mt-5">Chưa có tài khoản? <a href="<?=getUrl('users/register')?>">Đăng ký</a> </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/footer.php" ?>


<script>
    $(document).ready(function () {
        $('#loginForm').validate({
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