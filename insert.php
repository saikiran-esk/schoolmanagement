

<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email    = $_POST['email'];
$gender   = $_POST['Gender'];
if(!empty($username) && !empty($password) && !empty($email) && !empty($gender))
{
 $host="localhost";
 $dbUsername="root";
 $dbPassword="";
 $dbname="registration";
 $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
 if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
 }
 else{
    $SELECT ="SELECT email from register where email=? Limit 1";
    $INSERT ="INSERT INTO register (username,password,email,Gender) values(?,?,?,?)";
    
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssss",$username,$password,$email,$gender);
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
