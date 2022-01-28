<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<
</head>
<body>
  
<div class="container">
 <h1 class="text-success text-uppercase text-center">ajax crud operation</h1>
   <div class="d-flex justify-content-end">
   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">click here</button>
   </div>
   <h2 class="text-danger">All Records</h2>
   <div id="record_contant"></div>
   <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Put Your Infomation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
        <label for="">Firstname :</label>
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name">
       </div>

       <div class="form-group">
        <label for="">Lastname :</label>
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="last name">
       </div>
       <div class="form-group">
        <label for="">Email ID :</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="enter email">
       </div>
       <div class="form-group">
        <label for="">Ph-Number :</label>
        <input type="number" name="phnumber" id="phnumber" class="form-control" placeholder="mobile number">
       </div>
    
       <div class="form-group">
        <label for="">Age :</label>
        <input type="number" name="age" id="age" class="form-control" placeholder="enter age">
       </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--update model-->
<div class="modal" id="update_user_model">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Put Your Infomation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
        <label for="">Firstname :</label>
        <input type="text" name="firstname" id="upfirstname" class="form-control" >
       </div>

       <div class="form-group">
        <label for="">Lastname :</label>
        <input type="text" name="lastname" id="uplastname" class="form-control">
       </div>
       <div class="form-group">
        <label for="">Email ID :</label>
        <input type="email" name="email" id="upemail" class="form-control" >
       </div>
       <div class="form-group">
        <label for="">Ph-Number :</label>
        <input type="number" name="phnumber" id="upphnumber" class="form-control" >
       </div>
    
       <div class="form-group">
        <label for="">Age :</label>
        <input type="number" name="age" id="upage" class="form-control" >
       </div>

      </div>

      <!-- Modal footer -->
       
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateUserDetails()">save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_id">

      </div>
     
    </div>
  </div>
</div>
</div>


      

 
   
<!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript">

   $(document).ready(function(){
    readRecord();
   });
       //for fetched data
     function readRecord(){
           var readrecord="readrecord";
           $.ajax({
             url:"backend1.php",
             type:"post",
             data:{readrecord : readrecord},
            success:function(data,status){
              $('#record_contant').html(data);
            }
           });
     }
       //for add records
    function addRecord(){
        var firstname= $('#firstname').val();
        var lastname= $('#lastname').val();
        var email= $('#email').val();
        var phone= $('#phnumber').val();
        var age= $('#age').val();
        
        $.ajax({
        url:"backend1.php",
        type:'post',
        data: {firstname : firstname,
             lastname : lastname,
             email : email,
             phone : phone,
             age : age

        },
        success:function(data,status){
            readRecord();
        }

        });
    }

    //delete records
  function  DeleteUser(deleteid){
      //for alert we used next line
      var conf = confirm("are you sure to delete your records");
      if(conf==true){
        $.ajax({
          url:"backend1.php",
          type:"post",
          data:{deleteid:deleteid },
          success:function(data,status){
            readRecord();
          }
        })
      }

    }

    //update the user

    function getUserDetails(id){
      $('#hidden_id').val(id);
      $.post("backend1.php",{id:id},
         function(data,status){
           var user = JSON.parse(data);
           console.log(data);

           $('#upfirstname').val(user.firstname);
           $('#uplastname').val(user.lastname);
           $('#upemail').val(user.email);
           $('#upphnumber').val(user.phone);
           $('#upage').val(user.age);

         }
         );
            $('#update_user_model').modal("show");
    }


    function updateUserDetails(){
     var fname = $('#upfirstname').val();
      var lsname = $('#uplastname').val();
       var em = $('#upemail').val();
        var ph = $('#upphnumber').val();
         var age =$('#upage').val();
        // console.log(age);
         var hidden_id = $('#hidden_id').val();

         $.post("backend1.php",{
          hidden_id:hidden_id,
          fname:fname,
          lsname:lsname,
          em:em,
          ph:ph,
          age:age
         },
         function(data,status){
          $('#update_user_model').modal("hide");
          readRecord();
         }
         
         
         
         );

    }

</script>
 
</body>
</html>