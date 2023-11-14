  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")?>">
  <link rel="stylesheet" href="<?=base_url("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")?>">
  <link rel="stylesheet" href="<?=base_url("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css")?>">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>slug</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($products as $product): ?>
                    <tr>
                        <td><?=$product['title']?></td>
                        <td><?=$product['slug']?></td>
                        <td><?=$product['sale_price']?> <span class="strike-through" ><?=$product['price']?></span> </td>
                        <td>
                            <a href="<?=base_url('admin/products/edit/'.$product['id'])?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?=base_url('admin/products/delete/'.$product['id'])?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<!-- DataTables  & Plugins -->
<script src="<?=base_url("assets/plugins/datatables/jquery.dataTables.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")?>"></script> 
<script src="<?=base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/jszip/jszip.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/pdfmake/pdfmake.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/pdfmake/vfs_fonts.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-buttons/js/buttons.html5.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-buttons/js/buttons.print.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/datatables-buttons/js/buttons.colVis.min.js")?>"></script>
<script>
  $(function () {
    
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
