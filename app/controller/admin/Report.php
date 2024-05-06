<?php

class Report extends Controller
{
    protected Order $orderModel;
    const title = 'Báo cáo';
    public function __construct()
    {
        $this->orderModel = $this->model('Order');
    }

    public function index(){
        Redirect::to('admin/report/products');
        
    }

    public function products()
    {
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Báo cáo theo sản phẩm';

        $report = $this->orderModel->getSellSummary($_GET);
        $data['report'] = $report;
        $reportPros = $this->orderModel->getReportPros($_GET);
        $data['reportPros'] = $reportPros;
        if(isset($_GET['export'])){
            try {
                $header = [
                    "ma_sp",
                    "ten_sp",
                    "so_sp_ban",
                    "doanh_thu",
                    "loi_nhuan"
                ];

                $dataExport[] = $header;

                foreach ($reportPros as $item){
                    $dataExport[] = [
                        $item->ma_sp,
                        $item->ten_sp,
                        $item->so_sp_ban,
                        $item->doanh_thu,
                        $item->loi_nhuan
                    ];
                }

                $xlsx = Shuchkin\SimpleXLSXGen::fromArray( $dataExport );
                $xlsx->saveAs(dirname(ROOT).'/public/export/productreport.xlsx');
                Redirect::to('public/export/productreport.xlsx');
            }catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        $this->view('admin.report.product', $data);
   
    }

    public function categories()
    {
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Báo cáo theo danh mục';

        $report = $this->orderModel->getSellSummary($_GET);
        $data['report'] = $report;
        $reportCats = $this->orderModel->getReportCats($_GET);
        $data['reportCats'] = $reportCats;
        if(isset($_GET['export'])){
            try {
                $header = [
                    "ma_danh_muc",
                    "ten_danh_muc",
                    "so_luong_ban",
                    "doanh_thu",
                    "loi_nhuan"
                ];

                $dataExport[] = $header;

                foreach ($reportCats as $item){
                    $dataExport[] = [
                        $item->ma_danh_muc,
                        $item->ten_danh_muc,
                        $item->so_luong_ban,
                        $item->doanh_thu,
                        $item->loi_nhuan
                    ];
                }

                $xlsx = Shuchkin\SimpleXLSXGen::fromArray( $dataExport );
                $xlsx->saveAs(dirname(ROOT).'/public/export/category_report.xlsx');
                Redirect::to('public/export/category_report.xlsx');
            }catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        $this->view('admin.report.category',$data);
    }

    public function revenue()
    {   
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Báo cáo theo doanh thu';

        $report = $this->orderModel->getSellSummary($_GET);
        $data['report'] = $report;
        $reportRes = $this->orderModel->getReportRes($_GET);
        $data['reportRes'] = $reportRes;
        if(isset($_GET['export'])){
            try {
                $header = [
                    "stt",
                    "ngay",
                    "so_don_hang",
                    "so_san_pham",
                    "doanh_thu",
                    "loi_nhuan"
                ];

                $dataExport[] = $header;

                foreach ($reportRes as $index=>$item){
                    $dataExport[] = [
                        $index +1,
                        $item->ngay,
                        $item->so_luong_dh,
                        $item->so_sp_ban,
                        $item->doanh_thu,
                        $item->loi_nhuan
                    ];
                }

                $xlsx = Shuchkin\SimpleXLSXGen::fromArray( $dataExport );
                $xlsx->saveAs(dirname(ROOT).'/public/export/revenue_report.xlsx');
                Redirect::to('public/export/revenue_report.xlsx');
            }catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view('admin.report.revenue',$data);
    }


}