<?php
$servername="localhost";
$username="root";
$password="";
$bdname="registration";
$conn = mysqli_connect($servername,$username,$password,$bdname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
else{
   // echo "connection successful";
}
extract($_POST);

if(isset($_POST['readrecord'])){
    $data = '<table class="table table-bordered table-striped">
         <tr>
            <th>No.</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>email</th>
            <th>phone</th>
            <th>age</th>
            <th>edit</th>
            <th>delete</th>
         </tr>';
     $display="select * from `ajax` ";

     $result  = mysqli_query($conn,$display);

     if(mysqli_num_rows($result)>0){
         $number = 1;

         while($row=mysqli_fetch_array($result)){
             $data .='<tr>
                     <td>'.$number.'</td>
                     <td>'.$row['firstname'].'</td>
                     <td>'.$row['lastname'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['phone'].'</td>
                     <td>'.$row['age'].'</td>
                     <td> 
                      <button onclick="getUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
                      </td>
                      <td> 
                      <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">delete</button>
                      </td>
                      </tr>';
                      $number++;

         }
     }
     $data.='</table>';
     echo $data;

}


if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['age'])){
   $sql="insert into ajax SET firstname='$firstname',lastname='$lastname',email='$email',phone='$phone',age='$age'";

   mysqli_query($conn,$sql);

}

//delete user records

if(isset($_POST['deleteid'])){
    $userid = $_POST['deleteid'];

    $deleteq="DELETE FROM ajax WHERE id='$userid'";
    mysqli_query($conn,$deleteq);

}


//get userid for update

if(isset($_POST['id'])){
    $user_id = $_POST['id'];

    $upsql="select * from ajax where id='$user_id'";

    if(!$result = mysqli_query($conn,$upsql)){
        exit(mysqli_error());
    }


    $response = array();
    
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }
    }else{
        $respnse['status']=200;
        $response['message']="data not found";
    }

    //it converts to json 
        echo json_encode($response);
}

else{
 $response['status']=200;
 $response['message']="Invalid Request !!!!";
}

//update
if(isset($_POST['hidden_id'])){
   // echo "<pre>";
   // print_r($_POST);
    
    $hidden_id=$_POST['hidden_id'];
    $fname = $_POST['fname'];
    $lsname = $_POST['lsname'];
    $em = $_POST['em'];
    $ph = $_POST['ph'];
    $age = $_POST['age'];

    $QUER = "UPDATE `ajax` SET `firstname`='$fname',`lastname`='$lsname',`email`='$em',`phone`='$ph',`age`='$age' WHERE id='$hidden_id'";

    mysqli_query($conn,$QUER);
}

?>