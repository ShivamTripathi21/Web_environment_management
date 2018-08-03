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
    $query1="SELECT env_id FROM env";
    $result1=mysqli_query($conn,$query1);
    $n_env=mysqli_num_rows($result1);
    
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
                
                 $( document ).ready(function(){
                    
                    url="./env_web_api/fetch_env.php";
                    data=data="id=id";
                    xhr=createHttpRequest();
                    //create post request
                    xhr.open("POST",url,true);
                                            
                    //set-content type
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.setRequestHeader("Content-length",data.length);
                    xhr.setRequestHeader("Connection","close");
                    //show progress
                    
                    
                     //call function
                    xhr.onreadystatechange=function(){
                        //only handle loded request
                        if(xhr.readyState == 4){
                            if(xhr.status == 200){
                               
                                  var q= eval("(" +xhr.responseText + ")");
                                   
                                  i=0; 
                                   
                                  while(i < q.no_env) {
                                     
                                    document.getElementById("e_name_"+i).innerHTML=q[i]['e_name'];
                                    
                                    document.getElementById("e_desc_"+i).innerHTML=q[i]['e_desc'];
                                    
                                    document.getElementById("e_version_"+i).innerHTML=q[i]['e_ver'];
                                    
                                    document.getElementById("e_owner_"+i).innerHTML=q[i]['owner'];
                                    
                                     document.getElementById("e_access_"+i).innerHTML=q[i]['access'];
                                     
                                      document.getElementById("e_type_"+i).innerHTML=q[i]['env_type'];
                                    
                                   i++;
                                  } 
                                    document.getElementById('initial').style.display="none";
                                   
                                    document.getElementById('final').style.display="block";
                               
                                    
                            }
                            else{
                               // alert("Error with ajax call");
                            }
                        }
                    }
                    
                    //send variables
                    xhr.send(data);
                    
                });
               
                
                            
                                           
                      
             </script>





            <div style="right: 0;left: 0;bottom: 60px;top: 50px;background-color:transparent;position: fixed;">
                   <?php
                   require_once('../model/helpers.php');
                   render('../view/user_box',array());
                   render('../view/menu_box',array());
                  ?>
                  
                  <div style="width: 100%;height: 60px;background-color:#f7f8fb;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px">
                    <div style="width:100%;height: 13px;"></div>
                    <center>
                        <div style="width: 65%;height: 40px;">
                            <div class="option_name" style="width:175px ;height: inherit;float: left">
                            <div style="width: 35px;height: inherit;float: left;padding-top: 5px;">
                                <img src="../img/env.png" style="float: left;">
                                
                            </div>   
                            <div style="float: left;height: inherit;width:120px;" align="left">
                                <div style="width: inherit;height: 4px;"></div>
                                
                                <span class="main_heading">Environments</span>
                                
                            </div>
                            <div style="float: left;height: inherit;width: 20px;" >
                                <div style="width: inherit;height: 8px;"></div>
                                <img src="../img/option.png"> 
                            </div>
                            
                            <div class="option_box" id="option_box" style="height:95px">
                               <div style="height:50px;width: inherit;border-bottom: solid;border-bottom-color: rgba(241, 241, 241,0.83);border-bottom-width: 1px;">
                                  <div style="width: inherit;height: 5px;"></div>
                                  <center>
                                  <div style="width: 330px;height: 40px;background-color:#f7f8fb;">
                                     <div style="width: 300px;height: 40px;">
                                         <div style="width: inherit;height: 7px;"></div>
                                         <img src="../img/env.png" style="float: left;width: 20px;height: 20px;padding-top: 2px;">
                                         <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Environments</span>
                                     </div>   
                                  </div>
                                  </center>
                                  <div style="width: inherit;height: 5px;"></div>
                               </div>
                                <div class="option_menu">
                                   <div style="width: inherit;height: 5px"></div>
                                   <div style="width: inherit;height: 30px">
                                     <center>
                                         <div style="width: 250px;height: inherit">
                                             <div style="width: inherit;height: 2px;"></div>
                                             <img src="../img/add.png" style="float: left;width: 20px;height: 20px;padding-top: 2px;">
                                             <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Create a Environments</span>
                                         </div>
                                     </center>
                                   </div>
                                   <div style="width: inherit;height: 5px"></div>
                                </div>
                                
                                
                                
                            </div>
                            </div>
                            
                            
                            <div style="width: 200px;height: inherit;float: right;padding-top: 1px;">
                                <div class="input_frame" id="image_frame">
                                   <input placeholder="Search environment" type="text" style="width: 170px;padding-left: 10px;padding-right: 10px;height: 30px;border: none;outline: none;color: #596981;">
                                </div>
                            </div>
                           
                        </div>
                    </center>
                </div>
                  
                <div id="initial" style="width: 100%;height: auto;display: block;">
                  <div style="width:100%;height: 20px;"></div>
                  <center>
                      
                      <div style="width: 65%;height: auto;">
                        <div style="width: 50%;height: auto;float: left;">
                          
                               <div style="width: 90%;height:auto;float: left;">
                                  <?php
                                  $i=0;
                                   $color=array("rgba(241, 241, 241,0.93)","rgba(241, 241, 241,0.83)","rgba(241, 241, 241,0.73)","rgba(241, 241, 241,0.63)","rgba(241, 241, 241,0.53)","rgba(241, 241, 241,0.43)","rgba(241, 241, 241,0.33)");
                                  while($i<7){
                                  ?>
                                   <div style="width: 100%;height: 100px;background-color: transparent;">
                                      <div style="width: 100%;height: 20px;">
                                         <div style="width:150px;height: 10px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:<?= $color[$i]; ?>;float: left;"></div>
                                         <div style="width:100px;height: 10px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:<?= $color[$i]; ?>;float: right;"></div>
                                      </div>
                                       <div style="width: 100%;height: 80px;background-color:<?= $color[$i]; ?>;border-radius: 3px;"></div>
                                   </div>
                                   <br>
                                   <?php
                                   $i++;
                                  }
                                   ?>
                                   
                               </div>
                          
                        </div>
                        <div style="width: 50%;height: auto;float: right;">
                              <div style="width:100%;height:300px;float: right;">
                                  <div style="width: 100%;height: 100px;">
                                      <div style="width: 100%;height: 20px;">
                                         <div style="width:100px;height: 10px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:rgba(241, 241, 241,0.93);float: right;"></div>
                                      </div>
                                       <div style="width: 100%;height: 80px;background-color:rgba(241, 241, 241,0.93);border-radius: 3px;"></div>
                                  </div>
                                  <br>
                                  <div style="width: 100%;height: 80px;">
                                      <!--<div style="width: 100%;height: 20px;">
                                         <div style="width:100px;height: 10px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:rgba(241, 241, 241,0.93);float: right;"></div>
                                      </div>-->
                                       <div style="width: 100%;height: 80px;background-color:rgba(241, 241, 241,0.93);border-radius: 3px;"></div>
                                  </div>
                              </div>
                        </div>
                      </div>
                     
                  </center> 
                </div>  
                  
                  
                  
               
                <div id="final" style="width: 100%;min-height: 400px;background-color:transparent;display:none;max-height: 93%;overflow-y: auto">
                   <div style="width: 100%;height: 20px"></div>
                   <?php
                     $i=0;
                     while($i < $n_env){
                        
                     
                     ?>
                   <center>
                     <div style="width: 65%;height: 150px;">
                        <div style="width: 50%;height: 150px;float: left;">
                             <div style="width: 90%;height:auto;float: left;">
                              
                                  <div style="width: 100%;height: 115px;background-color: transparent;font-family:Salesforce Sans,-apple-system,Helvetica Neue,sans-serif">
                                      <div style="width: 100%;height: 20px;">
                                         <div style="width:auto;height: 20px;padding-top: 2px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:transparent;float: left;">
                                             <span style="color: #596981;font-weight: 400;font-family:inherit;font-size: 13px;text-transform: capitalize;" id="<?= 'e_owner_'.$i; ?>"></span><span>&nbsp &nbsp</span>
                                         </div>
                                         <div style="width: auto;height: 20px;background-color:#96a3b6;float: left;border-radius: 15px;padding-left: 15px;padding-right: 15px;">
                                             <div style="width: inherit;height: 2px;"></div>
                                             <center>
                                                <span style="color:#6ec1da;font-weight: bold;font-family: inherit;font-size: 13px;" id="<?= 'e_type_'.$i; ?>"></span><span style="font-size: 13px;color: white;font-weight: bold;font-family: inherit;" id="<?= 'e_access_'.$i; ?>"></span>
                                             </center>
                                         </div>
                                       <a href="#">  
                                         <div style="width:auto;height: 20px;padding-top: 10px;background-color:transparent;float: right;">
                                           <img src="../img/r_arrow.png" style="width: 10px;height: 10px;">
                                         </div>
                                         <div style="width:auto;height: 20px;padding-top: 6px;background-color:transparent;float: right;">
                                              <span style="color: #7677da;font-weight: 400;font-family:inherit;font-size: 13px">Overview &nbsp</span>
                                         </div>
                                       </a>
                                      </div>
                                      <div style="width: 100%;height: 15px;"></div>
                                       <div class="env_info_block">
                                          <div style="width: 100%;height: 15px;"></div>
                                          <div style="width: 100%;height: 50px;">
                                             <center style="line-height: 1.5;">
                                                <div style=" width: 90%;height: 25px;">
                                                    <span style="color: #596981;font-weight: 400;font-family:inherit;font-size:15px" id="<?= 'e_name_'.$i; ?>"></span>
                                                    <span>&nbsp</span>
                                                    <span style="color: #596981;font-weight: 400;font-family:inherit;font-size:15px" id="<?= 'e_version_'.$i; ?>"></span>
                                                    <div class="in_bucket" style="height: 25px;width: 25px;background-color:  rgba(111, 189, 236, 0.25);border-radius: 3px;">
                                                    <img src="../img/bucketc.png" style="width: 15px;height: 15px;padding-top: 4px;" >
                                                    </div>
                                                </div>
                                                <div style=" width: 90%;height: 15px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                    <span style="color: #96a3b6;font-weight: 400;font-family:inherit;font-size:14px;" id="<?= 'e_desc_'.$i; ?>"></span>
                                                </div>
                                             </center>
                                          </div>
                                          <div style="width: 100%;height: 15px;"></div>
                                       </div>
                                              
                                   </div>
                                   <br><br>
                             </div>
                        </div>
                        <div style="width: 50%;height: 150px;float: right;">
                           <!-- req -->
                        </div>
                     </div>   
                   </center>
                   <?php
                     $i++;
                     }
                     
                   ?>
                                               
                   <!---  fixed  --->
                   <div style="top: 130px;right: 17.5%;height: 300px;background-color: white;position: fixed;width: 32%">
                            <div style="width:100%;height:300px;float: right;font-family:Salesforce Sans,-apple-system,Helvetica Neue,sans-serif">
                              
                                  <div style="width: 100%;height: 100px;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;">
                                      <div style="width: 100%;height: 20px;">
                                         <div style="width:100%;height: 20px;float: right;padding-top: 2px;">
                                              
                                              <div align="left" style="width:auto;height: 20px;padding-top: 4px;border-bottom-left-radius: 10px;border-radius: 10px;background-color:transparent;float: left;">
                                                  <span style="color: #596981;font-weight: 400;font-family:inherit;font-size: 13px">Environment status</span>
                                              </div>
                                              
                                              <a href="#">  
                                                  <div style="width:auto;height: 20px;padding-top: 10px;background-color:transparent;float: right;">
                                                      <img src="../img/r_arrow.png" style="width: 10px;height: 10px;">
                                                  </div>
                                                  <div style="width:auto;height: 20px;padding-top: 6px;background-color:transparent;float: right;">
                                                      <span style="color: #7677da;font-weight: 400;font-family:inherit;font-size: 13px">View management &nbsp</span>
                                                  </div>
                                              </a>
                                         </div>
                                      </div>
                                       <div style="width: 100%;height: 15px;"></div>
                                       <div style="width: 100%;height: 60px;background-color:transparent;border-radius: 3px;">
                                         
                                          <div style="width: 90%;height: 40px;padding-top:10px;padding-bottom: 10px;">
                                             <div style="width: 40px;height: inherit;float: left;padding-top: 3px;" align="left"><img src="../img/envs.png" style="width: 26px;height: 26px;"></div>
                                             <div style="width: 40px;height: inherit;float: left;padding-top: 5px;" align="left"><img src="../img/users.png"></div>
                                             <div style="width: auto;height: inherit;float: left; font-family:benton-sans,Helvetica Neue,helvetica,arial,sans-serif;" align="left">
                                                <div style="width: 100%;height: 20px;">
                                                   <span style="font-family: inherit;color:#3F3F44;font-weight: 700;font-size: 13px;line-height: 1.5;float: left;"><?= $row['email'] ?></span>
                                                </div>
                                                <div style="width: 100%;height: 20px;">
                                                   <span style="color: #96a3b6;font-weight:300;font-family:inherit;font-size:13px;">No environment created yet </span>
                                                </div>
                                                 
                                                 
                                             </div>
                                             
                                          </div>
                                       </div>
                                  </div>
                                  
                                  <div style="width: 100%;height: 60px;">
                                      
                                       <div style="width: 100%;height: 80px;background-color:transparent;border-radius: 3px;">
                                           <div style="width: 90%;height: 40px;padding-top:10px;padding-bottom: 10px;">
                                             <div style="width: 40px;height: inherit;float: left;padding-top: 3px;" align="left"><img src="../img/bucket.png" style="width: 26px;height: 26px;"></div>
                                             <div style="width: 40px;height: inherit;float: left;padding-top: 5px;" align="left"><img src="../img/users.png"></div>
                                             <div style="width: auto;height: inherit;float: left; font-family:benton-sans,Helvetica Neue,helvetica,arial,sans-serif;" align="left">
                                                 <div style="width: 100%;height: 20px;">
                                                   <span style="font-family: inherit;color:#3F3F44;font-weight: 700;font-size: 13px;line-height: 1.5;float: left;"><?= $row['email'] ?></span>
                                                 </div>
                                                  <div style="width: 100%;height: 20px;"> 
                                                   <span style="color: #96a3b6;font-weight:300;font-family:inherit;font-size:13px;">5 environment in bucket</span>
                                                  </div>
                                             </div>
                                              
                                          </div>
                                       </div>
                                  </div>
                              </div>
                     </div>
                </div>
                  
                  
                  
            </div>


<?php
 }
 else{
    
 }
?>
