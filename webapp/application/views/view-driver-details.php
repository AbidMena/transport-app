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
            Detalles de Conductor
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">DM</a></li>
            <li class="active">Ver Todos</li>
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
                  <table id="example1" class="table table-bordered table-striped tbl_package">
  <?php
								 $query1 = $this->db->query("SELECT * FROM  driver_details ORDER BY id DESC");
								?>
                                
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Celular</th>
                                            <th>Dirección</th>
                                            <th>No. Licencia</th>
                                            <th>Tipo Carro</th>
                                            <th>No. Carro</th>
											<th> Rating</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
		
       foreach($query1->result_array('driver_details') as $row1){
        ?>
                                    
                                        <tr class="odd gradeX" >
                                            <td class="center"> <?php echo $row1['user_name'];?></td>
                                            <td class="center"> <?php echo $row1['phone'];?></td>
                                            <td class="center"> <?php echo $row1['address'];?></td>
                                            <td class="center"> <?php echo $row1['license_no'];?></td>
                                             <td class="center"> <?php echo $row1['car_type'];?></td>
                                             <td class="center"> <?php echo $row1['car_no'];?></td>
											 <td class="center"> <?php echo $row1['rating'];?></td>
                                            <td class="center"><a href="<?php echo base_url();?>admin/edit_driver?iddriver=<?php echo $row1['id'];?>" > <i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a href="#" title="<?php echo $row1['id'];?>" class="delete"><i class="fa fa-trash-o "></i></a> <?php if($row1['user_status']=='Inactive'){?><a class="assess" title="<?php echo $row1['id'];?>" href="#">
<i class="fa fa-check-square-o"></i>
											</a><?php } ?></td>
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
    <!-- page script -->
    <script>
      $(function () {
       $("#example1").DataTable({
			"ordering": false
			});
      });
    </script>
	<script src="<?php echo base_url();?>assets/adminlte/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
   $(function () {
	   $(document).on('click',"#example1 .assess",function(){
     
	   			
			var r = confirm("¿Está seguro que quiere aprobar este registro?");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');								
				$.ajax({
					url:'<?php echo base_url();?>admin/approval_driver',
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
		
 $(document).on('click',"#example1 .delete",function(){
			
							
			var r = confirm("¿Está seguro que quiere eliminar los detalles del conductor?");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');
				
				
				$.ajax({
					url:'<?php echo base_url();?>admin/delete_driver',
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
