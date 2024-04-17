
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
                        <form class="user" action="<?=getUrl('admin/users/login')?>" method="post">
                            <div class="text-dark mb-3"><label class="form-label" for=InputEmail"">Email</label><input id="InputEmail" class="form-control form-control-sm" type="email" aria-describedby="emailHelp" placeholder="Nhập email" name="email" /></div>
                            <div class="text-dark mb-3"><label class="form-label" for="InputPassword">Mật khẩu</label><input id="InputPassword" class="form-control form-control-sm" type="password" placeholder="Nhập mật khẩu" name="password" /></div>
                            <button class="btn btn-primary btn-sm d-block w-100" type="submit">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>