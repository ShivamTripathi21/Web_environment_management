<?php

  $conn=mysqli_connect('localhost','root','shivam');
  $db=mysqli_select_db($conn,'on');

   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['signup'])){
          if(empty($_POST['f_name']) || empty($_POST['l_name']) ||  empty($_POST['u_id']) ||  empty($_POST['email']) ||  empty($_POST['password'])){
            
            echo 'set detail';
            
          }
          else{
              $pass=mysqli_real_escape_string($conn,$_POST['password']);
              $uid=mysqli_real_escape_string($conn,$_POST['u_id']);
              $email=mysqli_real_escape_string($conn,$_POST['email']);
              if(strlen($pass) >= 8 && strlen($pass) <= 15){
                
                     $query="SELECT u_name FROM user WHERE u_name='$uid'";
                     $result=mysqli_query($conn,$query);
                     $n_row=mysqli_num_rows($result);
                     if($n_row == 0){
                         //every thin ok
                          $query1="SELECT email FROM user WHERE email='$email'";
                          $result1=mysqli_query($conn,$query1);
                          $n_row1=mysqli_num_rows($result1);
                          if($n_row1 == 0){
                            
                             $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
                             $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
                             
                             $sql="INSERT INTO `user`(`u_id`, `u_name`, `f_name`, `l_name`, `email`, `pass`, `signup_time`) VALUES (NULL,'$uid','$fname','$lname','$email','$pass',NULL)";
                                    
                             $result=mysqli_query($conn,$sql)or die(header('Location:./'));
                             session_start();
                             $_SESSION['u_name']=$uid;
                             $_SESSION['pass']=$pass;
                             $_SESSION['authentication']=true;
                             header("Location:../home");
                             exit();
                            
                          }
                          else{
                            echo 'email is already registered';
                          }
                        
                     }
                     else{
                        echo 'ricst id is not avilable for you';
                     }
                
              }
              else{
                  echo 'too small or big password';
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