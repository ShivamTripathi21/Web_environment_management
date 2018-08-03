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
    $query1="SELECT p_id FROM project WHERE u_id='$id'";
    $result1=mysqli_query($conn,$query1);
    $n_pro=mysqli_num_rows($result1);
    
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
                    
                    url="./pro_web_api/list_project.php";
                    data="id=id";
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
                                   
                                  while(i < q.no_pro) {
                                     
                                    document.getElementById("p_name_"+i).innerHTML=q[i]['p_name'];
                                    document.getElementById("env_"+i).innerHTML=q[i]['env'];
                                  
                                    
                                    if(q[i]['access'] == 1){
                                       document.getElementById("image_"+i).innerHTML='<img src="../img/public.png" style="padding-top: 5px;float: right;">';    
                                    }
                                    else if(q[i]['access'] == 2){
                                       document.getElementById("image_"+i).innerHTML='<img src="../img/shared.png" style="padding-top: 5px;float: right;">';    
                                    }
                                    else if(q[i]['access'] == 3){
                                       document.getElementById("image_"+i).innerHTML='<img src="../img/private.png" style="padding-top: 5px;float: right;">';    
                                    }
                                   
                                    
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
               
                
                function check_p_name(f){
                    var format = /[ !@#$%^&*()+\-=\[\]{};"'':\\|,.<>\/?]/;
                    if(format.test(f.value)){
                        document.getElementById("name_error").innerHTML='Project name " '+f.value+' " is not valid. Project names can only use letters, numbers and underscores.';
                        document.getElementById("p_name").style.borderColor="#d74f74";
                        document.getElementById("p_name").style.outlineColor="#d74f74";
                    }
                    else{
                        document.getElementById("name_error").innerHTML="";
                         document.getElementById("p_name").style.borderColor="#ddd";
                         document.getElementById("p_name").style.outlineColor="#7b6eda";
                    }
                }
                
                function setup(f,id){
                    var format = /[ !@#$%^&*()+\-=\[\]{};"'':\\|,.<>\/?]/;
                    if(f.title.value === ""){
                         fade("Enter the project name",0,2000);
                    }
                    else if(f.access.value === '0'){
                          fade("Select Project accessibility",0,2000);
                    }
                    else if(format.test(f.title.value)){
                        fade('Project name '+f.title.value+' is not valid',0,2000);
                    }
                    else{
                    data="id="+id+"&p_name="+f.title.value+"&access="+f.access.value;
                    url="./pro_web_api/setup_project.php";
                    
                    xhr=createHttpRequest();
                    //create post request
                    xhr.open("POST",url,true);
                                            
                    //set-content type
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.setRequestHeader("Content-length",data.length);
                    xhr.setRequestHeader("Connection","close");
                    //show progress
                    
                    document.getElementById("loadb").style.display="block";
                    fade("Projct setup on process....",1,4000);
                    //call function
                    xhr.onreadystatechange=function(){
                        //only handle loded request
                        if(xhr.readyState == 4){
                            if(xhr.status == 200){
                                document.getElementById("loadb").style.display="none";
                                     if(xhr.responseText == 'ok'){
                                         window.location.href = "http://localhost/on/home";
                                     }
                                     else{                  
                                        fade(xhr.responseText,0,4000);
                                     }
                            }
                            else{
                                alert("Error with ajax call");
                                }
                        }
                    }
                    
                    //send variables
                    xhr.send(data);
                    }
                }
                                           
                                           
                      
             </script>
             
      
                
            <div id="main" style="right: 0;left: 0;bottom: 60px;top: 50px;background-color:transparent;position: fixed;">
                  <?php
                   require_once('../model/helpers.php');
                   render('../view/user_box',array());
                   render('../view/menu_box',array());
                  ?>
                
                
                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- Modal content -->
  
  
                    <div id="message" class="msg" style="background-color:#64C897;display: none;">
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
                                    <span style="float: left;color: #ddd;font-size: 15px;font-family:  Sans,sans Open-serif;">Create new project</span>
                                    <span class="close"  id="btn_close" style="color: gray;font-size: 18px;float: right;">&times;</span>
                                </div>
                                
       
                                <form onsubmit="setup(this,<?= $row['u_id'] ?>); return false;"> 
                                    <div style="width: inherit;height: 300px;background-color: transparent;font-size: 13px;color: #45474a">
                                         <br><br>
                                        
                                         <div style="width: inherit;height: 60px;">
                                            <div style="width: auto;height: inherit;float: left">
                                                <span align="left" style="color: #596981;font-size: 14px;font-family: Lato,Helvetica-,Arial,sans-serif;float: left;padding-top: 15px;">
                                                 <?= $f_name; ?> &nbsp &nbsp / &nbsp &nbsp
                                                </span>
                                            </div>
                                            <div style="width:350px;height: inherit;float: left">
                                                 <input name="title" maxlength="30" id="p_name" onkeyup="check_p_name(this);" placeholder="project name" type="text" style="float: left;" class="project_setup_input">
                                            </div>
                                             
                                            <div style="width: 150px;height: inherit;float: right">
                                                  <select name="access" style=";width: 150px;float: right;" class="project_setup_input">
                                                      <option value="0">Accessibility</option>
                                                      <option value="1">Public</option>
                                                      <option value="2">Shared</option>
                                                      <option value="3">Private</option>
                                                 </select>
                                            </div>    
                                                 
                                                
                                             
                                         </div>
                                         <div style="width: inherit;height: 20px;">
                                              <span style="font-size: 13px;color:#d74f74;" id="name_error"></span>
                                         </div>
                                         <br>
                                         <div style="width: inherit;height: 40px;">
                                            <div style="width: 180px;height: inherit;float: right;">
                                                <input name="c_project" type="submit" class="colored_button" style="float: right;" value="Create Project">
                                            </div>
                                            <div style="width: auto;height: inherit;float: right;">
                                                <div style="width: inherit;height: 3px;"></div>
                                                <i class="fa fa-spinner fa-spin" style="color:#808080; font-size: 30px; display:none;float: right" id="loadb"></i>
                                            </div>
                                             
                                         </div>
                                         <br><br>
                                         <img src="../img/info.png" style="float: left;"><span style="padding-top: 2px;float: left;color:gray;font-size: 12px;letter-spacing: normal;font-family: sans-serif;line-height: 1.5;">&nbsp Project names can only use letters, numbers, underscores, and hyphens; and they must start with a letter<br> or a number.
                                         You can change project name and accessibility later, <a href="#" style="color:#6ec1da;">Learn more about project accessibility</a>.</span>   
                                         
                                    </div>
                                </form>    
                                    
                                    <br>
     
                                
                            </div>
                        </center>
                    </div>
  

                </div>

               
                
                
                
                <div style="width: 100%;height: 60px;background-color:#f7f8fb;border-bottom: solid;border-bottom-color: #ddd;border-bottom-width: 1px">
                    <div style="width:100%;height: 13px;"></div>
                    <center>
                        <div style="width: 65%;height: 40px;">
                            <div class="option_name" style="width:140px;height: inherit;float: left">
                            <div style="width: 30px;height: inherit;float: left;padding-top: 5px;">
                                <!--<img src="../img/projectsb.png" style="float: left;">-->
                                <img style="float: left;" src="../img/projects.png">
                            </div>
                            <div style="float: left;height: inherit;width: 90px;">
                                <div style="width: inherit;height: 4px;"></div>
                                
                                <span class="main_heading">Projects</span>
                                
                            </div>
                            <div style="float: left;height: inherit;width:20px;">
                                <div style="width: inherit;height: 8px;"></div>
                                <img src="../img/option.png"> 
                            </div>
                            
                            <div class="option_box" id="option_box" style="height: 180px;">
                              
                               <div style="height:50px;width: inherit;border-bottom: solid;border-bottom-color: rgba(241, 241, 241,0.83);border-bottom-width: 1px;">
                                  <div style="width: inherit;height: 5px;"></div>
                                  <center>
                                  <div style="width: 330px;height: 40px;background-color:#f7f8fb;">
                                     <div style="width: 300px;height: 40px;">
                                         <div style="width: inherit;height: 7px;"></div>
                                         <img src="../img/projects.png" style="float: left;width: 20px;height: 20px;padding-top: 2px;">
                                         <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Projects</span>
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
                                             <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Create a Team</span>
                                         </div>
                                     </center>
                                   </div>
                                   <div style="width: inherit;height: 5px"></div>
                                </div>
                                 <div class="option_menu">
                                   <div style="width: inherit;height: 5px"></div>
                                   <div style="width: inherit;height: 30px">
                                     <center>
                                         <div style="width: 250px;height: inherit">
                                             <div style="width: inherit;height: 2px;"></div>
                                             <img src="../img/add.png" style="float: left;width: 20px;height: 20px;padding-top: 2px;">
                                             <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Create a Organization</span>
                                         </div>
                                     </center>
                                   </div>
                                   <div style="width: inherit;height: 5px"></div>
                                </div>
                                <div class="option_menu">
                                   <div style="width: inherit;height: 5px"></div>
                                   <div style="width: inherit;height: 30px">
                                     <center>
                                         <div style="width: 250px;height: inherit">
                                             <div style="width: inherit;height: 2px;"></div>
                                             <img src="../img/service.png" style="float: left;width: 20px;height: 20px;padding-top: 2px;">
                                             <span class="main_heading" style="float: left;font-size: 14px;"> &nbsp Apply service on project</span>
                                         </div>
                                     </center>
                                   </div>
                                   <div style="width: inherit;height: 5px"></div>
                                </div>
                              
                            </div>
                           </div>
                            
                            
       
                            
                            <div align="right" style="width: 100px;height: inherit;float: right;padding-top: 1px;">
                                <button class="transparent_button" id="c_n_project">New</button>
                                       <script>
                                          // Get the modal
                                          var modal = document.getElementById("myModal");

                                          // Get the button that opens the modal
                                          var btn = document.getElementById("c_n_project");
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
                </div>
                
                
                <div id="initial" style="width: 100%;min-height: 300px;display:block">
                    <div style="width:100%;height: 20px;"></div>
                    <center>
                        
                        <?php
                        
                        $color=array("rgba(241, 241, 241,0.83)","rgba(241, 241, 241,0.63)","rgba(241, 241, 241,0.53)","rgba(241, 241, 241,0.43)","rgba(241, 241, 241,0.33)","rgba(241, 241, 241,0.23)");
                        
                        foreach($color as $color){
                            ?>
                            
                        <div style="width: 65%;height: 60px;background-color: transparent;">
                            <div style="width: 100%;height: 15px;"></div>
                            <div style="width: 100%;height: 30px;" >
                                <div style="width: 50px;height: 30px;float: left">
                                    <div  style="width: 30px;height: 30px;border-radius: 50%;background-color: <?= $color; ?>;float: left;"></div>
                                </div>
                                <div style="width: 200px;height: 30px;float: left">
                                    <div  class="waiting_box" style="background-color:<?= $color; ?>" ></div>
                                </div>
                                <div style="width: 200px;height: 30px;float: right">
                                    <div class="waiting_box" style="background-color:<?= $color; ?>;float: right;"></div>
                                </div>
                            </div>
                            <div  style="width: 100%;height: 15px;border-bottom: solid;border-bottom-color: <?= $color; ?>;border-bottom-width: 1px;"></div>
                        </div>
                            
                            <?php
                        }
                        ?>
                        
                      
                        
                    </center>
                </div>
                
                <div id="final" style="width: 100%;min-height: 400px;background-color:transparent;display:none;max-height: 93%;overflow-y: auto">
                    <div style="width: 100%;height: 20px;"></div>
                     <?php
                     $i=0;
                    
                     while( $p=mysqli_fetch_array($result1)){
                     
                       
                     
                     ?>
                     <a  href="../project/?p_id=<?= $p['p_id'] ?>&page=overview">
                     <div class="project_info" >
                         <center>
                             <div style="width: 65%;height: 45px;background-color: transparent;">
                                 
                                 <div style="width: 100%;height: 25px;padding-top: 10px;padding-bottom: 10px;">
                                     <div style="width: 50px;height: inherit;float: left">
                                        <img src="../img/pro.png" style="float: left;width: 20px;height: 20px;padding-top: 4px;">
                                     </div>
                                     <div style="width: 60%;height: inherit;background-color: transparent;float: left;">
                                        <span id="<?= 'p_name_'.$i; ?>" style="padding-top: 3px;font-size: 15px;color: #4e535a;font-family: benton-sans,Helvetica Neue,helvetica,arial,sans-serif;float: left;"></span>
                                     </div>
                                     <div style="width: 30%;height: inherit;background-color:transparent;float: right;">
                                        
                                        <div id="<?= 'image_'.$i; ?>" style="width: 80px;height: inherit;float: right;">
                                          
                                        </div>
                                        
                                        <div style="width: auto;height: inherit;float: right">
                                           <a href="#"><span id="<?= 'env_'.$i; ?>" style="padding-top: 5px;color: #596981;float: left;font-family:benton-sans,Helvetica Neue,helvetica,arial,sans-serif;font-size: 13px;"></span></a>
                                        </div>
                                        
                                       
                                     </div>
                                 </div>
                                
                             </div>
                         </center>
                     </div>
                     </a>
                  
                     <?php
                     $i++;
                     }
                     ?>
                     
                </div>
                
            </div>


<?php
 }
 else{
    
 }

?>