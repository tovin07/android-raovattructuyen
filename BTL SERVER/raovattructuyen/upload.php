<?php
$respone=array();
if(isset ($_FILES['file']))
{
   $tungvu=$_POST;
   print $_POST;
   $avatar_name = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
                move_uploaded_file($tmp_name, "./public/uploads/$avatar_name");
    $respone['result']=$tungvu;
}
else $respone['file']=0;
echo json_encode($respone);

?>
