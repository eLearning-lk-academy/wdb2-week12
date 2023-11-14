<div class="row">
    <div class="col-12 col-md-9">
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Product</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?=base_url("admin/products/update/".$product['id'])?>" method="POST" >
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="test" class="form-control" id="title" name="title" placeholder="Product title here" value="<?=$product['title']?>" >
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="test" class="form-control" id="slug" name="slug" placeholder="Product slug here"  value="<?=$product['slug']?>">
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <label for="price">Price</label>
                    <input type="test" class="form-control" id="price" name="price" placeholder="Product price here"  value="<?=$product['price']?>">
                </div>
                <div class="col-6">
                    <label for="sale_price">Sale Price</label>
                    <input type="test" class="form-control" id="sale_price" name="sale_price" placeholder="Product sale price here"  value="<?=$product['sale_price']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" id="description" name="description" placeholder="Product description here"><?=$product['description']?></textarea>
            </div>
            
            <!-- <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

    </div>
</div>
