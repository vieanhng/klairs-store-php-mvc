<?php require_once ROOT . "/views/inc/header.php" ?>

<div class="breadcrumb">
    <div class="container">
        <h2>Checkout</h2>
        <ul><li>Home</li><li>Shop</li><li class="active">Checkout</li></ul>
    </div>
</div>
<div class="shop">
    <div class="container">
        <div class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <form action="">
                            <div class="checkout__form">
                                <div class="checkout__form__shipping">
                                    <h5 class="checkout-title">Shipping address</h5>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="input-validator">
                                                <label>First name <span>*</span>
                                                    <input type="text" name="firstName">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-validator">
                                                <label>Last name<span>*</span>
                                                    <input type="text" name="lastName">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Country<span>*</span>
                                                    <input type="text" name="country">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Address <span>*</span>
                                                    <input type="text" name="streetAddress" placeholder="Steet address">
                                                    <input type="text" name="apartment" placeholder="Apartment, suite, unite ect ( optinal )">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Town/City <span>*</span>
                                                    <input type="text" name="town">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Country/State <span>*</span>
                                                    <input type="text" name="state">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Postcode/ZIP <span>*</span>
                                                    <input type="text" name="zip">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-validator">
                                                <label>Order note
                                                    <input type="text" name="note" placeholder="Note about your order, e.g, special noe for delivery">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12 ml-auto">
                                <div class="checkout__total">
                                    <h5 class="checkout-title">Your order</h5>
                                    <form class="checkout__total__coupon">
                                        <h5>Coupon code</h5>
                                        <div class="input-validator">
                                            <input type="text" placeholder="Your code here" name="coupon">
                                        </div><a class="btn -dark" href="#">apply</a>
                                    </form>
                                    <div class="checkout__total__price">
                                        <h5>Product</h5>
                                        <table>
                                            <colgroup>
                                                <col style="width: 70%">
                                                <col style="width: 30%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <td><span>01 x </span>The expert mascaraa
                                                </td>
                                                <td>$35.00</td>
                                            </tr>
                                            <tr>
                                                <td><span>01 x </span>Velvet Melon High Intensity
                                                </td>
                                                <td>$38.00</td>
                                            </tr>
                                            <tr>
                                                <td><span>01 x </span>Leather shopper bag
                                                </td>
                                                <td>$35.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="checkout__total__price__total-count">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>$108.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>$108.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="checkout__total__price__payment">
                                            <label class="checkbox-label" for="payment">
                                                <input id="payment" type="checkbox" name="payment">Cheque payment
                                            </label>
                                            <label class="checkbox-label" htmlfor="paypal">
                                                <input id="paypal" type="checkbox" name="paypal">PayPal
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn -red">Place order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/inc/footer.php" ?>
