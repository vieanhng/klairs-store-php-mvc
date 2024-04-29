<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= $data["title"]?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?=URL?>public/assets/images/logonentrang.jpg"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/admin/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/slick.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/fontawesome.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/jquery.modal.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap-drawer.min.css"/>

    <link rel="stylesheet" href="<?=URL?>public/assets/css/style.css"/>
    <script>
        window.BASE_URL = '<?= URL ?>'
    </script>
</head>
<body>
<div id="fui-toast"></div>
<div class="menu -style-3">
    <div class="container-full-half">
        <div class="menu__wrapper"><a href="<?= URL ?>"><img src="<?=URL?>public/assets/images/logonenden.png" class="logonenden" alt="Logo"/></a>
            <div class="navigator -white">
                <ul>
                    <li class="relative"><a href="<?= URL ?>">Trang chủ</a>

                    </li>


                        <li class="dropdown relative">
                        <a class="dropdown" data-toggle="dropdown" aria-haspopup="true" href="<?= URL ?>allproducts">Sản phẩm</a>
                        <div id="category-dropdown" class="dropdown-menu category-dropdown" aria-labelledby="category-dropdown">
                            <ul>
                                    <li class="dropdown-item"><a href="<?=getUrl('users/login')?>">Đăng nhập</a></li>
                                    <li class="dropdown-item"><a href="<?=getUrl('users/register')?>">Đăng ký</a></li>
                                    <li class="dropdown-item"><a href="<?=getUrl('users/profile')?>">Thông tin tài khoản</a></li>
                                    <li class="dropdown-item"><a href="<?=getUrl('users/logout')?>">Đăng xuất</a></li>
                            </ul>
                        </div>

                        </li>


                    <li class="relative"><a href="<?=getUrl('pages/aboutus')?>">Giới thiệu</a></li>


                    <li class="relative"><a href="<?=getUrl('pages/contactus')?>">Liên hệ</a></li>
                </ul>
            </div>
            <div class="menu-functions -white">
                <a class="menu-icon -search" href="#" style="color: rgb(255,255,255);"><svg class="icon icon-tabler icon-tabler-search" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="font-size: 26px;">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="10" cy="10" r="7"></circle>
                        <line x1="21" y1="21" x2="15" y2="15"></line>
                    </svg></a>
                <div class="search-box">
                    <form action="<?=getUrl('allproducts')?>">
                        <input type="text" placeholder="Tìm kiếm sản phẩm?" name="search" />
                        <button><img src="<?=getUrl('public/assets/images/header/search-icon.png')?>" alt="Search icon" /></button>
                    </form>
                </div>
                <a class="menu-icon" href="<?=getUrl('carts')?>" style="text-decoration: none;color: #000000;margin-right: 0px;">
                    <div class="menu-cart" style="margin-right: 15px;"><svg class="icon icon-tabler icon-tabler-shopping-cart" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 26px;height: 26px;color: rgb(255,255,255);">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="19" r="2"></circle>
                            <circle cx="17" cy="19" r="2"></circle>
                            <path d="M3 3h2l2 12a3 3 0 0 0 3 2h7a3 3 0 0 0 3 -2l1 -7h-15.2"></path>
                        </svg>
                        <span class="bg-light cart__quantity">
                            <?= Session::existed('user_cart') ? Session::name('user_cart') : 0?>
                        </span>
                    </div>
                </a>
                <div class="dropdown">
                    <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
    text-decoration: none;
    color: #fff;
">
                        <svg class="icon icon-tabler icon-tabler-user" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="font-size: 26px;">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                    </a>

                    <div class="dropdown-menu " aria-labelledby="dropdownMenu2">
                        <ul>
                        <?php if(!Auth::isLoggedIn()):?>
                            <li class="dropdown-item"><a href="<?=getUrl('users/login')?>">Đăng nhập</a></li>
                            <li class="dropdown-item"><a href="<?=getUrl('users/register')?>">Đăng ký</a></li>
                        <?php else:?>
                            <li class="dropdown-item"><a href="<?=getUrl('users/profile')?>">Thông tin tài khoản</a></li>
                            <li class="dropdown-item"><a href="<?=getUrl('users/orderHistory')?>">Lịch sử mua hàng</a></li>
                            <li class="dropdown-item"><a href="<?=getUrl('users/logout')?>">Đăng xuất</a></li>
                        <?php endif;?>
                        </ul>
                    </div>
                </div>
                <a class="menu-icon -navbar" href="#">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="content">