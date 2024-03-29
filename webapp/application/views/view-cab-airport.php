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
          <h1 class="page-header"> Airport Transfer <a href ="<?php echo base_url();?>admin/taxi_details_air"  class="btn btn-default">Add New</a></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">TD</a></li>
            <li class="active">Airport Transfer</li>
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
                  <table id="exampleg" class="table table-bordered table-striped">
  <?php
  $query = $this->db->query(" SELECT * FROM `settings` order by id DESC ");
		$row = $query->row('settings');
		$mesr = $row->measurements;
								 $query1 = $this->db->query("SELECT * FROM  cabdetails WHERE transfertype='Airport Transfer' ORDER BY id DESC");
								?>
								
                                
                                    <thead>
                                        <tr>
                                            <th>Taxi</th>
                                            
                                            <th colspan="2">Intial <?php echo $mesr;?><br>
                                                (To / From)</th>
                                            <th colspan="2">Intial Rate<br>
                                                (To / From)</th>
                                            <th colspan="2">Standard Rate<br>
                                                (To / From)</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
		
       foreach($query1->result_array('cabdetails') as $row1){
        ?>
                                    
                                        <tr class="odd gradeX" >
                                            <td class="center"> <?php echo $row1['cartype'];?></td>
                                           
                                            <td class="center"> <?php echo $row1['intialkm'];?></td>
                                            <td class="center"> <?php echo $row1['fromintialkm'];?></td>
                                            <td class="center"> <?php echo $row1['intailrate'];?></td>
                                             <td class="center"> <?php echo $row1['fromintailrate'];?></td>
                                             <td class="center"> <?php echo $row1['standardrate'];?></td>
                                               <td class="center"> <?php echo $row1['fromstandardrate'];?></td>
                                               <td class="center"> <?php if($row1['timetype']=='day'){ echo'Day(6:00AM-10:00PM)';}else{ echo'Night(10:00PM-6:00AM)';}?></td>
                                             
                                            <td class="center"><a href="<?php echo base_url();?>index.php/admin/edit_airport_taxi?idtaxi=<?php echo $row1['id'];?>" > <i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a href="#" title="<?php echo $row1['id'];?>" class="delete"><i class="fa fa-trash-o "></i></a></td>
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

      <!-- Control Sidebar -->
      
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
 $(document).on('click',"#exampleg .delete",function(){
						
			var r = confirm("Are you sure want to delete the Taxi details ");
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
         $(".editbook").html('<p class="success">Delete Successfully</p>');
  setTimeout(function(){$(".editbook").hide(); }, 3000);
					th.hide();
					location.reload();
					
					
					
					}
					else{
					$(".editbook").html('<p class="error">Error!!! </p>');
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
