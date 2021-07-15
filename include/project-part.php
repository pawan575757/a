<?php 



                  
                  // if(isset($_GET['catid'])){
                  //   $cat_id = $_GET['catid'];

                  //   $sql1 = "SELECT * FROM cat_master WHERE catid = {$cat_id}";
                  //   $result1 = mysqli_query($conn, $sql1) or die("Query Failedd.");
                  //   $row1 = mysqli_fetch_assoc($result1);


                  

//................................ Property Table -------------------------------//
 $selectquery= " select * from projects WHERE status = 1 ORDER BY projects.projid DESC LIMIT 20 " ;   

$query=mysqli_query($conn, $selectquery) 
  or die("Error: ".mysqli_error($conn));

//$num = mysqli_num_rows($query);

while($res=mysqli_fetch_array($query)){
$id=$res['projid'];
;

//................................ User Table -------------------------------//


       // $query1=mysqli_query($conn,"select * from admin_user");
       //  $admin=mysqli_fetch_array($query1);
        
       //  $u_name=ucfirst($admin['email']);


//................................ City Table -------------------------------//


// $query2=mysqli_query($conn,"select * from user, admin_user WHERE user_id = ".$res['author']);
//         $admin1=mysqli_fetch_array($query2);
        
        // $name1=ucfirst($admin1['username']);

    // $sel_city = mysqli_query($conn, "SELECT * FROM city_master WHERE cityid = ".$res['cityid']);
    // $row_city = mysqli_fetch_array($sel_city);

    //................................ Location Table -------------------------------//


    $sel_location = mysqli_query($conn, "SELECT * FROM location_master WHERE locationid = ".$res['location']);
    $row_location = mysqli_fetch_array($sel_location);

    //......................... Rent/Sell Type Table -------------------------------//

    
    //  $sel_type = mysqli_query($conn, "SELECT * FROM type_master WHERE typeid = ".$res['typeid']);
    // $row_type = mysqli_fetch_array($sel_type);
    
 $sel_developer = mysqli_query($conn, "SELECT * FROM developer_master WHERE developerid = ".$res['developer']);
    $row_developer = mysqli_fetch_array($sel_developer);


    //  $sel_agent = mysqli_query($conn, "SELECT * FROM agent_master WHERE id = ".$res['agent']);
    // $row_agent = mysqli_fetch_array($sel_agent);


    //  $sel_cat = mysqli_query($conn, "SELECT * FROM cat_master WHERE catid = ".$res['catid']);
    // $row_cat = mysqli_fetch_array($sel_cat);



                        
        ?>    
<?php
$naam= $res['name'] ;
$firstCharacter = $naam[0];


?>


<div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-5 " >

        <div class="py-3" style="box-shadow: 0 0 12px 1px #477d8a28!important;border-radius: 10px;">

          <div class="row mx-auto" ><!--inner row---------->

               <div class="col-lg-2 col-sm-2 col-md-2 col-2 text-center align-middle" >
                       <div style="border-radius: 50%;background-color: #D7BEB5;font-weight: 700;font-size: 26px;width: 50px !important;height: 50px;"><p style="padding-top: 7px;text-transform: uppercase;"><?php echo $firstCharacter; ?></p></div> 
                </div>


               <div class="col-lg-8 col-sm-8 col-md-8 col-8 text-left align-middle" >
                           
                           <div>
                       <a href="project-details.php?pid=<?php echo $res['projid'];?>" style="font-size: 20px;font-weight: 700;color: black;text-decoration: none;"> 
<?php echo $res['name']; ?></a>
                         <a href="project-details.php?pid=<?php echo $res['projid'];?>" style="color: black;text-decoration: none;">     <p style="font-size: 15px;margin-top: -2px;">By <?php echo $row_developer['name']; ?></p> </a>
                           </div>

               </div>

               <div class="col-lg-2 col-sm-2 col-md-2 col-2 text-center align-middle mt-2">
                           
                       <a href="project-details.php?pid=<?php echo $res['projid'];?>">     <div>
                            <i class="fa fa-chevron-right fa-2x"></i>
                            
                           </div></a>

               </div>

        </div><!-----------inner --------------row----------->
                
       <a href="project-details.php?pid=<?php echo $res['projid'];?>" >          <div class="p-0">
                  <img class="p-0 d-none d-lg-block d-xl-block d-md-block" src="https://cloud.famproperties.com/project/large/375/port-de-la-mer-344521-130225.jpg" style="width: 100%;height: 230px;object-fit: fill;">
                  
                   <img class="p-0 d-block d-lg-none d-xl-none d-md-none" src="https://cloud.famproperties.com/project/large/375/port-de-la-mer-344521-130225.jpg" style="width: 100%;height: 270px;object-fit: cover;">
                </div></a>

              
              <div class="py-2 text-center mx-auto" style="border-bottom: 1px solid #f2f1f2;"><!-------------- GALEERY BUTTONS--------->
                <div class="row px-2 text-center ">
                  
                   <div style="" class="col-lg-3 col-md-3 col-sm-3 col-3 ">
                    <a href="#" style="text-decoration: none;" class="btn bg-warning px-4">Maps</a>
                       </div>
                       
                        <div style="overflow: hidden !important;" class="col-lg-5 col-md-5 col-sm-5 col-5 ">
                   <a href="#" style="text-decoration: none;overflow: hidden;" class="btn bg-warning px-3">Floor Plans</a>
                    </div>
                       
                  <div class="col-lg-4 col-md-4 col-sm-4 col-4 " style="overflow: hidden !important;margin-left:-30px !important;">
                    <a href="#" style="text-decoration: none;overflow: hidden;" class="bg-warning btn px-4">Gallery</a>
                      </div>


                   

                     


                </div><!--------btn-row------------>

           </div><!-------------- GALEERY BUTTONS--------->


           <div class="py-2" style="border-bottom: 1px solid #f2f1f2;">
            <!--------------price----------------->
             <?php 
             $price_number= $res['price'];

 $number_format_vietnam = number_format($price_number, 3, ',', ',');

?>
             <div class="px-2" style="font-size: 18px;font-weight: 500;color: #3e3e3e;">Price From <span style="font-size: 20px;font-weight: 700 !important;color: black;"><?php echo $number_format_vietnam; ?> AED</span></div>

           </div><!-------------------price end -------------------->
             
             <div class="py-2"><!---------bottom footer------------------->
               
               <div class="row px-2">

                <div class="col-lg-6 col-sm-6 col-md-6 col-6 text-left">
                  
                  <div><i class="fa fa-map-marker fa-x"></i> <span> <?php echo $row_location['name']; ?></span> </div>

                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-6 text-right">
                  
                               <div style="font-size: 15px !important;font-weight: 500;">
                                <?php 

                                if($res['plan'] == 1){
                                  echo"Off Plan";
                                }
                                else{
                                 echo "Ready To Move";
                                }

                                ?>
                              </div>

                </div>


<!----------- views -------------------->
                    

                    <div class="col-lg-5 col-sm-5 col-md-5 col-5 text-left">
                  
                  <div><i class="fa fa-eye fa-x"></i> <span>3,320 Views</span> </div>

                </div>

                <div class="col-lg-7 col-sm-7 col-md-7 col-7 text-right">
                              
                              
                      <div style="font-size: 14px;font-weight: 500;">
                 <?php  $cat=explode('++',$res['catid']); ?>


                              
                              <?php echo strtr($cat[0],'[]','++'); 

                                   
                             
                      ?>
                          
                              </div>

                </div>

               </div><!--------footer row end ---------------->

             </div><!-----------bottom footer end ----------->


      </div><!--------inner div-------------->

      </div><!----------col---------------->
      


      <?php } 



 ?>