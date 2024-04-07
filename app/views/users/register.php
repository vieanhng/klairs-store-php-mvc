<?php require_once ROOT . "/views/inc/header.php" ?>

    <div class="breadcrumb">
        <div class="container">
            <h2>Đăng ký</h2>
        </div>
    </div>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-sm-8 col-12">
                <div class="contact-form mb-5">
                    <form id="registrationForm" method="post" action="<?=getUrl('users/register')?>">
                        <div class="input-validator">
                            <label class="label" for="name">Họ Tên</label>
                            <input class="mt-3" type="text" name="name" id="name" placeholder="Email">
                        </div>
                        <div class="input-validator">
                            <label class="label" for="email">Email</label>
                            <input class="mt-3" type="text" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="input-validator">
                            <label class="label" for="phone">Số điện thoại</label>
                            <input class="mt-3" type="text" name="phone" id="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="input-validator">
                            <label class="label" for="password">Mật khẩu</label>
                            <input class="mt-3" type="password" name="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                        </div>
                        <div class="input-validator">
                            <label class="label" for="confirm_password">Nhập lại mật khẩu</label>
                            <input class="mt-3" type="password" name="confirm_password" id="confirm_password" placeholder="Nhập mật khẩu" autocomplete="off" >
                        </div>
                        <input class="btn -dark" type="submit" style="float: right" id="register-button" value="ĐĂNG KÝ">
                    </form>
                </div>
            </div>
            <div class="col-12 text-center mt-5">Đã có tài khoản? <a href="<?=getUrl('users/login')?>">Đăng nhập</a> </div>
        </div>
    </div>
<?php require_once ROOT ."/views/inc/footer.php" ?>
<script>
    $(document).ready(function () {
        $('#registrationForm').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    minlength: 10,
                    maxlength: 15,
                    digits: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Vui lòng nhập họ tên",
                },
                email: {
                    required: "Vui lòng nhập địa chỉ email",
                    email: "Vui lòng nhập đúng địa chỉ email"
                },
                phone: {
                    minlength: "Số điện thoại ít nhất phải có 10 ký tự",
                    maxlength: "Số điện thoại tối đa chỉ có 15 ký tự",
                    digits: "Vui lòng chỉ nhập số"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu ít nhất phải có 6 ký tự"
                },
                confirm_password: {
                    required: "Vui lòng nhập lại mật khẩu",
                    equalTo: "Mật khẩu không khớp"
                }
            },submitHandler: function(form) {
                form.submit();
            }
        });
        $('#register-button').click(function(event) {
            $('#registrationForm').valid();
        });
    });
</script>
