 <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b> 
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="http://www.adisingenieros.com">ADIS Ingenieros</a>.</strong> All rights reserved.
      </footer>
	  <script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      
	  <script>
   $(document).ready(function(){
	  
       var url      = window.location.href;
      $('.sidebar-menu li a').each(function(){
        var li_url=$(this).attr('href');
          if(li_url==url){
           $(this).parents('li').addClass('active');
           }
        });

   
   });
       
   </script>