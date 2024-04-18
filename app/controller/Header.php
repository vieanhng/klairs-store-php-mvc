<?php

class Header extends Controller
{
    /**
     * @var Category
     */
    private  Category $categoryModel;

    public function __construct()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
           Redirect::to('');
            exit();
        }
        header('Content-Type: application/json');
        $this->categoryModel =  $this->model('Category');
    }

    public function getCategories(){
        $categoryList = $this->categoryModel->getCategories();
        echo json_encode($categoryList);
    }
}