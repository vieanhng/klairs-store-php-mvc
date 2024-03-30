<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= $data["title"]?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;400;500;700;900&amp;display=swap"/>
    <link rel="shortcut icon" type="image/png" href="<?=URL?>public/assets/images/logonentrang.jpg"/>

    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/slick.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/fontawesome.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/jquery.modal.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap-drawer.min.css"/>
    <link rel="stylesheet" href="<?=URL?>public/assets/css/style.css"/>

</head>
<body>
<div class="menu -style-3">
    <div class="container-full-half">
        <div class="menu__wrapper"><a href="<?= URL ?>"><img src="<?=URL?>public/assets/images/logonenden.png" class="logonenden" alt="Logo"/></a>
            <div class="navigator -white">
                <ul>
                    <li class="relative"><a href="<?= URL ?>">Trang chủ</a>

                    </li>
                    <li class="relative"><a href="<?=URL?>/allproducts">Sản phẩm<span "><i class="fas fa-angle-down"></i></span></a>
                        <ul class="dropdown-menu">

                            <ul class="dropdown-menu__col">

                                <li><a href="#">Category 1</a></li>
                                <li><a href="#">Category 2</a></li>

                            </ul>

                        </ul>
                    </li>

                    <li class="relative"><a href="about.html">Giới thiệu</a></li>


                    <li class="relative"><a href="contact.html">Liên hệ</a></li>
                </ul>
            </div>
            <div class="menu-functions -white"><a class="menu-icon -search" href="#"><img src="<?=URL?>public/assets/images/header/search-icon-white.png" alt="Search icon"/></a>
                <div class="search-box">
                    <form>
                        <input type="text" placeholder="Tìm kiếm sản phẩm?" name="search"/>
                        <button><img src="<?=URL?>public/assets/images/header/search-icon.png" alt="Search icon"/></button>
                    </form>
                </div>
                    <a class="menu-icon" href="<?= URL?>carts"><img
                                src="<?=URL?>public/assets/images/header/cart-icon-white.png" alt="Cart icon"/>
                    </a>
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