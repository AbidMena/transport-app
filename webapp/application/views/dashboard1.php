<!DOCTYPE html>
<html>
  <?php
	 include "includes/admin_header.php";
	 ?>
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
          <h1>
            Welcome to User Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
		
		
		<section class="content">
          <!-- Small boxes (Stat box) -->
      
		  
		      
			
			
		
		
		 <!-- ./col -->
			
			<!-- ./col -->
		
			
		<!-- ./col -->
			
			
			
	
		  <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable ui-sortable">
              <!-- Custom tabs (Charts with tabs)-->
             <!-- /.nav-tabs-custom -->

              <!-- Chat box -->
              <!-- /.box (chat box) -->

              <!-- TO DO List -->
             

              <!-- quick email widget -->
             
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
              
               <!-- /.box-body-->
                <div class="box-footer no-border">
                  <div class="row">
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                      <div id="sparkline-1"></div>
                      <div class="knob-label"></div>
                    </div><!-- ./col -->
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                      <div id="sparkline-2"></div>
                      <div class="knob-label"></div>
                    </div><!-- ./col -->
                    <div class="col-xs-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="knob-label"></div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
                </div>
              </div>
              <!-- /.box -->

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <?php
	 include"includes/admin-footer.php";
	 ?>


      
     
    </div><!-- ./wrapper -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    
    <!-- jQuery 2.1.4 -->
     <script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
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
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/knob/jquery.knob.js"></script>
	
    <!-- DataTables -->
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/flot/jquery.flot.min.js"></script>
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/flot/jquery.flot.resize.min.js"></script>
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/flot/jquery.flot.pie.min.js"></script>
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/flot/jquery.flot.categories.min.js"></script>
 
	 <!-- chart -->
   
	 <script src="<?php echo base_url();?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	
   
    <?php
   $query = $this->db->query("Select `purpose`,count(id) as count From `bookingdetails` Group by `purpose`  ");
   $rows =$query->result();
   //$arr[]='Month,Point';
   //print_r($query->result());
   foreach ($query->result()  as $row) {
	
	 $purpose[] = $row->purpose;
	 $count[]= $row->count;
    }
$color=array("#3c8dbc","#0073b7","#00c0ef","#0073b7");

$query1 = $this->db->query("Select `country`,count(id) as count From `visits` Group by `country`  ");

?>
  
 <script>
   $(function () {
       
        var data = [], totalPoints = 100;

        var donutData = [
		<?php
		for($i=0;$i<4;$i++){
			?>
		
          {label: "<?php echo $purpose[$i];?>  ", data: <?php echo $count[$i];?>, color: "<?php echo $color[$i];?>"},
		  <?php
		}?>
          
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.5,
              label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        });
        /*
         * END DONUT CHART
         */

		      });

      /*
       * Custom Label formatter
       * ----------------------
       */
      function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                + label
                + "<br>"
                + Math.round(series.percent) + "%</div>";
      }
	   $(".knob").knob();

  //jvectormap data
  var visitorsData = {
	  
   <?php
	foreach ($query1->result()  as $row1) {
	 
	  
	 
	 $purpose = $row1->country;
	 $count= $row1->count;
	 echo '"'.$purpose.'":'.$count.',';
	
    }
  ?>
  
  };
  //World map by jvectormap
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: "transparent",
    regionStyle: {
      initial: {
        fill: '#e4e4e4',
        "fill-opacity": 1,
        stroke: 'none',
        "stroke-width": 0,
        "stroke-opacity": 1
      }
    },
    series: {
      regions: [{
          values: visitorsData,
          scale: ["#92c1dc", "#ebf4f9"],
          normalizeFunction: 'polynomial'
        }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != "undefined")
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });


    </script>
	 
  </body>
</html>
