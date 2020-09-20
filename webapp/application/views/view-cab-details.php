<!DOCTYPE html>
<html>
  <?php
	 include "includes/admin_header.php";
	 ?>
	 <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Left side column. contains the logo and sidebar -->
     <?php
	 include "includes/admin_sidebar.php";
	 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    
		
		     <h1 class="page-header">Transferencia Punto a Punto<a href ="<?php echo base_url();?>admin/taxi_details"  class="btn btn-default">Agregar Nuevo</a></h1>
       
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">TD</a></li>
            <li class="active">Transferencia Punto a Punto</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
                <div class="box-header">
                 <div class="editbook"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped tbl_package">
   <?php
   $query = $this->db->query(" SELECT * FROM `settings` order by id DESC ");
		$row = $query->row('settings');
		$mesr = $row->measurements;
								 $query1 = $this->db->query("SELECT * FROM  cabdetails WHERE transfertype='Point to Point Transfer' ORDER BY id DESC");
								?>
                                
                                    <thead>
                                        <tr>
                                            <th>Taxi</th>
                                            <th>Tipo Transferencia</th>
                                            <th>Inicial <?php echo $mesr;?></th>
                                            <th>Tarifa Inicial</th>
                                            <th>Tarifa estandar</th>
                                              <th>Hora</th>
                                           <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
		
       foreach($query1->result_array('cabdetails') as $row1){
        ?>
                                    
                                        <tr class="odd gradeX" >
                                            <td class="center"> <?php echo $row1['cartype'];?></td>
                                            <td class="center"> <?php echo $row1['transfertype'];?></td>
                                            <td class="center"> <?php echo $row1['intialkm'];?></td>
                                            <td class="center"> <?php echo $row1['intailrate'];?></td>
                                             <td class="center"> <?php echo $row1['standardrate'];?></td>
                                              <td class="center"> <?php if($row1['timetype']=='day'){ echo'Day(6:00AM-10:00PM)';}else{ echo'Night(10:00PM-6:00AM)';}?></td>
                                            <td class="center"><a href="<?php echo base_url();?>admin/edit_taxi?idtaxi=<?php echo $row1['id'];?>" > <i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a href="#" title="<?php echo $row1['id'];?>" class="delete"><i class="fa fa-trash-o "></i></a></td>
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
	

   
<script>
$(function () {
	
 $(document).on('click',"#example1 .delete",function(){
							
			var r = confirm("¿Está seguro que quiere eliminar los detalles del taxi? ");
			if (r == true) {
				var th=$(this);			
				var id = $(this).attr('title');
				
				
				$.ajax({
					url:'<?php echo base_url();?>admin/delete_taxi',
					type:'post',
					data:{'id':id},
					success:function(cancel){
            $(".editbook").show();
					console.log(cancel);
					if(cancel==1){
            $(".editbook").html('<p class="success">Eliminado satisfactoriamente</p>');
  setTimeout(function(){$(".editbook").hide(); }, 3000);
					th.hide();
					location.reload();
					
					
					
					}
					else{
					         $(".editbook").html('<p class="error">Error!! </p>');
setTimeout(function(){$(".editbook").hide(); }, 3000);
					}
					}
				});  								
			}

        });	

});	
    </script>
  </body>
</html>
