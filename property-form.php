    <?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
  ?>   

   <h4 class=" text-center pb-3" style="font-size:44px;color: black;font-weight:600;">Book Your Viewing</h4>

                             <div class="form col-lg-5 col-md-8 col-sm-12 col-12 mx-auto mb-5">

                                <form class="form" method="POST" action="">

                                  <input type="hidden" name="iid" value=" <?php echo $res['proid']; ?> <?php echo $res['title']; ?>" > 
                                  
                                  <div class="form-group">
                                   <input type="date" name="date" class="form-control" placeholder="date">
                                  </div>

                                      <div class="row">
                                  <div class="form-group col-lg-6 col-6">
                                   <input type="text" name="name" class="form-control" placeholder="Name">
                                  </div>

                                   <div class="form-group col-lg-6 col-6">
                                   <input type="text" name="phone" class="form-control" placeholder="Mobile">
                                  </div>
                                </div>


                                   <div class="form-group">
                                   <input type="text" name="email" class="form-control" placeholder="Email">
                                  </div>

                                  <div class="form-group">
                                   <textarea type="textarea" name="message" class="form-control" placeholder="Message" rows="4" cols="50"></textarea>
                                  </div>

                                  <input type="submit" name="submit" value="Request Info" class="btn form-control btn-info">

                                </form>
                              
                             </div>


                        <?php 

                             if(isset($_POST['submit']))

 {
   $iid = $_POST['iid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    $qry_ins = "INSERT INTO `property_form` (`name`,`phone`,`email`,`date`,`iid`,`message`) VALUES ('".$name."','".$phone."','".$email."','".$date."','".$iid."','".$message."')";



      $check=mysqli_query($conn,$qry_ins) or die("Error: ".mysqli_error($conn)); 

      if(!$check){

      }
}

         ?>