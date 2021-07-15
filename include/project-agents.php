  <section class="py-5" style="background-color: #fffeee !important;">
    
      <div class="container">
          <h3 class="py-4" style="font-weight: 700;font-size: 37px;">Our <?php echo $res['name']; ?> Specialist</h3>
        <div class="row">

 <?php 
 // $agents=explode('++',$res['agent']);
// $agents=implode('++',$res['agent']);

  foreach ($agents as $hik) {

$selec="SELECT * FROM agent_master WHERE id IN ($hik)";
$qss=mysqli_query($conn, $selec); 
if (!$qss) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($ress=mysqli_fetch_array($qss)){

        ?>     


<div class="col-lg-4 col-md-6 mb-3 col-sm-12 col-12">
            <div style="background-color: white;border-radius: 15px;box-shadow: 2px 13px 2px 10px solid black;" class="p-3 py-4">
              <div class="row px-2">
                
         <div class="col-lg-5 col-sm-5 col-5 col-md-5 mx-auto">

      <a href="agent-profile.php?agid=<?php echo $ress['id'];?>" >      <div style="background-image:url('admin/img/<?php echo $ress['photo']; ?>');background-size: cover; background-position: center;border-radius: 50%;width:120px;height: 120px;border:4px solid #f1f1f1;">
            
          </div></a>


         </div>

                 
          

                   <div class="col-lg-7 col-sm-7 col-7 col-md-7 mx-auto">
                  
                    <div class="">
                      <h4 style="font-size: 21px;color: black;font-weight: 600;"><?php echo $ress['name'] ?></h4>
                      <h4 style="font-size: 16px;color: black;font-weight: 500;margin-top: -3%;">Speaks: <?php echo $ress['languagespeaks'] ?></h4>
                    <h4 style="font-size: 16px;color: black;font-weight: 500;margin-top: %;"><?php echo $ress['role'] ?></h4>

                    </div>

                    <div class="row pt-3">
                      
                      <div class="col-lg-5 col-sm-5 col-5 col-md-5">
                        <a href="agent-profile.php?agid=<?php echo $ress['id'];?>" class="" style="border-radius: 3px;border: 1px solid orange;color: orange;padding:4px 10px;"> Profile</a>
                      </div>

                       <div class="col-lg-7 col-sm-7 col-7 col-md-7">
                        <a href="https://wa.me/<?php echo $ress['phoneno']; ?>?text=Hello%20<?php echo $ress['name']; ?>%20I%20am%20interested%20in%20project%20<?php echo $res['name']; ?>%20on%20redlionrealestate " class="" style="border-radius: 3px;border: 1px solid orange;color: white;padding:4px 10px;background-color: orange;"> Whatsapp</a>
                      </div>


                    </div><!----inner-button-row--->
                  
                </div>


              </div><!--inner-row----------->


              
            </div>
          </div><!---------col-lg-4---------->


        <?php } } ?> 


</div><!--------------row---------------->
</div>
       
</section>