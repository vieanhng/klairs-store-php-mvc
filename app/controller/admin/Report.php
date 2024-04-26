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
        //var_dump($data);
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
        $this->view('admin.report.revenue',$data);
    }


}