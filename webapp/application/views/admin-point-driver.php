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
            Detalles de Tranferencias Punto a Punto
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">VBD</a></li>
            <li class="active">Conductor Asignado</li>
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
                  <table id="example1" class="table table-bordered table-striped tbl_package tbl_package1">
   <?php 
								$query = $this->db->query(" SELECT * FROM `settings` order by id DESC ");
								$row = $query->row('settings');
						
								$str = $row->currency;
								$s = explode(',',$str);
								$paypal =$row->paypal_option;
								$s="";
								
								 // $query1 = $this->db->query("SELECT * FROM  bookingdetails WHERE purpose='Point to Point Transfer'  and (status='Processing' or status='Complete') OR (item_status='Completed' or item_status='')  ORDER BY id DESC");

                $query1 = $this->db->query("SELECT * FROM  bookingdetails WHERE purpose='Point to Point Transfer'  and assigned_for >'0' ORDER BY id DESC");
								?>
                                
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                             <th>Fecha</th>
                                             <th>Estado</th>
                                            <th>Acción</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
		
       foreach($query1->result_array('userdetails') as $row1){
        ?>
                                    
                                        <tr class="odd gradeX" >
                                            <td class="center"> <?php echo $row1['uneaque_id'];?></td>
                                            <td class="center"> <?php echo $row1['pickup_area'];?></td>
                                            <td class="center"> <?php echo $row1['drop_area'];?></td>
                                            <td class="center"> <?php echo $row1['pickup_date'];?></td>
                                            <td class="center"> <?php if($row1['status']=='Complete'){echo "Completed";}else{ echo $row1['status'];}?></td>
                                            <td class="center"><a href="#" class='status2'title="<?php echo $row1['id'];?>"><?php if($row1['status']!='Complete'){echo'<i class="fa fa-check-square-o"></i>
';}?></a>&nbsp;&nbsp;<a href="#" title="<?php echo $row1['id'];?>" class="delete"><i class="fa fa-trash-o "></i></a></td>
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
	$(document).on('click',"#example1 .status2",function(){
     
	   			
			var r = confirm("¿Está seguro que quiere cambiar el estado?");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');								
				$.ajax({
					url:'<?php echo base_url();?>admin/bookingstatus',
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
			var r = confirm("¿Está seguro que quiere eliminar los detalles de la reserva?");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');
				
				
				$.ajax({
					url:'<?php echo base_url();?>admin/bookingdelete',
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
