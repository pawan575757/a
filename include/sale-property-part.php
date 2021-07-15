<?php 



                  
                  if(isset($_GET['catid'])){
                    $cat_id = $_GET['catid'];

                    $sql1 = "SELECT * FROM cat_master WHERE catid = {$cat_id}";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failedd.");
                    $row1 = mysqli_fetch_assoc($result1);


                  

//................................ Property Table -------------------------------//
 $selectquery= " select * from property WHERE property.catid = {$cat_id} AND typeid = 1 ORDER BY property.proid DESC LIMIT 20 " ;   

$query=mysqli_query($conn, $selectquery) 
  or die("Error: ".mysqli_error($conn));

//$num = mysqli_num_rows($query);

while($res=mysqli_fetch_array($query)){
$id=$res['proid'];
$img=$res['image'];

//................................ User Table -------------------------------//


       // $query1=mysqli_query($conn,"select * from admin_user");
       //  $admin=mysqli_fetch_array($query1);
        
       //  $u_name=ucfirst($admin['email']);


//................................ City Table -------------------------------//
$query2=mysqli_query($conn,"select * from user, admin_user WHERE user_id = ".$res['author']);
        $admin1=mysqli_fetch_array($query2);
        
        // $name1=ucfirst($admin1['username']);

    $sel_city = mysqli_query($conn, "SELECT * FROM city_master WHERE cityid = ".$res['cityid']);
    $row_city = mysqli_fetch_array($sel_city);

    //................................ Location Table -------------------------------//


    $sel_location = mysqli_query($conn, "SELECT * FROM location_master WHERE locationid = ".$res['locationid']);
    $row_location = mysqli_fetch_array($sel_location);

    //......................... Rent/Sell Type Table -------------------------------//

    
     $sel_type = mysqli_query($conn, "SELECT * FROM type_master WHERE typeid = ".$res['typeid']);
    $row_type = mysqli_fetch_array($sel_type);
    
 $sel_developer = mysqli_query($conn, "SELECT * FROM developer_master WHERE developerid = ".$res['developer']);
    $row_developer = mysqli_fetch_array($sel_developer);


     $sel_agent = mysqli_query($conn, "SELECT * FROM agent_master WHERE id = ".$res['agent']);
    $row_agent = mysqli_fetch_array($sel_agent);


     $sel_cat = mysqli_query($conn, "SELECT * FROM cat_master WHERE catid = ".$res['catid']);
    $row_cat = mysqli_fetch_array($sel_cat);
                        
        ?>    




<div style="" class="col-lg-9 mx-auto col-12 col-sm-12 col-md-12 mb-5">

    <div class="row">


 

<?php 

// $name = implode('++',$_FILES['file']['name']);

$name = explode('++',$res['image']);

?>




        <div class="col-lg-5 col-md-12 col-12 col-sm-12 col-12 p-0">
               <div class="d-none d-lg-block d-xl-block img-hover-zoom"><a href="prop-desc.php?mid=<?php echo $res['proid'];?>"><img class="d-none d-lg-block d-xl-block" src="admin/images/<?php echo strtr($name[0],'[]','++'); ?>" alt="..." style="width: 100%;height: 282px;object-fit: fill;object-position: center;border-top-left-radius: 15px;border-bottom-left-radius: 15px;">
               </a>
</div>
              <a href="prop-desc.php?mid=<?php echo $res['proid'];?>">  <img class="d-block d-lg-none d-xl-none" src="admin/images/<?php echo strtr($name[0],'[]','++'); ?>" alt="..." style="width: 100%;height: 320px;object-fit: fill;object-position: center;border-top-left-radius: 15px;border-top-right-radius: 15px;">
              </a>

                         <div class="agent" style=" ">

                         <a href="prop-desc.php?mid=<?php echo $res['proid'];?>">     <h5 style="font-size: 14px;"><?php echo $row_agent['name'] ?></h5></a>
                         </div>

                         <div class="thumb-img" style="background-image:url('admin/img/<?php echo $row_agent['photo']?>');background-size: cover;"></div>

         </div><!--------------col-lg-5 end ------------------>





         <div class="col-lg-7 col-md-12 col-12 col-sm-12  col-12  px-0" style="box-shadow: 0 0 12px 1px #477d8a28!important;">

             <div>

                 <div class="row  py-2 px-2">

                     <div class="col-lg-8 col-md-8 col-8 col-sm-8 ">
            
                          <span style="font-size: 21px;font-weight: 600;color: #404952 !important;">Price AED <?php echo $res['price']?>
                          </span>
             
                           <p style="font-size: 15px;font-weight: 500;color:#858585;margin-top:-20px !important;">AED per sqft
                            </p>
                     </div><!------------col-lg-8--------->

                    
                     <div class="col-lg-4 col-md-4 col-4 col-sm-4 text-right " >
                         <a href="" class="btn p-1 " style="background-color: #F6F4F2 !important;border:1px solid #f1f1f1;"><img src="icon/heart.png" width="30px" height="30px"></a> 

                          <a href="" class="btn p-1 " style="background-color: #F6F4F2 !important;border:1px solid #f1f1f1;"><img src="icon/forward.png" width="30px" height="30px"></a>

                     </div><!--------col-lg-4------------->


    <!----------title------------->
                   </div><!-- pricing row------------>

              </div><!----------before -------pricing ------row------->

        <div class="text-uppercase px-2 " style="margin-top:-36px !important;"><!-----------title------------->
        <a href="prop-desc.php?mid=<?php echo $res['proid'];?>">    <span style="font-size: 15px;font-weight: 700;color:#2e2e2e;"><?php echo $res['title'] ?> 

             </span>
         </a>

          </div>


          <div class="pt-3 px-0 pb-2" style="border-bottom: 1px solid black;padding-left: 0px !important;padding-right: 0px !important;">

            <ul class="features p-0" style="list-style-type: none !important;display: inline !important;list-style: inline !important;">

              <li class="px-2" style="display: inline;font-size: 15px;"> <span><i class="fa fa-bed u-color-25-text"></i> <?php echo $res['bedroom'] ?>  Bed</span>  </li>
              <li class="px-2" style="display: inline;font-size: 15px;"> <span><i class="fa fa-bath u-color-25-text"></i> <?php echo $res['bathroom'] ?>  Bath</span>  </li>
              <li class="px-2" style="display: inline;font-size: 15px;"> <span><i class="fab fa-uncharted u-color-25-text"></i> <?php echo $res['lot_size'] ?>  sq.ft</span>  </li>

            </ul>
                     

          </div>

          <div class="px-2">
           <a href="prop-desc.php?mid=<?php echo $res['proid'];?>" style="text-decoration:none; font-size: 14px !important;font-weight: 700 !important;color: black;"> <span><i class="fa fa-map-marker"></i> <?php echo $row_location['name'] ?>, <?php echo $res['address'] ?>  </span></a>
          </div>

          <div class="pt-2 px-2 pb-3">
           <a href="prop-desc.php?mid=<?php echo $res['proid'];?>" style="text-decoration:none; font-size: 14px !important;font-weight: 600 !important;color: #a9a29e;"> <span><?php echo $row_cat['name'] ?>  for <?php echo $row_type['name'] ?>  in <?php echo $row_location['name'] ?></span></a>
          </div>



          <div class=" pt-2 pb-4" style="background-color: #F6F4F2;"><!-----------footer buttoon-->

            <div class="row px-2 pt-2">

              <div class="col-lg-7 col-md-6 col-sm-7 col-7 pl-4 pt-1">
                
                <div>
                  <a class="mx-1" href="tel: <?php echo $row_agent['phoneno'] ?>" style="background-color: white;border-radius: 50%;padding: 10px;
    justify-content: center;
    align-items: center;"><img src="icon/phone.png" width="23px" height="23px"></a>


                                    <a class="mx-1" href="https://wa.me/<?php echo $row_agent['phoneno'] ?>?text=I'm%20interested%20in%20your%20property%20for%20sal" style="background-color: white;border-radius: 50%;padding: 10px;
    justify-content: center;
    align-items: center;"><img src="icon/whatsapp.png" width="23px" height="23px" style="margin-top: -3px !important;margin-left: 1px !important;"></a>

<a class="mx-1" href="mailto: <?php echo $row_agent['email'] ?>" style="background-color: white;border-radius: 50%;padding: 10px;
    justify-content: center;
    align-items: center;"><img src="icon/email.png" width="23px" height="23px" style="margin-top: -3px !important;margin-left: 1px !important;"></a>
                </div>

              </div><!---col-lg-6--------->

               <div class="col-lg-5 col-md-6 col-sm-5 col-5 pl-4 pt-1 text-right">
                
                <div>
                  <a class="mx-1" href="" style="background-color: white;border-radius: 25px;padding: 8px 16px;text-decoration: none;color: black;"><img src="icon/user.png" width="23px" height="23px"> Follow</a>

                </div>

              </div><!---col-lg-6--------->
              
            </div><!--------footer button -row--------->

          </div><!-----------footer buttoon-->



          </div><!------col-lg-5---------->


          
           
        
  

</div><!-----------row-------------->
</div>


<?php } }

else{
  echo "<h2>No Record Found</h2>";
}

 ?>
