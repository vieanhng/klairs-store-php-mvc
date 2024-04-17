
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
<div class="container-fluid content-container" style="background: #ffffff;border-radius: 5px;width: auto;margin-left: 25px;margin-right: 25px;margin-bottom: 25px;">
    <div class="row" style="background: #ffffff;margin-left: -12px;">
        <div class="col-md-12" style="padding-top: 17px;height: 51px;">
            <p class="fw-bold">KẾT QUẢ BÁN HÀNG HÔM NAY</p>
        </div>
    </div>
    <div class="row" style="margin-left: 12px;margin-right: 12px;margin-top: 9px;">
        <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
            <p style="font-size: 31px;">20</p>
        </div>
        <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
            <p style="font-size: 31px;">20</p>
        </div>
        <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
            <p style="font-size: 31px;">20</p>
        </div>
        <div class="col-md-3"><span class="fw-semibold">Đơn hàng</span>
            <p style="font-size: 31px;">20</p>
        </div>
    </div>
</div>
<div class="container-fluid content-container">
    <div class="row">
        <div class="col-md-12 d-inline-flex justify-content-between" style="padding-top: 20px;height: 61px;padding-bottom: 0px;">
            <div>
                <p class="fw-bold">DOANH THU THEO THÁNG</p>
            </div>

        </div>
        <div class="col">
            <div class="card shadow-none mb-4" style="border-style: none;">
                <div class="chart-area" style="border-style: none;" id="myChart">
                    <canvas id="acquisitions" height="500" width="2248" style="display: block; height: 320px; width: 1124px;">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid content-container">
    <div class="row">
        <div class="col-md-12 d-inline-flex justify-content-between" style="padding-top: 20px;height: 61px;padding-bottom: 0px;">
            <div>
                <p class="fw-bold">TOP 5 SẢN PHẨM BÁN CHẠY</p>
            </div>
        </div>
        <div class="col" style="padding-right: 0px;padding-left: 0px;">
            <div class="table-responsive d-xl-flex table-striped" style="width: auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Doanh thu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Cell 1</td>
                        <td><img class="product-table-img" src="dogs/image2.jpeg" /></td>
                        <td>Cell 2</td>
                        <td>10</td>
                        <td>3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>Cell 3</td>
                        <td><img class="product-table-img" src="dogs/image3.jpeg" /></td>
                        <td>Cell 3</td>
                        <td>10</td>
                        <td>3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>Cell 3</td>
                        <td><img class="product-table-img" src="dogs/image2.jpeg" /></td>
                        <td>Cell 3</td>
                        <td>10</td>
                        <td>3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>Cell 3</td>
                        <td><img class="product-table-img" src="dogs/image3.jpeg" /></td>
                        <td>Cell 3</td>
                        <td>10</td>
                        <td>3.000.000đ</td>
                    </tr>
                    <tr>
                        <td>Cell 3</td>
                        <td><img class="product-table-img" src="dogs/image2.jpeg" /></td>
                        <td>Cell 3</td>
                        <td>10</td>
                        <td>3.000.000đ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once ROOT ."/views/inc/adminFooter.php" ?>

<script>
    // Sample data for each month
    (async function() {
        const data = [
            { year: 2010, count: 10 },
            { year: 2011, count: 20 },
            { year: 2012, count: 15 },
            { year: 2013, count: 25 },
            { year: 2014, count: 22 },
            { year: 2015, count: 30 },
            { year: 2016, count: 28 },
        ];

        new Chart(
            document.getElementById('acquisitions'),
            {
                type: 'bar',
                data: {
                    labels: data.map(row => row.year),
                    datasets: [
                        {
                            label: 'Acquisitions by year',
                            data: data.map(row => row.count)
                        }
                    ]
                }
            }
        );
    })();
</script>
