      <aside class="main-sidebar menu-full">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/adminlte/dist/img/default-160x160.gif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($this->session->userdata('role-admin'))?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
         <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->



          <ul class="sidebar-menu">
          <?php

           $user2 = $this->session->userdata('permission');


		   $id = $user2;

		   $page_name = array();


		   $rows = $this->db->query(" SELECT * FROM `role_permission` WHERE page_id='$id' ")->row();

			$page_name = explode(',', $user2);




		    if( in_array('9',$page_name) || in_array('1',$page_name))
            {
              ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Usuarios App</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php
            if((in_array('9',$page_name)) )
            {?>
                <li><a href="<?php echo base_url();?>admin/userlist"><i class="fa fa-circle-o"></i>Ver Todos</a></li>
				<?php
			}if((in_array('1',$page_name)) ){
			?>
                <li><a href="<?php echo base_url();?>admin/adduser"><i class="fa fa-circle-o"></i>Agregar Nuevo</a></li>
				<?php
			}?>
              </ul>
            </li>

 
          
			<?php
			}if( in_array('31',$page_name) || in_array('3',$page_name))
            {
              ?>


			 <li class="treeview">
              <a href="#">
                <i class="fa fa-empire"></i> <span>Administrar Conductor</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php

					if( in_array('31',$page_name)){

					?>
                <li><a href="<?php echo base_url();?>admin/view_driver"><i class="fa fa-circle-o"></i>Ver Todos</a></li>
				<?php
					}
					if( in_array('3',$page_name)){

					?>
                <li><a href="<?php echo base_url();?>admin/add_driver"><i class="fa fa-circle-o"></i>Agregar Nuevo</a></li>
				<?php
					}
					?>
              </ul>
            </li>
			<?php
			}

					if( in_array('40',$page_name)){

					?>
			<!--<li>
              <a href="<?php echo base_url();?>admin/view_airmanage">
                <i class="fa fa-plane"></i> <span>Administrar Aeropuerto</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
			</li>-->
			<?php
					}if( in_array('43',$page_name)){
					?>
			<!--<li>
              <a href="<?php echo base_url();?>admin/view_package">
               <i class="fa fa-road"></i>
      <span>Administrar Equipaje</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
			</li>-->
<?php
					}
if( in_array('4',$page_name)){
					?>
             <li>
             <a href="<?php echo base_url();?>admin/add_settings"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Herramientas<span class="fa arrow"></span></a></li>
              <li>
			  <?php
}
if( in_array('26',$page_name)){
					?>
			<li>
			  <a href="<?php echo base_url();?>admin/role_management"><i class="fa fa-user"></i>&nbsp;&nbsp;Administrar Rol<span class="fa fa-angle-left pull-right"></span></a></li>
              </a>
			</li>
			<?php
}if( in_array('33',$page_name)){
					?>

		     <li>
			   <a href="<?php echo base_url();?>admin/backened_user">
                <i class="fa fa-toggle-on	"></i> <span>Usuarios del sistema</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
			</li>
			<?php
}
if( in_array('49',$page_name)){
					?>



			 <!-- <li>
			 <a href="<?php //echo base_url();?>admin/view_language"><i class="fa fa-language"></i>
&nbsp;&nbsp;Language <span class="fa fa-angle-left pull-right"></span></a></li> -->

     <li class="treeview">
        <a href="#">
          <i class="fa fa-language"></i> <span>Traducción de Lenguaje</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>admin/view_language"><i class="fa fa-circle-o"></i> Lenguaje para Web</a></li>
          <li><a href="<?php echo base_url();?>admin/languageChageForUserApp"><i class="fa fa-circle-o"></i>Lenguaje para App Usuario</a></li>
          <li><a href="<?php echo base_url();?>admin/languageChageForDriverApp"><i class="fa fa-circle-o"></i>Lenguaje para App Conductor</a></li>
        </ul>
      </li>
<?php
}
?> 
  </ul>

        </section>
        <!-- /.sidebar -->
      </aside>

<?php
/*
}

if( in_array('52',$page_name)){
?>
	 		   <li>
			 <a href="<?php echo base_url();?>admin/view_page"><i class="fa fa-wrench"></i>


&nbsp;&nbsp;Front end<span class="fa fa-angle-left pull-right"></span></a></li>
			 <?php
}
if( in_array('55',$page_name)){
?>

         <li class="treeview">
			   <a href="<?php echo base_url();?>admin/view_pages">
                <i class="fa fa-adjust"></i>
 <span>Pages</span> <i class="fa fa-angle-left pull-right"></i>
              </a>


			</li>
	        <?php
}if( in_array('61',$page_name)){
?>

 <li>
			  <a href="<?php echo base_url();?>admin/wallet_list"><i class="fa fa-money"></i>


&nbsp;&nbsp;Wallet<span class="fa fa-angle-left pull-right"></span></a></li>
              </a>
			</li>
<?php
}

if( in_array('62',$page_name)){
?>

 <li>
			  <a href="<?php echo base_url();?>admin/callback_list"><i class="fa fa-google-wallet"></i>

&nbsp;&nbsp;Callback<span class="fa fa-angle-left pull-right"></span></a></li>
              </a>
			</li>
<?php
}
?> 
 */
        
