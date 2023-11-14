<?php 

class ProductsController extends AdminController{

    private $model;
    public function __construct(){
        $this->model = new ProductModel();
    }

    public function index(){
        $products = $this->model->getAllProducts();
        return adminView("products.index", compact("products") );
    }

    public function add(){
        return adminView("products.add");
    }

    public function save(){
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'price'=> $_POST['price'],
            'sale_price' => $_POST['sale_price'],
            'description' => $_POST['description'],
        ];

        $id = $this->model->add($data);
        if($id){
            header('location: '.base_url('admin/products/edit/'.$id));
        }
    }

    public function edit($id){
        $product = $this->model->getById($id);
        
        return adminView('products.edit', compact('product'));
    }

    public function update($id){
        
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'price'=> $_POST['price'],
            'sale_price' => $_POST['sale_price'],
            'description' => $_POST['description'],
        ];

        $result = $this->model->update($id, $data);
        if($result){
            header('location: '.base_url('admin/products/edit/'.$id));
        }
    }

    public function delete($id){
        $result = $this->model->delete($id);
        if($result){
            header('location: '.base_url('admin/products'));
        }
    }
}