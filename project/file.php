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
                
                      
               function fetch_detail(fid){
                          
                    //document.getElementById("f_detail_"+fid).style.backgroundColor="rgba(247, 248, 251, 0.60)";
                    url="./pro_web_api/fetch_file_det.php";
                  
                    data="id="+fid;
                    xhr=createHttpRequest();
                    //create post request
                    xhr.open("POST",url,true);
                                            
                    //set-content type
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.setRequestHeader("Content-length",data.length);
                    xhr.setRequestHeader("Connection","close");
                    //show progress
                   // document.getElementById("f_detail_"+fid).style.backgroundColor="white";
                    document.getElementById("loadf").style.display="block";
                     document.getElementById("file_d_block").style.display="none";
                      document.getElementById("frame").style.display="block"; 
                     //call function
                    xhr.onreadystatechange=function(){
                        //only handle loded request
                        if(xhr.readyState == 4){
                            if(xhr.status == 200){
                              // document.getElementById("f_detail_"+fid).style.backgroundColor="white";
                                 document.getElementById("frame").style.display="none"; 
                                document.getElementById("loadf").style.display="none"; 
                               
                                var q= eval("(" +xhr.responseText + ")");
                                
                                document.getElementById("file_name").innerHTML=q.f_name;
                                document.getElementById("file_type").innerHTML=q.type; 
                                document.getElementById("file_size").innerHTML=q.size+" B";
                                document.getElementById("time").innerHTML=q.time;
                                document.getElementById("version").innerHTML=q.ver;
                                document.getElementById("owner").innerHTML=q.owner;
                                
                                //document.getElementById("f_detail_"+fid).style.backgroundColor="#eef1f6";
                                document.getElementById("operation_icon").style.display="block";
                                document.getElementById("file_d_block").style.display="block";
                                
                                
                            }
                            else{
                               // alert("Error with ajax call");
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
                 
    <?php
    if(isset($_GET['msg'])){
    ?>
     <div id="message_i" class="msg" style="background-color:#64C897;display:block;">
        <center>
            <div style="width: 90%;height: inherit">
                 <div style="width:100%;height:25px" ></div>
                 <span style="font-size: 14px;color: white;" id="response_msg"><?= $_GET['msg'] ?></span>
            </div>
        </center>
     </div>  
    <?php
    }
    ?>        
    <script>
          
                    $('#message_i').fadeIn('slow', function(){
                    $('#message_i').delay(3000).fadeOut(); 
                    });
                
                
     </script>
                 
                 
                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- Modal content -->
  
  
                    <div id="message" class="msg" style="background-color:#64C897;display:none;">
                        <center>
                            <div style="width: 90%;height: inherit">
                                <div style="width:100%;height:25px" ></div>
                                <span style="font-size: 14px;color: white;" id="response_msg"></span>
                            </div>
                        </center>
                    </div>
             
                     <script>
                     function fade(msg,id,time){
                         document.getElementById("response_msg").innerHTML=msg;
                         if(id === 1){document.getElementById("message").style="background-color:#64C897";}
                         else if(id === 0){document.getElementById("message").style="background-color:#d74f74";}
                         $('#message').fadeIn('slow', function(){
                         $('#message').delay(time).fadeOut(); 
                         });
                     }
                
                     </script>
  
  
                    <div class="modal-content" style="height: auto;">
                        <center>
                            <div style="width: 600px;height: auto;">
                                <div style="width: 600px;height: 20px;"></div>
                                <div style="width: 600px;height: 40px;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;">
                                    <span style="float: left;color: #ddd;font-size: 15px;font-family:  Sans,sans Open-serif;">Upload new Files</span>
                                    <span class="close"  id="btn_close" style="color: gray;font-size: 18px;float: right;">&times;</span>
                                </div>
                                
       
                                <form method="post" action="../project/todo/upload.php" enctype="multipart/form-data"> 
                                    <div style="width: inherit;height: 200px;background-color: transparent;font-size: 13px;color: #45474a">
                                         <br><br>
                                        
                                         <div style="width: inherit;height: 40px;">
                                            <div style="width: auto;height: inherit;float: left">
                                                <span align="left" style="color: #596981;font-size: 14px;font-family: Lato,Helvetica-,Arial,sans-serif;float: left;padding-top: 15px;">
                                                 <?= $f_name; ?> &nbsp &nbsp / &nbsp &nbsp
                                                </span>
                                            </div>
                                            <div style="width:auto;height: inherit;float: left">
                                                 <span align="left" style="color: #596981;font-size: 14px;font-family: Lato,Helvetica-,Arial,sans-serif;float: left;padding-top: 15px;">
                                                 <?= $p['p_name'] ?> &nbsp &nbsp / &nbsp &nbsp
                                                </span>
                                            </div>
                                             
                                            <div style="width: 150px;height: inherit;float: left">
                                                  <input type="file" class="file" name="file" style="padding-top: 12px;">
                                                  <input type="hidden" name="pid" value="<?= $p['p_id']; ?>">
                                            </div>    
                                            
                                         </div>
                                         <!--
                                         <div style="width: inherit;height: 20px;">
                                              <span style="font-size: 13px;color:#d74f74;" id="name_error"></span>
                                         </div>-->
                                         <br>
                                         <div style="width: inherit;height: 40px;">
                                            <div style="width: 180px;height: inherit;float: right;">
                                                <input name="button" type="submit" class="colored_button" style="float: right;" value="Upload File">
                                            </div>
                                           
                                             
                                         </div>
                                         <br><br>
                                         <img src="../img/info.png" style="float: left;"><span align="left" style="padding-top: 2px;float: left;color:gray;font-size: 12px;letter-spacing: normal;font-family: sans-serif;line-height: 1.5;">&nbsp File name must be unique in your project directory, thats why it
                                         helps for file syncing at time of file execution.
                                         <br> <a href="#" style="color:#6ec1da;">Learn more about Files</a>.</span>   
                                         
                                    </div>
                                </form>    
                                    
                                    <br>
     
                                
                            </div>
                        </center>
                    </div>
  

                </div>

               
                 
                 
                 
                 
                 
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
                            
                            
                                  
                        <div style="width:50%;height: 40px;float: left;" align="left;">
                           <?php
                           $var_name=array("Overview","Runs","Services","Files","Deploy","Publish","Activity","Settings");
                           $url=array("overview","runs","service","files","deploy","publish","p_activity","p_settings");
                           $var_on=array($ov,$ru,$re,$fi,$dep,$pub,$act,$set);
                           $i=0;
                           while($i <8){
                              
                              ?>
                              
                              <div class="project_opt" onclick="">
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
                            
                           
                      
                           
                        </div>
                    </center>
               
               
               
               
               
               
               
            <div style="position: fixed;top: 100px;bottom: 60px;left: 0;width: 25%;background-color: transparent;border-right: solid;border-right-color: #ddd;border-right-width: 1px;">
               
               <center>
                     <div style="width: 100%;height: 60px;background-color: transparent;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;">
                     <div  style="width: 100%;height: 15px;overflow: auto"></div>
                     <div style="width: 85%;height: inherit">
                        <span style="padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 14px;color: #596981;">Files</span>
                        <button  class="transparent_button" style="float: right;width: 150px;" id="u_n_file">Upload Files</button>
                        
                        
                                     <script>
                                          // Get the modal
                                          var modal = document.getElementById("myModal");

                                          // Get the button that opens the modal
                                          var btn = document.getElementById("u_n_file");
                                          var btnclose = document.getElementById("btn_close");

                                          // Get the <span> element that closes the modal
                                          var span = document.getElementsByClassName("close")[0];

                                          // When the user clicks the button, open the modal 
                                          btn.onclick = function() {
                                             modal.style.display = "block";
                                          }

                                          btnclose.onclick = function() {
                                              modal.style.display = "none";
                                          }

                                          // When the user clicks on <span> (x), close the modal
                                          span.onclick = function() {
                                              modal.style.display = "none";
                                          }

                                          // When the user clicks anywhere outside of the modal, close it
                                          window.onclick = function(event) {
                                              if (event.target == modal) {
                                                  modal.style.display = "none";
                                              }
                                          }
                                     </script>
                        
                     </div>  
                     </div>
                  </center>
                  
                  
                  <center>
                     <br><br><br>
                     <div style="width: 30px;height: 30px;float: none;display: none;" id="loadf">
                        <i class="fa fa-spinner fa-spin" style="color:#808080; font-size: 30px; display:block;float: right" ></i>
                     </div>
                     <div id="frame" style="display: block;width: 85%;height:50%;background-image: url(../img/file_frame.png);background-repeat: no-repeat;background-position: center">
                        
                     </div>
                     <div id="file_d_block" style="display: none;width: 85%;height: inherit;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 14px;color:#3F3F44;">
                         <div style="width: 100%;height:40px;" align="left">
                           <div style="width: 30%;height: inherit;float: left">
                              <span style="font-family: inherit;color: inherit;font-size: inherit;">File name : </span>
                           </div>
                           <div style="width: 70%;height: inherit;float: right">
                               <span style="font-family: inherit;color: gray;" id="file_name"></span>
                           </div>
                         </div>
                         <div style="width: 100%;height:40px;" align="left">
                           <div style="width: 30%;height: inherit;float: left">
                              <span style="font-family: inherit;color: inherit;font-size: inherit;">Owner : </span>
                           </div>
                           <div style="width: 70%;height: inherit;float: right">
                               <span style="font-family: inherit;color: gray;" id="owner"></span>
                           </div>
                         </div>
                         <div style="width: 100%;height:40px;" align="left">
                             <div style="width: 30%;height: inherit;float: left">
                                <span style="font-family: inherit;color: inherit;font-size: inherit;">File type : </span>
                             </div>
                             <div style="width: 70%;height: inherit;float: right">
                                <span style="font-family: inherit;color: gray;" id="file_type"></span>
                             </div>
                         </div>
                         <div style="width: 100%;height:40px;" align="left">
                             <div style="width: 30%;height: inherit;float: left">
                                <span style="font-family: inherit;color: inherit;font-size: inherit;">File size : </span>
                             </div>
                             <div style="width: 70%;height: inherit;float: right">
                                <span style="font-family: inherit;color: gray;" id="file_size"></span>
                             </div>
                         </div>
                         <div style="width: 100%;height:40px;" align="left">
                             <div style="width: 30%;height: inherit;float: left">
                                <span style="font-family: inherit;color: inherit;font-size: inherit;">Last modified : </span>
                             </div>
                             <div style="width: 70%;height: inherit;float: right">
                                <span style="font-family: inherit;color: gray;" id="time"></span>
                             </div>
                         </div>
                         <div style="width: 100%;height:30px;" align="left">
                             <div style="width: 30%;height: inherit;float: left">
                                <span style="font-family: inherit;color: inherit;font-size: inherit;">Version : </span>
                             </div>
                             <div style="width: 70%;height: inherit;float: right">
                                <span style="font-family: inherit;color: gray;" id="version"></span>
                                
                             </div>
                         </div>
                         <div style="width: 100%;height:40px;" align="left">
                            <a href="#">
                                <span style="padding-top: 1px;font-family: inherit;color:#6ec1da;;float: right;font-size: 12px;">
                                   &nbsp Learn how to upgrade version
                                </span>
                                <span style="float: right;"><img src="../img/learn.png"></span>
                            </a>
                         </div>
                         
                         <div style="width: 100%;height:40px;" align="left">
                             <div style="width: 30%;height: inherit;float: left">
                                <span style="font-family: inherit;color: inherit;font-size: inherit;">Last run : </span>
                             </div>
                             <div style="width: 70%;height: inherit;float: right">
                                <span style="font-family: inherit;color: gray;">Succeed</span>
                                
                             </div>
                         </div>
                          
                         
                     </div>
                     
                  </center>
                  
                
                  
            </div>
            <div style="position: fixed;top: 100px;bottom: 60px;right: 0;width: 75%;background-color: transparent;">
                <div style="width: 100%;height: 60px;overflow: auto;background-color: transparent;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px;">
                     <center>
                        <div style="width: 90%;height: 60px;">
                           
                            
                              <div style="width: 100%;height: 4px;"></div>
                              <div style="width: 50%;height: 30px;float: left;">
                                   
                                    <div style="width: 100%;height:35px;padding-top: 10px;">
                                       <input type="text"  onkeyup="short_file_name();" class="file_short_input" placeholder="e.g. sample.py" id="file_name_for_short">
                                    </div>
                                          
                                              <script>
                                              
                                              //for sorting list data
                                              function short_file_name(){
                                                var input,filter,divi,box,fname;
                                                input=document.getElementById("file_name_for_short");
                                                filter = input.value.toUpperCase();
                                                divi=document.getElementById("file_info_cont_box");
                                                box=divi.getElementsByClassName("f_detail");
                                                for (var i = 0; i < box.length; i++) {
                                                    fname=box[i].getElementsByTagName("span")[0];
                                                    if(fname){
                                                       if (fname.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                          box[i].style.display = "";
                                                       }
                                                       else{
                                                           box[i].style.display = "none";
                                                       }
                                                    }
                                                }
                                              }
                                              
                                             </script>
                              </div>
                              <div id="operation_icon" style="width: 50%;height: 30px;float: right;display: none;">
                                 <div class="background" id="back_1">
                                    <img class="menu_icon_img" onmouseover="document.getElementById('back_1').style.backgroundColor='#e1e1e1'" onmouseout="document.getElementById('back_1').style.backgroundColor='transparent'" src="../img/download.png">
                                 </div>
                                 <div class="background" id="back_2">
                                    <img class="menu_icon_img" onmouseover="document.getElementById('back_2').style.backgroundColor='#e1e1e1'" onmouseout="document.getElementById('back_2').style.backgroundColor='transparent'"  src="../img/delete.png">
                                 </div>
                                 <div class="background" id="back_3">
                                    <img class="menu_icon_img" onmouseover="document.getElementById('back_3').style.backgroundColor='#e1e1e1'" onmouseout="document.getElementById('back_3').style.backgroundColor='transparent'"  src="../img/move.png">
                                 </div>
                                 <div class="background" id="back_4">
                                    <img class="menu_icon_img" onmouseover="document.getElementById('back_4').style.backgroundColor='#e1e1e1'" onmouseout="document.getElementById('back_4').style.backgroundColor='transparent'" src="../img/rename.png">
                                 </div>
                                
                              </div>
                              
                          
                           
                        </div>
                     </center>
                </div>
                <div style="width: 100%;max-height: 90%;overflow: auto;background-color: transparent;overflow-y: auto;">
                  <center>
                       
                  <div  style="width: 90%;height: 25px;"></div>
                  
                  
                      
                  <div class="f_detail">
                     <div style="width: 90%;height: 25px;background-color: transparent;padding-top: 10px;padding-bottom: 10px;">
                        <div style="float: left;height: inherit;width:40px;">
                           <img src="../img/file.png" style="float: left;">
                        </div>
                         <div style="float: left;height: inherit;width:90%;">
                            <div style="width:33.333%;height: inherit;float: left">
                                <a href="#">
                                  <span class="file_name_on_all" title="<?= $rowf['f_name']; ?>">
                                     Requirements.txt
                                  </span>
                                </a> 
                            </div>
                            <div style="width: 33.333%;height: inherit;float: left">
                                <span style="letter-spacing: 1px;padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                    plain/text
                                </span>
                            </div>
                            <div style="width: 33.333%;height: inherit;float: right">
                                
                                <span style="letter-spacing: 1px;padding-top: 5px;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                 
                                </span>
                               
                            </div>
                           
                         </div>
                         <div style="float: right;height: inherit;width:40px;">
                           <img src="../img/more.png" style="float: right;height: 20px;width: 20px;">
                        </div>
                     </div>
                  </div>  
                     
                  <div class="f_detail">   
                      <div style="width: 90%;height: 25px;background-color: transparent;;padding-top: 10px;padding-bottom: 10px;">
                        <div style="float: left;height: inherit;width:40px;">
                           <img src="../img/folder.png" style="float: left;">
                        </div>
                         <div style="float: left;height: inherit;width:90%;">
                            <div style="width: 33.333%;height: inherit;float: left">
                                <a href="#">
                                  <span class="file_name_on_all" title="<?= $rowf['f_name']; ?>">
                                     Result
                                  </span>
                                </a> 
                            </div>
                            <div style="width: 33.333%;height: inherit;float: left">
                                <span style="letter-spacing: 1px;padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                  ---  
                                </span>
                            </div>
                            <div style="width: 33.333%;height: inherit;float: right">
                                
                                <span style="letter-spacing: 1px;padding-top: 5px;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                  
                                </span>
                               
                            </div>
                         </div>
                         <div style="float: right;height: inherit;width:40px;">
                           <img src="../img/more.png" style="float: right;height: 20px;width: 20px;">
                        </div>
                      </div>
                  </div>
                  <div id="file_info_cont_box">   
                     <?php
                        $pid=$p['p_id'];
                        $sql="SELECT * FROM files WHERE u_id='$id' AND p_id='$pid'";
                        $res=mysqli_query($conn,$sql);
                        
                        while($rowf = mysqli_fetch_array($res)){
                           
                        
                     ?>
                  <div class="f_detail" id="<?= 'f_detail_'.$rowf[f_id]; ?>" onclick="fetch_detail(<?= $rowf['f_id'] ?>);">
                     <div  style="width:90%;height: 25px;background-color: transparent;;padding-top: 10px;padding-bottom: 10px;">
                         <div style="float: left;height: inherit;width:40px;">
                           <img src="../img/file.png" style="float: left;">
                         </div>
                         <div style="float: left;height: inherit;width:90%;">
                            <div style="width:33.333%;height: inherit;float: left;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                <a href="#">
                                  <span class="file_name_on_all" title="<?= $rowf['f_name']; ?>">
                                    <?= $rowf['f_name']; ?>
                                  </span>
                                </a> 
                            </div>
                            <div style="width:33.333%;height: inherit;float: left">
                                <span style="letter-spacing: 1px;padding-top: 5px;float: left;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                  <?= $rowf['f_type']; ?>
                                </span>
                            </div>
                            <div style="width:33.333%;height: inherit;float: right">
                                <span style="letter-spacing: 1px;padding-top: 5px;float: right;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 12px;color:gray;">
                                   <?php
                                    $timestamp = strtotime($rowf['u_time']);
                                   ?>
                                   <?= date("d M, Y", $timestamp).' @ '. date("g:i A", $timestamp).'&nbsp &nbsp &nbsp &nbsp Me'; ?>
                                 
                                </span>
                            </div>
                            
                         </div>
                         <div style="float: right;height: inherit;width:40px;background-color: transparent;">
                              <img onclick="show_opt();" src="../img/more.png" style="float: right;height: 20px;width: 20px;">
                         </div>
                     </div>
                  </div>
                     <?php
                        }
                     ?>
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
