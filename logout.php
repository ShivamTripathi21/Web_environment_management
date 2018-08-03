<?php
session_start();
if($_SESSION['authentication']){
    session_destroy();
    header('Location:./');
}
else{
   session_destroy();
   header('Location:./'); 
}

?>