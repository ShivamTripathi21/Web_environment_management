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
    
?>
     
            
                  <div class="menu_box" id="menu_box">
                      <center>
                          <?php
                            $img=array("overview.png","api.png","service.png","env.png","group.png","document.png","support.png");
                            $name=array("Overview","Model and API","Services","Environments","Collaboration","Documentation","Support",);
                            $url=array("../home","","","../environments","","","");
                            $i=0;
                            while($i < 7){
                              ?>
                            <a href="<?= $url[$i]; ?>">  
                            <div class="user_menu">
                             <center>
                                <div style="width: 250px;height: 24px;padding-bottom: 8px;padding-top: 8px;">
                                    <div style="width: 50px;height: inherit;float: left">
                                       <img src="<?= '../img/'.$img[$i]; ?>" style="float: left;width: 20px;height: 20px;">
                                    </div>
                                    <div style="width: auto;height: inherit">
                                         <span style="padding-top: 2px;float: left;font-size: 14px;font-family: Salesforce Sans,-apple-system,Helvetica Neue,sans-serif;color:#7b6eda;text-transform: capitalize;white-space: nowrap;">
                                            <?= $name[$i]; ?>
                                         </span>
                                    </div>
                                </div>
                             </center>
                           </div>
                            </a>
                              
                              <?php
                              $i++;
                            }
                          ?>
                         
                      </center>     
                  </div>
                 


<?php
 }
 else{
    
 }
?>