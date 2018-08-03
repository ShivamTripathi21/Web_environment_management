<?php
sleep(4);

session_start();
 if($_SESSION['authentication']){
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    
    $query="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    
    if($row['u_id']==$_POST['id']){ 
    
       if($_SERVER["REQUEST_METHOD"]=='POST'){
            if($_POST['p_name'] == null || $_POST['access'] == 0){
               echo 'Project can not setup';
            }
            else{
                $pn=mysqli_real_escape_string($conn,$_POST['p_name']);
                $id=mysqli_real_escape_string($conn,$_POST['id']);
                $a=mysqli_real_escape_string($conn,$_POST['access']);
                $sql0="SELECT * FROM project WHERE p_name='$pn'";
                $res0=mysqli_query($conn,$sql0);
                $nro0=mysqli_num_rows($res0);
                if($nro0 > 0){
                   echo 'Project name is not avilable';
                }
                elseif($nro0 == 0){
                   $sql="INSERT INTO `project`(`p_id`, `p_name`, `u_id`, `access`, `envoir_id`, `req_f_add`, `image_id`,`p_s_time`) VALUES (NULL,'$pn','$id','$a','1','1',NULL,NULL)";
                   if(mysqli_query($conn,$sql)){
                      mkdir("../../project_files/".$pn, 0777,true);
                      $my_file = "../../project_files/".$pn.'/requirements.txt';
                      $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
                      $data ='Flask';
                      fwrite($handle, $data);
                      $ndata="\n".'Redis';
                      fwrite($handle, $ndata);
                      fclose($handle);
                      $d_file = "../../project_files/".$pn.'/Dockerfile';
                      $handled= fopen($d_file, 'w') or die('Cannot open file:  '.$d_file);
                      $data1 ='FROM python:latest'."\n".'RUN mkdir -p /app'."\n".'WORKDIR /app'."\n".'ADD . /app'."\n".'#RUN pip install -r requirements.txt';
                      fwrite($handled, $data1);
                      fclose($handled);
                      try{
                        $a = new PharData("../../project_files/".$pn."/version_1.tar");
                        $a->buildFromDirectory("../../project_files/".$pn);
                       }
                       catch (Exception $e) {
                                // handle errors here
                                echo 'Zip is not created, contact ricst support';
                       }
                                            
                      echo 'ok';
                   }
                   else{
                      echo 'Problem during creating project';
                   }
                }
            }
       }
    
    }
    
 }
?>