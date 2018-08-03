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
   
   <script>
      
                                          var xhr=null;
                                           
                                          function createHttpRequest(){
                                                try{
                                                   xhr=new XMLHttpRequest();
                                                   return xhr;
                                                }
                                                catch(e){
                                                    xhr=new ActiveXobject("Microsoft.XMLHTTP");
                                                    return xhr;
                                                }
                                          }
      
                                                     
                                          function run_file(id,p_id,f_id){
                                            
                                                data="id="+id+"&p_id="+p_id+"&f_id="+f_id;
                                                url="./pro_web_api/run_file.php";
                                              
                                                xhr=createHttpRequest();
                                                //create post request
                                                xhr.open("POST",url,true);
                                              
                                                //set-content type
                                                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                                                xhr.setRequestHeader("Content-length",data.length);
                                                xhr.setRequestHeader("Connection","close");
                                               //show progress
                                              
                                               document.getElementById("main_res_box").style.backgroundImage="none";
                                               document.getElementById("result_loder").style.display="block";
                                                //call function
                                                xhr.onreadystatechange=function(){
                                                 //only handle loded request
                                                  if(xhr.readyState == 4){
                                                     if(xhr.status == 200){
                                                        
                                                       document.getElementById("result_loder").style.display="none";
                                                        document.getElementById("run_result").innerHTML=xhr.responseText; 
                                                      
                                                     }
                                                     else{
                                                       alert("Error with ajax call");
                                                     }
                                                  }
                                               }
                                              
                                               //send variables
                                                xhr.send(data);
                                             
                                          }
      
      
      
      
   </script>
       
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
                            <div style="width: 35px;height: inherit;float: left;padding-top: 8px;">
                                <img src="../img/pro.png" style="float: left;height: 18px;width: 18px;padding-top: 3px;">
                                
                            </div>   
                            <div style="float: left;height: inherit;width:220px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" align="left">
                                <div style="width: auto;height: 8px;"></div>
                                
                                <span class="main_heading" style="font-size: 15px;"><?= $p['p_name'] ?></span>
                                
                            </div>
                            
                           
                            </div>
                            
                             <div style="width: 50%;height: 50px;float: left;" align="left;">
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
                            
                            <div style="width: 50px;height: inherit;float: right;padding-top: 5px;">
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
                            
                           <div style="width:200px ;height: auto;background-color: transparent;float: right">
                           <?php
                           $eid=$p['envoir_id'];
                           $sql1="SELECT env_name FROM env WHERE env_id='$eid'";
                           $res1=mysqli_query($conn,$sql1);
                           $row1=mysqli_fetch_array($res1);
                           ?>
                              <center>
                              <div style="width: 85%;height: 100%" align="left">
                                 <div style="width: 100%;height: 8px;"></div>
                                    <div style="width: 100%;height: 25px;">
                                       <div style="width:auto;height: inherit;float: right;padding-top: 4px;">
                                          <span style="font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;color:#7b6eda;font-size: 14px;"><?= $row1['env_name']; ?></span>
                                       </div>
                                       <div style="width: 35px;height: inherit;float: right">
                                          <img src="../img/env.png" style="float: left;">
                                       </div>
                                     
                                       <!--
                                       <div style="width: 150px;float: right;height: auto">
                                          <a href="">
                                             <button class="transparent_button" style="width: 150px;">Change environment</button>
                                          </a>
                                       </div>
                                      -->
                                    </div>
                                 
                              </div>
                              </center>
                           </div>
                            
                            
                           
                        </div>
                    </center>
               </div>
               
               
               
               <div style="position: fixed;top: 100px;bottom: 60px;left: 0;width: 30%;background-color: transparent;border-right: solid;border-right-color: #ddd;border-right-width: 1px;">
              
                     <div style="position: relative;top: 0;width: 100%;height: 60px;background-color: transparent;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;"></div>
                     
                  <center>
                     
                     <div  style="display:block;width: 100%;height: 93%;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 14px;color:#3F3F44;overflow-y: auto;">
                         
                        <div  style="width: 100%;height: 15px;overflow: auto"></div>
                          
                          <?php
                        $pid=$p['p_id'];
                        $sql="SELECT * FROM files WHERE u_id='$id' AND p_id='$pid'";
                        $res=mysqli_query($conn,$sql);
                        $nf=mysqli_num_rows($res);
                        if($nf == 0){
                           ?>
                           <br><br><br>
                           <div class="env_info_block" style="width: 90%;height: 80px;">
                              <br><br>
                              <span style="color: #96a3b6;font-weight: 400;font-family: inherit;font-size: 14px;">No files are uploded yet</span>
                           </div>
                           <?php
                        }
                        else{
                        $i=1;
                        while($rowf = mysqli_fetch_array($res)){
                           
                        
                     ?>
                     
                  <div class="f_detail_run" id="<?= 'f_detail_'.$rowf[f_id]; ?>"  onclick="run_file(<?= $id ?>,<?= $pid ?>,<?= $rowf['f_id'] ?>)">
                     <div  style="width:85%;height: 80px;background-color: transparent;;padding-top: 10px;padding-bottom: 10px;">
                        <div style="width: 100%;height: 30px;">
                            
                            <div style="float: left;height: inherit;width:90%;">
                               <span style="padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 13px;color:a39ade;" title="<?= $rowf['f_name']; ?>">
                                  <b><?= $rowf['f_name']; ?></b>
                               </span>
                            </div>
                        </div>
                        <div style="width: 100%;height: 30px;">
                           <div style="height: inherit;width: 10%;float: left">
                               <span style="padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 13px;color:gray;">
                                 #<?= $i; ?>
                               </span>
                           </div>
                           <div style="height: inherit;width: 70%;float: left">
                               <span style="padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 13px;color:gray;">
                                 <?php
                                 
                                 $timestamp = strtotime($rowf['u_time']);

                                 
                                 ?>
                                 <?= date("M d, Y", $timestamp).' @ '. date("g:i A", $timestamp).'&nbsp &nbsp &nbsp &nbsp Me'; ?>
                               </span>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                     <?php
                       $i++;
                        }
                        }
                     ?>
                     
                  <div  style="width: 100%;height: 15px;overflow: auto"></div>   
                         
                     </div>
                    
                     
                  </center>
                  
            </div>
            <div style="position: fixed;top: 100px;bottom: 60px;right: 0;width: 70%;background-color: transparent;">
               
               <div id="main_res_box" style="width: 100%;height: 100%;overflow: auto;background-image: url(../img/run.png);background-position: center;background-repeat: no-repeat;">
                     <div style="display: block;width: 100%;height: 60px;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;position: relative;top: 0;">
                         <center>
                              <div style="width: 90%;height: 50px;">
                                 <div style="width: 100%;height: 30px;padding-top: 10px;padding-bottom: 20px">
                                     <button class="button_i_pro" style="float: right;"><img src="../img/runw.png" style="margin-bottom: -5px;padding-bottom: 2px;"> &nbspRun</button>
                                 </div>
                              </div>
                         </center>
                     </div>
                     
                     <div style="width: 60px;height: 60px;float: none;display:none;position: absolute;top: 40%;left: 50%;" id="result_loder">
                        <!--<i class="fa fa-spinner fa-spin" style="color:#808080; font-size: 60px; display:block;float: right" ></i>-->
                        <img src="../img/loder_file.gif">
                     </div>
                     <br><br>
                    <center>
                    <div style="width: 90%;height: 600px;overflow: auto;" id="run_result">
                       
                    </div>
                    </center>
               </div>
                     
            </div>
                
                

   </div>

<?php
 }
 else{
    
 }
?>
