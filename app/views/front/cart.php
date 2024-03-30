<?php require_once ROOT . "/views/inc/header.php" ?>

<?php if ($data['cart']){ ?>
    <table style='background:#ffffff' class="table">
        <thead class='thead-dark'>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Update Qty</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        $qty = 0;

        foreach ($data['cart'] as $cart) { ?>
            <tr>
                <td><?php echo $cart->pro_name ?></td>
                <td><?php echo $cart->price ?></td>
                <td>
                    <?php echo $cart->qty ?>
                </td>
                <td>
                    <form class='d-inline' action="<?php echo URL ?>/carts/updateQty/<?php echo $cart->product ?> "
                          method="POST">
                        <input style='width:35px;height:20px' type="text" name="qty">
                        <input type="hidden" name="csrf" value="<?php new Csrf();
                        echo Csrf::get() ?>">
                        <input class='d-inline btn btn-info btn-sm py-0' name='upQty' type="submit" value='Up'>
                    </form>
                    <form class='d-inline' action="<?php echo URL ?>/carts/delete/<?php echo $cart->cart_id ?>"
                          method='GET'>
                        <input type="hidden" name="csrf" value="<?php new Csrf();
                        echo Csrf::get() ?>">
                        <button class='btn btn-danger delete  btn-sm py-0' type="submit"><i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
                <td><?php


                    echo number_format($cart->qty * $cart->price, 2, '.', '');
                    ?></td>
            </tr>
            <?php
            $total = $total + ($cart->qty * $cart->price);
            $qty = $qty + ($cart->qty);
        } ?>
        </tbody>
    </table>
    <ul class="list-group my-3 ">
        <li class="list-group-item bg-dark text-light"><h5 class='text-center'>Cart Details</h5></li>
        <li class="list-group-item"><strong><i class="fa fa-calculator"></i> Total Price: </strong><?php
            echo number_format($total, 2, '.', '');
            ?>
        </li>

        <li class="list-group-item"><strong><i class="fa fa-calculator"></i> Total Qty : </strong><?php
            echo number_format($qty, 2, '.', '');
            ?>
        </li>
        <li class="list-group-item">
            <form class='d-inline' action="<?php echo URL ?>/carts/clear" method='GET'>
                <input type="hidden" name="csrf" value="<?php new Csrf();
                echo Csrf::get() ?>">
                <button class='btn btn-danger delete  btn-sm py-0' type="submit">Clear Cart <i class="fa fa-trash"></i>
                </button>
            </form>
        </li>

    </ul>

<div class="card my-4 checkout ">
    <div class="card-header bg-dark text-light">
        <h5 class='text-center'>Details for buying</h5>
    </div>
    <div class="card-body">
        <form id="payment-form" action="<?php echo URL ?>/carts/checkout" method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name"
                       class="form-control <?php echo isset($data['errName']) ? 'is-invalid' : '' ?>">
                <?php echo isset($data['errName']) ? '<div class="invalid-feedback">' . $data['errName'] . '</div>' : '' ?>
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email"
                       class="form-control <?php echo isset($data['errEmail']) ? 'is-invalid' : '' ?>">
                <?php echo isset($data['errEmail']) ? '<div class="invalid-feedback">' . $data['errEmail'] . '</div>' : '' ?>
            </div>
            <div class="form-group">
                <input type="text" name="mobile" placeholder="Enter mobile"
                       class="form-control <?php echo isset($data['errMobile']) ? 'is-invalid' : '' ?>">
                <?php echo isset($data['errMobile']) ? '<div class="invalid-feedback">' . $data['errMobile'] . '</div>' : '' ?>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Enter address"
                       class="form-control <?php echo isset($data['errAddress']) ? 'is-invalid' : '' ?>">
                <?php echo isset($data['errAddress']) ? '<div class="invalid-feedback">' . $data['errAddress'] . '</div>' : '' ?>
            </div>
            <div class="form-group">
                <input type="text" name="city" placeholder="Enter your city name" class="form-control
                        stripeElement stripeElement--empty <?php echo isset($data['errCity']) ? 'is-invalid' : '' ?>">
                <?php echo isset($data['errCity']) ? '<div class="invalid-feedback">' . $data['errCity'] . '</div>' : '' ?>
            </div>
            <input type="radio" class='d-none' name="payment_method" value='cash' id='cash' onclick='paymentCheck()'>
            <label for="cash" class="mr-4"><i class="fa fa-2x text-success fa-money"></i></label>
            <input type="radio" class='d-none' name="payment_method" value='stripe' id='stripe'
                   onclick='paymentCheck()'>
            <label for="stripe" class='mr-4'><i class="fa fa-2x text-info fa-cc-stripe"></i> </label>
            <small><?php echo isset($data['errMethod']) ? '<div class="text-danger">' . $data['errMethod'] . '</div>' : '' ?></small>
            <small class="text-muted  d-block my-2">if you want online payment click twice on stripe</small>
            <div class="form-row">
                <label for="card-element">
                    Enter you card number
                </label>
                <div id="card-element" class='form-control'>
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

            <div class="form-group">
                <input type="hidden" name="csrf" value="<?php new Csrf();
                echo Csrf::get() ?>">
                <input type="hidden" name="qty" value='<?php echo $qty ?>'>
                <input type="hidden" name="total" value='<?php echo $total ?>'>
                <input type="submit" name='billTo' value='Buy Now' class="btn btn-success btn-sm buying">
            </div>
        </form>
    </div>
    <?php } else { ?>
        <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i
                        class="fa fa-warning"></i></span> There is no items in cart</p>
    <?php } ?>
    <div class="breadcrumb">
        <div class="container">
            <h2>Cart</h2>
            <ul>
                <li>Home</li>
                <li>Shop</li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="cart__table">
                                <div class="cart__table__wrapper">
                                    <table>
                                        <colgroup>
                                            <col style="width: 10%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 17%"/>
                                            <col style="width: 9%"/>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="cart-product">
                                                    <div class="cart-product__content">
                                                        <h5>eyes</h5><a href="product-detail.html">The expert mascaraa</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>10</td>
                                            <td>
                                                <div class="quantity-controller ">
                                                    <div class="quantity-controller__number">1</div>
                                                </div>
                                            </td>
                                            <td>35.00</td>
                                            <td><a href="#"><i class="fal fa-times"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="cart-product">
                                                    <div class="cart-product__content">
                                                        <h5>eyes</h5><a href="product-detail.html">Velvet Melon High
                                                            Intensity</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>10</td>
                                            <td>
                                                <div class="quantity-controller ">
                                                    <div class="quantity-controller__number">1</div>
                                                </div>
                                            </td>
                                            <td>38.00</td>
                                            <td><a href="#"><i class="fal fa-times"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="cart-product">
                                                    <div class="cart-product__content">
                                                        <h5>eyes</h5><a href="product-detail.html">Leather shopper bag</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>10</td>
                                            <td>
                                                <div class="quantity-controller ">
                                                    <div class="quantity-controller__number">1</div>
                                                </div>
                                            </td>
                                            <td>35.00</td>
                                            <td><a href="#"><i class="fal fa-times"></i></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart__table__footer">
                                    <a href="<?=URL?>">
                                        <i class="fal fa-long-arrow-left">

                                        </i>Continue Shopping</a><a href="#">
                                        </i>Update Cart</a><a href="#">
                                            <i class="fal fa-trash">
                                        </i>Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="cart__total__content">
                                <h3>Cart</h3>
                                <table>
                                    <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>$169.00</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td>$169.00</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="final-price">$169.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a class="btn -dark" href="<?= getUrl('checkout')?>">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>

                    <div class="cart__total">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
<?php require_once ROOT . "/views/inc/footer.php" ?>