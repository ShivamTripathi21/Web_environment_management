<?php

   sleep(1);
 session_start();
 if($_SESSION['authentication']){
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');
    
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    
    $query="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    $uid=$row['u_id'];
  
    if(isset($_POST['button']) && isset($_POST['pid'])){
    if($_SERVER["REQUEST_METHOD"]=='POST'){
        
           $pid=$_POST['pid']; 
            
           if($_FILES['file']['size'] == 0){
               header("Location:../../project/?p_id=".$pid."&page=files&msg=Select file from your device");
           }
           else{
              $size=$_FILES['file']['size']; 
              $type=$_FILES['file']['type'];
              
                 
                 $sql0="SELECT p_name,p_id,req_f_add,image_id FROM project WHERE p_id='$pid'";
                 $res0=mysqli_query($conn,$sql0);
                 $row0=mysqli_fetch_array($res0);
                 
                 $p_name=$row0['p_name'];
                 $p_id=$row0['p_id'];
                 $rf=$row0['req_f_add'];
                 
                 $dir='../../project_files/'.$p_name.'/'.$_FILES['file']['name'];
                 $file_d=$_FILES['file']['tmp_name'];
              
                 $file=file_get_contents($file_d);
              
                 if(file_exists('../../project_files/'.$p_name.'/'.$_FILES['file']['name'])){
                     header("Location:../../project/?p_id=".$pid."&page=files&msg=File name is already exist");
                 }
                 else{
                     move_uploaded_file($file_d,$dir);
                     
                     $f_name=$_FILES['file']['name'];
                    
                     $fn='version_'.$rf.'.tar';
                    
                     unlink("../../project_files/".$p_name."/version_".$rf.".tar");
                   
                         try{
                           $a = new PharData("../../project_files/".$p_name."/".$fn);
                           $a->buildFromDirectory("../../project_files/".$p_name);
                         }
                         catch (Exception $e) {
                                // handle errors here
                                echo 'Zip is not created, contact ricst support';
                          }
                     
                     
                     
                       
                     $sql="INSERT INTO `files`(`f_id`, `f_name`,`p_id`, `u_id`, `f_type`, `f_size`, `owner_id`,`version`, `tag`,`u_time`) VALUES (NULL,'$f_name','$p_id','$uid','$type','$size','$uid','1',NULL,NULL)";
                     
                     if($row0['image_id']==null){
                       //image is not build
                     }
                     else{
                         
                          $img=$row0['image_id'];
                          
                          //remove image
                          $url='http://localhost:4243/images/'.$img;
                          $options = array(
                               'http' => array(
                                   'method'  => 'DELETE'
                                 )
                          );

                           $context  = stream_context_create($options);
                           $result = file_get_contents($url, false, $context);
                           var_dump($result);
                          
                          
                          
                          $sql1="UPDATE `project` SET `image_id`=NULL WHERE p_id='$p_id' AND u_id='$uid'";
                          $res1=mysqli_query($conn,$sql1);
                          
                      }
                      
                        //first file
                        //build image
                         //build image first
                         $url='http://localhost:4243/build';
                         $rf=$row0['req_f_add'];
                         $pn=$row0['p_name'];
                        
                         $remote='http://localhost/on/project_files/'.$pn.'/version_'.$rf.'.tar';
                         //echo $remote;
                         $t=$row0['p_name'];
                    
                         $data = array('remote' => $remote,'t' => $t);
                     
                         $options = array(
                             'http' => array(
                             'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                             'method'  => 'POST',
                             'content' => http_build_query($data),
                              )
                         );

                         $context  = stream_context_create($options);
                         $result = file_get_contents($url, false, $context);
                         //image built sucessfully
                         //echo var_dump($result);
                    
                         //update null
                    
                         $sql2="UPDATE `project` SET `image_id`='$pn' WHERE p_id='$p_id' AND u_id='$uid'";
                         $res2=mysqli_query($conn,$sql2);
                     
                        //image is built for current existing files.
                     
                     
                     
                     if(mysqli_query($conn,$sql)){
                         header("Location:../../project/?p_id=".$pid."&page=files&msg=File is uploded");
                     }
                     else{
                        header("Location:../../project/?p_id=".$pid."&page=files&msg=Can not insert in database");
                     }
                     
                 }
                 
              
            
           }
           
           
    }
    else{
        header("Location:../../project/?p_id=".$pid."&page=files");
    }
    }
    else{
       header("Location:../../project/?p_id=".$pid."&page=files");
       exit();
    }
    
    
 }
 else{
    header("Location:../../");
    exit();
 }
?>