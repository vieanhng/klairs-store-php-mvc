<?php

class Report extends Controller
{
    public function index(){
        Redirect::to('admin/report/products');
    }

    public function products()
    {
        $this->view('admin.report.product');
    }

    public function categories()
    {
        $this->view('admin.report.category');
    }

    public function revenue()
    {
        $this->view('admin.report.revenue');
    }


}