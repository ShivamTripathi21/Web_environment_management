<?php
session_start();
 if($_SESSION['authentication']){
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    
    $query="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    
    $f_name=$row['f_name'];
    $l_name=$row['l_name'];
    
?>

                  <div class="user_box" id="user_box">
                      <center>
                         <div class="user_menu" style="width: inherit;height: 160px;">
                            <div style="width: inherit;height: 20px;"></div>
                            <div style="width: inherit;height: 65px">
                               <center>
                                   <img src="../img/user.png" style="width: 50px;height: 50px;">
                               </center>
                            </div>
                            <div style="width: inherit;height: 30px">
                                <span style="line-height: 2;font-size: 15px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;color:#4e535a;text-transform: capitalize;white-space: nowrap;">
                                   <?= $f_name.' '.$l_name; ?>
                                </span>
                                <br>
                                <span style="color: #96A3B6;font-size: 15px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;white-space: nowrap;">
                                    <?= $row['email']; ?>
                                </span>
                            </div>
                         </div>
                         
                         <div class="user_menu">
                             <center>
                                <div style="width: 250px;height: 24px;padding-bottom: 8px;padding-top: 8px;">
                                    <div style="width: 50px;height: inherit;float: left">
                                       <img src="../img/settings.png" style="float: left;width: 20px;height: 20px;">
                                    </div>
                                    <div style="width: auto;height: inherit">
                                         <span style="padding-top: 2px;float: left;font-size: 14px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;color:#7b6eda;text-transform: capitalize;white-space: nowrap;">
                                            Account settings
                                         </span>
                                    </div>
                                </div>
                             </center>
                         </div>
                         <div class="user_menu">
                             <center>
                                <div style="width: 250px;height: 24px;padding-bottom: 8px;padding-top: 8px;">
                                    <div style="width: 50px;height: inherit;float: left">
                                       <img src="../img/tour.png" style="float: left;width: 20px;height: 20px;">
                                    </div>
                                    <div style="width: auto;height: inherit">
                                         <span style="padding-top: 2px;float: left;font-size: 14px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;color:#7b6eda;text-transform: capitalize;white-space: nowrap;">
                                            Quick Tour
                                         </span>
                                    </div>
                                </div>
                             </center>
                         </div>
                         <a href="../logout.php">
                         <div class="user_menu">
                             <center>
                                <div style="width: 250px;height: 24px;padding-bottom: 8px;padding-top: 8px;">
                                    <div style="width: 50px;height: inherit;float: left">
                                       <img src="../img/logout.png" style="float: left;width: 20px;height: 20px;">
                                    </div>
                                    <div style="width: auto;height: inherit">
                                         <span style="padding-top: 2px;float: left;font-size: 14px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;color:#7b6eda;text-transform: capitalize;white-space: nowrap;">
                                            Sign out
                                         </span>
                                    </div>
                                </div>
                             </center>
                         </div>
                         </a>
                         
                         
                      </center>              
                  </div>
  
<?php
 }
 else{
     
 }
?>