<html>
<?php
$host="localhost";
$uname="root";
$pass="";
$db="hr";
$link=@mysql_connect($host,$uname,$pass) or
die("<script><alert>Server Error</alert></script>");
@mysql_select_db($db) or 
die("<script><alert>Database error</alert></script>");
?>
 <head>
  <!--find-->
<?php
if(isset($_POST['find']))
{
  $uid=$_POST['uid'];
  $qry="select * from usermaster where UserId=$uid";
  $rs=mysql_query($qry) or die(mysql_error()); 
  $row=mysql_fetch_array($rs);
  echo $uid;
}
if(isset($_POST['update']))
{ $uid=$_POST['uid'];
  $uname=$_POST['uname'];
  $upass=$_POST['upass'];
  $ufname=$_POST['ufname'];
  $uemail=$_POST['uemail'];
  $umobile=$_POST['umobile'];
  $uaddress=$_POST['uaddress'];


  $qry="update usermaster set UserName='$uname', Password='$upass', FullName='$ufname', 
  Email='$uemail', Mobile= $umobile, Address='$uaddress' where UserId=$uid";
  mysql_query($qry) or die(mysql_error());
  if(mysql_affected_rows()>0)
  {
    echo "<script><alert>Records Updated</alert></script>";
  }
}
?>
  <link href="MyCss.css" type="text/css" rel="stylesheet" />
 </head>
 <body bgcolor=silver>
  
  <center><h1>Working with Database in PHP</h1>
   <hr>
   <form method="post" enctype="multipart/form-data">
    <div align="left">
     

      <table align="center">
        <tr>
        <td>User Id</td><td><input  type="text" name="uid" placeholder="enter user id" 
        value="<?php if(isset($row)){ echo $row[0]; } ?>"/>
        <input  type="submit" name="find"  value="Find Info"/></td></tr>
        <tr><td>UserName</td><td><input  type="text" name="uname" placeholder="enter username" 
          value="<?php if(isset($row)){echo $row[1];} ?>" /></td></tr>
        <tr><td>Password</td><td><input  type="password" name="upass" 
          value="<?php if(isset($row)){echo $row[2];} ?>" placeholder="enter password"/></td></tr>
        <tr><td>Full Name</td><td><input  type="text" name="ufname" 
          value="<?php if(isset($row)){echo $row[3];} ?>" placeholder="enter full name"/></td></tr>
        <tr><td>Email</td><td><input  type="text" name="uemail" 
          value="<?php if(isset($row)){echo $row[4];} ?>" placeholder="enter email"/></td></tr>
        <tr><td>Mobile</td><td><input  type="text" name="umobile" 
          value="<?php if(isset($row)){echo $row[5];} ?>" placeholder="enter mobile" maxlength="10"/>
        </td></tr>
        <tr><td>Image</td><td><input type="file" name="fil"/></td></tr>
        <tr><td>Address</td><td><textarea name="uaddress"  placeholder="enter address" >
          <?php if(isset($row)){echo $row[7];} ?></textarea></td></tr>

        <tr><td colspan="2">
             <input  type="submit" name="insert"  value="Save Record"/>
             <input  type="submit" name="update"  value="Update Record"/>
             <input  type="submit" name="delete"  value="Delete Record"/>
             <input  type="submit" name="view"  value="View All"/>
           </td>
        </tr>
      </table>
     
   </div>
   </form>
  </center>
 </body>
</html>
<!--display-->
<?php
if(isset($_POST['view']))
{
  echo "<center><table>";
  $qry="select * from usermaster";
  $rs=mysql_query($qry)
  or die(mysql_error());
  $count=mysql_num_fields($rs);
  echo "<table border='3'><tr><th>ID</th><th>USERNAME</th><th>PASSWORD</th><th>FIRST NAME</th>
  <th>EMAIL</th><th>MOBILE</th><th>IMAGE</th><th>ADDRESS</th></tr>";
  while($row=mysql_fetch_array($rs))
  {
    echo "<tr>";
    for($i=0;$i<$count;$i++)
    { 
      if($i==6)
      {
        echo "<td><img src='image.php?id=$row[0]' height='100px' width='100px'></td>";
      }
      else{
      echo "<td>$row[$i]</td>";
    }
    }
    echo "</tr>";
  }
  echo "</table></center>";
}
?>
<!---INSERT-->
<?php
if(isset($_POST['insert']))
{
  $uid=$_POST['uid'];
  $uname=$_POST['uname'];
  $upass=$_POST['upass'];
  $ufname=$_POST['ufname'];
  $uemail=$_POST['uemail'];
  $umobile=$_POST['umobile'];
  $uaddress=$_POST['uaddress'];

  $filename=$_FILES['fil']['name'];
  $filetname=$_FILES['fil']['tmp_name'];
  $filesize=$_FILES['fil']['size'];
  $filetype=$_FILES['fil']['type'];
  $filerror=$_FILES['fil']['error'];

  $imagepath=fopen($filename,"r");
  $bfil=fread($imagepath,$filesize);
  $image=addslashes($bfil);

  $qry="insert into usermaster 
  values($uid,'$uname','$upass','$ufname','$uemail',$umobile,'$image', '$uaddress')";
  mysql_query($qry) or die(mysql_error());
  if(mysql_affected_rows()>0)
  {
    echo "<script><alert>Records inserted</alert></script>";
  }
}
?>
<!---Delete-->
<?php
if(isset($_POST['delete']))
{
  $uid=$_POST['uid'];
  $qry="delete from usermaster where UserId=$uid";
  mysql_query($qry) or die(mysql_error());
}
?>

