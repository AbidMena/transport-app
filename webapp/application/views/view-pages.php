<!DOCTYPE html>
<html>
  <?php
	 include"includes/admin_header.php";
	 ?>
	 
	 <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Left side column. contains the logo and sidebar -->
     <?php
	 include"includes/admin_sidebar.php";
	 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Pages
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">View All</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
                <div class="box-header">
                
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped tbl_package" id="dataTables-example">
 <?php
								 $query1 = $this->db->query("SELECT * FROM  static_pages ORDER BY id DESC");
								?>
                                
                                    <thead>
                                        <tr>
                                            <th>Page Name</th>
                                           
                                           <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
		
       foreach($query1->result_array('static_pages') as $row1){
        
        
        
		?>
                                    
                                        <tr class="odd gradeX" >
                                            <td class="center"> <?php echo $row1['page_title'];?></td>
                                           
                                            <td class="center"><a href="<?php echo base_url();?>admin/edit_pages?idp=<?php echo $row1['id'];?>" > <i class="fa fa-pencil-square-o"></i></a></td>
                                        </tr>
                                       <?php
	   }
									?> 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php
	 include"includes/admin-footer.php";
	 ?>

    
    </div><!-- ./wrapper -->

      <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
	
	 
    <script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/adminlte/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>assets/adminlte/dist/js/demo.js"></script>
	
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
     <script src="<?php echo base_url();?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- page script -->
	  <script src="<?php echo base_url();?>assets/adminlte/dist/js/sb-admin-2.js"></script>
    <!-- page script -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
   
    <script>
      $(function () {
        $("#example1").DataTable({
			"ordering": false
			});
      });
    </script>
	 

     <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/css/jquery-ui.css" />
        <script src="<?php echo base_url();?>assets/adminlte/js/jquery-ui.js"></script>
    <script>
    $(document).ready(function() {
        
		
		
		$('.delete').click(function(){	
							
			var r = confirm("Are you sure want to delete the Pages ");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');
				
				
				$.ajax({
					url:'<?php echo base_url();?>admin/delete_pages',
					type:'post',
					data:{'id':id},
					success:function(cancel){
					console.log(cancel);
					if(cancel==1){
					th.hide();
					location.reload();
					
					
					
					}
					else{
					alert("err");
					}
					}
				});  								
			}
						   
});				
    });
    </script>
  </body>
</html>
