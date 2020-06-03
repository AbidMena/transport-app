<!--payment-->
<?php
$user = $this->session->userdata('username');
$bookid = $book_info->uneaque_id;
// print_r($bookid);die();
 $query = $this->db->query(" SELECT * FROM `bookingdetails` where username='$user' AND uneaque_id='$bookid'");
 $row = $query->row('bookingdetails');
 $promo =$row->promo_code;
  // print_r($promo);die();
?>

<div class="container-fluid" style="background: #eeeeee;">

<div class="container">

    <div class="col-lg-2"></div>

    <div class="col-lg-8">



        <div class="row pay-wallet success-mn">

            <div class="col-lg-6">

        <h3 class="success-h3"><span><img src="<?php echo base_url();?>assets/img/payment/3.png" /></span>Booking is Progress</h3>

            </div>

            <div class="col-lg-6">

                <h3 class="success-h3-1"><strong class="str-success">Your Booking ID is </strong> <?php echo $book_info->uneaque_id; ?></h3>

            </div>

        </div>





                      <div class="row">

                          <div class="col-lg-8">

                              <div class="left-success">

                                  <dl>

                                      <dt>Taxi</dt>

                                      <dd>: <?php echo $book_info->taxi_type; ?></dd>

                                      <dt>Date and Time</dt>

                                      <dd>:<?php echo date('D, d M',strtotime($book_info->pickup_date)).','.$book_info->pickup_time; ?></dd>

                                      
                                      <dt>From</dt>

                                      <dd>: <?php echo $book_info->pickup_area; ?></dd>
<?php
if($book_info->drop_area!=""){
?>
    <dt>To</dt>

    <dd>: <?php echo $book_info->drop_area; ?></dd>
<?php
}
?>
                                  



                                      <dt>Pickup Address</dt>

                                      <dd>: <?php echo $book_info->pickup_address; ?></dd>

                                      <dt>Landmark</dt>

                                      <dd>: <?php echo $book_info->landmark; ?></dd>
<?php
if($promo!=""){
  $query1 = $this->db->query("SELECT * FROM `promocode` where promocode='$promo'");

  // echo $this->db->last_query();
  $row1 = $query1->row();
  $amt =$row1->amount; 
  if($row1->type=='Fixed'){
        $promo_amount = $amt;
  }else{
  $promo_amount = (($book_info->amount * $amt)/100);
  }
 $total_amt = $book_info->amount-$promo_amount;
?>

                                      <dt>Total Amount</dt>
                                      <dd>:<?php echo $book_info->amount; ?>/-</dd>
                                      <dt>You saved</dt>
                                      <dd>:<?php echo $promo_amount; ?>/-</dd>
                                      <?php
                                      }
                                      ?>

                                  </dl>
                                    <?php
                                    if($promo!=""){
                                    ?>
                  <h5>Total Amount Payable<span><?php echo $total_amt; ?>/-</span>
                                 </h5>
                                 <?php
                                  }else{
                                  ?>

                                  <h5>Total Amount Payable<span><?php echo $book_info->amount; ?>/-</span></h5>
                                  <?php
                                  }
                                  ?>

                              </div>

                          </div>

                          <div class="col-lg-4">

                          <div class="right-success">

                            <img src="<?php echo base_url();?>assets/img/payment/4.png" class="img-responsive" />

                              <h4>Track Booking on your </h4>

                              <h5>Mobile App</h5>

                              <a href="https://play.google.com/store/apps/details?id=com.techware.callMyCab" target="blank">Download </a>

                          </div>

                              </div>

                      </div>







    </div>

    <div class="col-lg-2"></div>

</div>



</div>



<!--payment-->



