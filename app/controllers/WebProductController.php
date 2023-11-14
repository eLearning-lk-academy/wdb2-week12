<?php

class WebProductController extends MainController{
    private $model;

    public function __construct(){
        $this->model = new ProductModel();
    }

    public function index(){
        $viewArgs = ['title' => "All Products"];
        $viewArgs['products'] = $this->model->getAllProducts();
       return view("products.index", $viewArgs);
    }

    public function show($slug){
        $viewArgs = [];
        $product = $this->model->getBySlug($slug);

        $viewArgs['title'] = $product['title'];
        $viewArgs['product'] = $product;


        return view("products.show", $viewArgs);
    }

}