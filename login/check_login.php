<?php

  $conn=mysqli_connect('localhost','root','shivam');
  $db=mysqli_select_db($conn,'on');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['login'])){
          if(empty($_POST['u_name']) || empty($_POST['password'])){
            
            echo 'set detail';
            
          }
          else{
              $pass=mysqli_real_escape_string($conn,$_POST['password']);
              $uname=mysqli_real_escape_string($conn,$_POST['u_name']);
             
            
                $sql="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
                
                if($result=mysqli_query($conn,$sql)){
                    $nro=mysqli_num_rows($result);
                    if($nro == 1){
                             session_start();
                             $_SESSION['u_name']=$uname;
                             $_SESSION['pass']=$pass;
                             $_SESSION['authentication']=true;
                             header("Location:../home");
                             exit();
                    }
                    else{
                        echo 'encorrec id or passeord';
                    }
                }
                else{
                    header("Location:../");
                    exit();
                }
             
          }
      }
      else{
         header("Location:../");
         exit();
      }
   }
   else{
       header("Location:../");
       exit();
   }

?>