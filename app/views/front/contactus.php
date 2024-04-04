<?php require_once ROOT . "/views/inc/header.php" ?>

<div class="breadcrumb">
        <div class="container">
            <h2>Liên Hệ</h2>
            <ul>
                <li>Trang Chủ</li>
                <li class="active">Liên hệ với chúng tôi</li>
            </ul>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3 class="contact-title">Thông tin liên hệ</h3>
                    <div class="contact-info__item">
                        <div class="contact-info__item__icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-info__item__detail">
                            <h3>Địa chỉ:</h3>
                            <p>181, Cao Thắng, phường 12, quận 10, Hồ Chí Minh</p>
                        </div>
                    </div>
                    <div class="contact-info__item">
                        <div class="contact-info__item__icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="contact-info__item__detail">
                            <h3>Hotline:</h3>
                            <p>0931.666.489</p>
                        </div>
                    </div>
                    <div class="contact-info__item">
                        <div class="contact-info__item__icon"><i class="far fa-envelope"></i></div>
                        <div class="contact-info__item__detail">
                            <h3>Email: </h3>
                            <p>klairsvietnam@gmail.com</p>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6">
                    <h3 class="contact-title">Thông tin thắc mắc</h3>
                    <div class="contact-form">
                        <form>
                            <div class="input-validator">
                                <input type="text" name="name" placeholder="Điền tên của bạn"/>
                            </div>
                            <div class="input-validator">
                                <input type="text" name="email" placeholder="Điền email của bạn"/>
                            </div>
                            <div class="input-validator">
                                <textarea name="message" id="" cols="30" rows="3"
                                          placeholder="Viết lời nhắn... "></textarea>
                            </div>
                            <a class="btn -dark" href="#">Gửi</a>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <iframe class="contact-map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26544.761428132653!2d105.83081260286463!3d21.01523825635793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSMOgIE7hu5lpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1594639675485!5m2!1svi!2s"
                            width="100%" height="450" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
<?php require_once ROOT . "/views/inc/footer.php" ?>
