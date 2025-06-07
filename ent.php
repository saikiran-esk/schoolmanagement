<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email    = $_POST['email'];
$Gender   = $_POST['Gender'];
if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($Gender))
{
 $host="localhost";
 $dbUsername="root";
 $dbPassword="";
 $dbname="entry";
 $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
 if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
 }
 else{
    $SELECT ="SELECT email from persondetails where email=? Limit 1";
    $INSERT ="INSERT INTO persondetails (first_name,last_name,email,Gender) values(?,?,?,?)";
   
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssss",$first_name,$last_name,$email,$Gender);
        $stmt->execute();
        echo "New record inserted sucessfully ";
    }
    else{
        echo "Someone already registered with email";
    }

    $stmt->close();
    $conn->close();
 }
}
else
{
    echo "All fields are empty";
    die();
}
?>