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
    
     
    
       if($_SERVER["REQUEST_METHOD"]=='POST'){
           $id=$row['u_id'];
           $sql="SELECT * FROM env";
           $res=mysqli_query($conn,$sql);
           $n_row=mysqli_num_rows($res);
           
           $ans['no_env']=$n_row;
           
           if($n_row == 0){
               print(json_encode($ans));
           }
           elseif($n_row > 0){
              $i=0;
              while($rowp=mysqli_fetch_array($res)){
                 $ans[$i]['e_name']=$rowp['env_name'];
                 $ans[$i]['e_ver']=$rowp['version'];
                 $ans[$i]['e_desc']=$rowp['env_desc'];
                 
                 if($rowp['u_id'] == 0){
                    $ans[$i]['owner']='Ricst-managed';
                 }
                 if($rowp['u_id'] != 0){
                    $fid=$rowp['u_id'];
                    $sql1="SELECT f_name,l_name FROM user WHERE u_id='$fid'";
                    $res1=mysqli_query($conn,$sql1);
                    $row1=mysqli_fetch_array($res1);
                    
                    $ans[$i]['owner']=$row1['f_name'].' '.$row1['l_name'];
                 }
                
                 if($rowp['env_access'] == '1'){
                    $ans[$i]['access']='Public';
                 }
                 if($rowp['env_access'] == '2'){
                    $ans[$i]['access']='Private';
                 }
                 
                 if($rowp['env_name'] == 'Ricst-Default'){
                    $ans[$i]['env_type']='Default-';
                 }
                 if($rowp['env_name'] != 'Ricst-Default'){
                    $ans[$i]['env_type']='';
                 }
    
                 $i++;
              }
              
              print(json_encode($ans));
           }
          
       }
    
    
    
 }
?>
