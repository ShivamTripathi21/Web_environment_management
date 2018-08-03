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
    $id=$row['u_id'];
    $query1="SELECT * FROM project WHERE u_id='$id' AND p_id='$p'";
    $result1=mysqli_query($conn,$query1);
    $n_pro=mysqli_num_rows($result1);
    $p=mysqli_fetch_array($result1);
    $f_name=$row['f_name'];
    $l_name=$row['l_name'];
?>
   
       
   <div style="right: 0;left:0;bottom: 60px;top: 50px;background-color:transparent;position: fixed;">
                 <?php
                   require_once('../model/helpers.php');
                   render('../view/user_box',array());
                   render('../view/menu_box',array());
                  ?>
                 
               <div style="width: 100%;height: 50px;background-color:#f7f8fb;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px">
                    <div style="width:100%;height: 5px;"></div>
                    <center>
                        <div style="width: 95%;height: 40px;">
                           <div style="width: 35px;height: inherit;float: left;padding-top: 8px;">
                                <img src="../img/projects.png" style="float: left;">
                                
                            </div>   
                            <div style="float: left;height: inherit;width:auto;" align="left">
                                <div style="width: auto;height: 8px;"></div>
                                
                                <span class="main_heading" style="color: #7b6eda;">Projects</span>
                                
                            </div>
                            <div style="float: left;height: inherit;width: 60px;" >
                                <div style="width: inherit;height: 12px;"></div>
                                <img src="../img/rarrow.png" style="padding-top: 1px;"> 
                            </div>
                            <div  style="width:285px ;height: inherit;float: left">
                            <div style="width: 35px;height: inherit;float: left;padding-top: 5px;">
                                <img src="../img/pro.png" style="float: left;height: 18px;width: 18px;padding-top: 8px;">
                                
                            </div>   
                            <div style="float: left;height: inherit;width:120px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" align="left">
                                <div style="width: auto;height: 8px;"></div>
                                
                                <span class="main_heading" style="font-size: 15px;"><?= $p['p_name'] ?></span>
                                
                            </div>
                            
                           
                            </div>
                            
                            
                            <div style="width: 200px;height: inherit;float: right;padding-top: 5px;">
                               <?php
                               if($p['access'] == 1){
                                 echo '<img src="../img/public.png" style="float: right;padding-top: 7px;"> ';
                               }
                               elseif($p['access'] == 2){
                                  echo '<img src="../img/shared.png" style="float: right;padding-top: 7px;"> ';
                               }
                               elseif($p['access'] == 3){
                                  echo '<img src="../img/private.png" style="float: right;padding-top: 7px;"> ';
                               }
                               ?>
                               
                            </div>
                            
                           <div style="width: 100%;height: 50px;" align="left;">
                           <?php
                           $var_name=array("Overview","Runs","Services","Files","Deploy","Publish","Activity","Settings");
                           $url=array("overview","runs","service","files","deploy","publish","p_activity","p_settings");
                           $var_on=array($ov,$ru,$re,$fi,$dep,$pub,$act,$set);
                           $i=0;
                           while($i <8){
                              
                              ?>
                              
                              <div class="project_opt">
                                 <a href="<?= '../project/?p_id='.$p['p_id'].'&page='.$url[$i]; ?>" <?php if( $var_on[$i] == 1){ echo 'class="selected_opt"'; }else{ echo 'class="project_opt_a"';} ?> style="text-decoration: none;">
                                    <div class="content_opt" id="content_opt">
                                       <span class="project_opt_font" id="project_opt_font"><?= $var_name[$i]; ?></span>
                                    </div>
                                 </a>
                              </div>
                              
                              <?php
                              
                              $i++;
                           }
                           
                           ?>
                            
                            
                         </div>
                           
                        </div>
                    </center>
               </div>
               
               
                <div style="width: 100%;height: 20px;"></div>
                
                

   </div>

<?php
 }
 else{
    
 }
?>
