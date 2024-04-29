<?php require_once ROOT ."/views/inc/header.php" ?>
<div class="breadcrumb">
    <div class="container">
        <h2>Đặt lại mật khẩu</h2>
    </div>
</div>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-sm-8 col-12">
            <div class="contact-form mb-5">
                <form id="loginForm" method="post">
                    <div class="input-validator">
                        <label class="label" for="email">Email</label>
                        <input class="mt-3" type="text" name="email" placeholder="Email" value="<?= isset($_GET['email']) ? $_GET['email'] : ""?>">
                    </div>
                    <input class="btn -dark" type="submit" style="float: right" value="ĐẶT LẠI MẬT KHẨU">
                </form>
            </div>

        </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/footer.php" ?>
<script>
    <?php Session::success('emailSent')?>
    <?php Session::danger('resetFail')?>

</script>