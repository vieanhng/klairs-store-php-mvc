
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
                <form method="post">
                    <div class="input-validator">
                        <label class="label" for="email">Email</label>
                        <input class="mt-3" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="input-validator">
                        <label class="label" for="password">Mật khẩu</label>
                        <input class="mt-3" type="password" name="password" placeholder="Password">
                    </div>
                    <input class="btn -dark" type="submit" value="ĐĂNG NHẬP">
                </form>
            </div>
        </div>
    </div>
</div>

<?php //require_once ROOT ."/views/inc/footer.php" ?>