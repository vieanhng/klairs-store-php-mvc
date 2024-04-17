<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="color: #545d6f;background: rgb(234,236,240);">
        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><img src="<?=getUrl('public/assets/admin/img/logo.webp')?>" style="width: 96px;transform: translate(-4px) rotate(14deg) scale(1);height: 94px;" width="129" height="138"></div>
            </a>
            <hr class="sidebar-divider my-0" style="width: 179px;height: 0px;background: #676767;">
            <ul class="navbar-nav text-light" id="accordionSidebar" style="margin-top: 10px;">
                <li class="nav-item">
                    <a class="nav-link <?= $_REQUEST['url'] == 'admin/dashboard' ? 'active' : ''?> fw-semibold" href="<?=getUrl('admin/dashboard')?>" style="color: #545d6f;--bs-body-color: #161a1f;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-home" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Tổng quan</span>
                    </a>
                    <a class="nav-link <?= $_REQUEST['url'] == 'admin/orders' ? 'active' : ''?> fw-semibold" href="<?=getUrl('admin/orders')?>" style="color: #545d6f;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-invoice" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <line x1="9" y1="7" x2="10" y2="7"></line>
                            <line x1="9" y1="13" x2="15" y2="13"></line>
                            <line x1="13" y1="17" x2="15" y2="17"></line>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Quản lý đơn hàng</span>
                    </a>
                    <a class="nav-link <?= $_REQUEST['url'] == 'admin/categories' ? 'active' : ''?> fw-semibold" href="<?=getUrl('admin/categories')?>" style="color: #545d6f;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-folders" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path>
                            <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"></path>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Quản lý danh mục</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/products')?>" style="color: #545d6f;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-package" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                            <line x1="12" y1="12" x2="20" y2="7.5"></line>
                            <line x1="12" y1="12" x2="12" y2="21"></line>
                            <line x1="12" y1="12" x2="4" y2="7.5"></line>
                            <line x1="16" y1="5.25" x2="8" y2="9.75"></line>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Quản lý sản phẩm</span>
                    </a><a class="nav-link fw-semibold" href="<?=getUrl('admin/customers')?>" style="color: #545d6f;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-users" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Quản lý khách hàng</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/payments')?>" style="color: #545d6f;padding-right: 15px;padding-left: 17px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-credit-card" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <line x1="7" y1="15" x2="7.01" y2="15"></line>
                            <line x1="11" y1="15" x2="13" y2="15"></line>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Quản lý phương thức&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; thanh toán</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/reports')?>" style="color: #545d6f;padding-right: 15px;padding-left: 17px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-adjustments-alt" style="font-size: 20px;margin-right: 7px;margin-top: 0px;margin-bottom: 5px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="4" y="8" width="4" height="4"></rect>
                            <line x1="6" y1="4" x2="6" y2="8"></line>
                            <line x1="6" y1="12" x2="6" y2="20"></line>
                            <rect x="10" y="14" width="4" height="4"></rect>
                            <line x1="12" y1="4" x2="12" y2="14"></line>
                            <line x1="12" y1="18" x2="12" y2="20"></line>
                            <rect x="16" y="5" width="4" height="4"></rect>
                            <line x1="18" y1="4" x2="18" y2="5"></line>
                            <line x1="18" y1="9" x2="18" y2="20"></line>
                        </svg>
                        <span style="padding-top: 0px;margin-top: 0px;">Báo cáo</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/reports/type/products')?>" style="color: #545d6f;padding-right: 15px;padding-left: 20px;margin-left: 30px;width: 190px;border-left: 1px solid rgb(84,93,111);"><span style="padding-top: 0px;margin-top: 0px;">Báo cáo theo sản phẩm</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/reports/type/categories')?>" style="color: #545d6f;padding-right: 15px;padding-left: 20px;margin-left: 30px;width: 190px;border-left: 1px solid #545d6f;"><span style="padding-top: 0px;margin-top: 0px;">Báo cáo theo danh mục</span>
                    </a>
                    <a class="nav-link fw-semibold" href="<?=getUrl('admin/reports/type/revenue')?>" style="color: #545d6f;padding-right: 15px;padding-left: 20px;margin-left: 30px;width: 190px;border-left: 1px solid #545d6f;"><span style="padding-top: 0px;margin-top: 0px;">Báo cáo doanh thu</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
<nav class="navbar navbar-light navbar-expand shadow-none mb-4 topbar static-top" style="padding-top: 8px;background: #eaecf0;">
    <div class="container-fluid">
        <div class="col me-2">
            <h2 class="mb-0" style="font-size: 24px;color: rgb(0,0,0);"><strong><?=$data['title']?></strong></h2>
            <span class="text-xs" style="font-size: 13.2px;"><?=$data['subtitle']?></span>
        </div>
        <ul class="navbar-nav flex-nowrap ms-auto" style="padding-left: 0px;">
            <li class="nav-item dropdown no-arrow">
                <div style="width: 138.812px;">
                    <div class="d-inline-flex">
                        <div><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" width="43" height="46"></div>
                        <div style="margin-left: 12px;">
                            <div><span>Admin</span></div>
                            <div><a href="#">Đăng xuất</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>