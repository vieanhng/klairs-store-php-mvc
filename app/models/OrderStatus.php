<?php

final class OrderStatus
{
    /**
     * Chờ xử lý
    Đang xử lý
    Đang vận chuyển
    Huỷ bỏ
    Thành công

     */
    const  PENDING = 'Chờ xử lý';
    const PROCESSING = 'Đang xử lý';
    const SHIPPING = 'Đang vận chuyển';
    const CANCEL = 'Huỷ bỏ';
    const COMPLETE = 'Thành công';
}