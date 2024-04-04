<?php require_once ROOT . "/views/inc/header.php" ?>
<?php
/**
 * @var array $data
 */
?>
    <div class="breadcrumb">
        <div class="container">
            <h2>Thông tin tài khoản</h2>
            <ul>
                <li>Trang Chủ</li>
                <li class="active">Thông tin tài khoản</li>
            </ul>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="row d-xxl-flex justify-content-center justify-content-xxl-center">
                <div class="col-12 col-md-6 col-xxl-6">
                    <div class="contact-form">
                        <form method="post" action="<?= getUrl('users/update') ?>">
                            <div class="input-validator">
                                <input type="text" name="name" placeholder="Điền tên của bạn"
                                                                value="<?= $data['user']->ten_kh ?>"/></div>
                            <div class="input-validator">
                                <input type="text" name="email" placeholder="Email"
                                                                value="<?= $data['user']->email ?>"/></div>
                            <div class="input-validator">
                                <input type="text" name="phone" placeholder="Số điện thoại"
                                                                value="<?= $data['user']->dien_thoai ?>"/></div>
                            <div class="input-validator">
                                <input class="form-control" type="password"
                                                                placeholder="Nhập mật khẩu mới" name="password" autocomplete="false"/></div>
                            <div class="input-validator">
                                <input class="form-control" type="password"
                                                                placeholder="Xác nhận mật khẩu mới"
                                                                name="confirm_password" autocomplete="false"/>
                            </div>
                            <input class="btn -dark" type="submit" style="float:right;cursor: pointer" value="Cập nhật thông tin">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once ROOT . "/views/inc/footer.php" ?>

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
                    digits: true
                },
                password: {
                    required: true
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Vui lòng nhập họp tên",
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
