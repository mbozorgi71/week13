
<?php
// database -------------------------------------

$host = 'localhost';
$user = 'root';
$password = '1234567';
$dbname = 'chat';

// set DSN

$dsn = 'mysql:host='. $host . ';dbname=' .$dbname;

// create pdo instance

$pdo = new PDO($dsn , $user , $password);
$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO:: FETCH_OBJ);
//$pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES ,  false);


// ----------------------------------------------
    if(isset($_POST["fname"])){
        $flag=true;

      if(strlen($_POST["fname"])<3){
        echo "invaid length";
        $flag=false;
      } 
      
      if( ! preg_match("/^[a-z-A-Z]/" ,$_POST["fname"]) ){
        echo "invaid name";
        $flag=false;
      }  

      if($flag==true){
      
        $oldData=file_get_contents('data.json');
        $data=json_decode($oldData,true) ?? array();

        $newData=[ 
            'fName'=> $_POST["fname"],
            'lName'=>$_POST["lname"],
            'email'=>$_POST["email"],
            'userName'=>$_POST["user"],
            'password'=>$_POST["password"]
           
        ];
        ///--------------- add to DB ----------

       
        //array_push($data,$newData);
        $data[]=$newData;
        $data=json_encode($data);
        file_put_contents('data.json',$data);

      }

 // # insert data
         
 $sql = 'INSERT INTO userdata(username , firstname , lastname , email  , passwoord)
 VALUES(:username ,:firstname , :lastname , :email , :passwoord)';
$stmt = $pdo ->prepare($sql);
$stmt -> execute([ 
 'username'=>$_POST["user"], 
 'firstname'=> $_POST["fname"],
 'lastname'=>$_POST["lname"],
 'email'=>$_POST["email"],
 'passwoord'=>$_POST["password"]
]);

///-----------------------------------

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css"
      rel="stylesheet"
    />

</head>
<body>
         <!-- Section: Design Block -->
<section class="text-center text-lg-start">
  

  <!-- Jumbotron -->
  <div class="container py-4 text-primary" >
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5 text-primary">Add user</h2>

            <form name="myForm" action="" onsubmit="return validateForm()" method="post">
              <!-- ------------------------------- -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text"  name="fname"  id="fName" class="form-control" />
                    <label class="form-label"  >First name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text"   name="lname"  id="lname"  class="form-control" />
                    <label class="form-label"  >Last name</label>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="user"  id="user"  class="form-control" />
                <label class="form-label"  >user name</label>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email"    class="form-control" />
                <label class="form-label"  >Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="password"  class="form-control" />
                <label class="form-label"  >Password</label>
              </div>
 
              <!-- Add user button -->
                 
                <button type="submit" name="add" id="add" password class="btn btn-primary btn-block mb-4">
                Add user
                </button>

             <a     name="next" id="next"  href="login.php" class="btn pl-5 btn-primary btn-block mb-4">
                login page
  </a>
              
              
              </div>
              <div style="display:none" id="error" name="error"></div>
            </form>
      
    <script>
const err=document.getElementById("error");

let er =[];
 
function validateForm( ) {
    //e.preventDefault();
    
    let flag=1;

    let error= document.getElementById("error");
    let firstName=document.getElementById("fName");
    let lastName=document.getElementById("lname");
    let userName=document.getElementById("user");
    let password=document.getElementById("password");
    let email=document.getElementById("email");
    let submit=document.getElementById("button[name='submit']");
    let form=document.getElementById("add");
       error.innerHTML =null;
                //------------first name---------------
                if (firstName.value.length<3) {
                er.push("  first name lenght is under 3 ");
                  flag=-1;
                }

                if (firstName.value.length>32) {
                 
                 er.push("  first name lenght is longer than 32 ");
                   flag=-1;
  
                 }

                let regex = new RegExp( "[a-z]" );

                if (!regex.test(firstName.value)) { 
                er.push(" invalid   carecter exist ");
                  
                  flag=-1;
                
                }

                //---------------------last name-----------
                if (lastName.value.length<3) {
                 
                 er.push("  last name   lenght is under 3 ");
                   flag=-1;
  
                 }
                 if (lastName.value.length>32) {
                  
                  er.push("   last name   lenght is longer than 32 ");
                    flag=-1;
   
                  }
 
                 if (!regex.test(lastName.value)) { 
                 er.push(" invalid   carecter exist in last name ");
                   
                   flag=-1;
                 
                 }
                 //--------------------password-----------

                 if (user.value.length<3) {
                er.push(" username lenght is under 3 ");
                  flag=-1;
                }

                if (user.value.length>32) {
                 
                 er.push(" password lenght is longer than 32 ");
                   flag=-1;
  
                 }
                 ///-------------- username -------------------


                 if (password.value.length<4) {
                er.push(" username lenght is under 3 ");
                  flag=-1;
                }

                if (password.value.length>32) {
                 
                 er.push(" password lenght is longer than 32 ");
                   flag=-1;
  
                 }
                 let regexUserName = new RegExp("^[a-z-A-Z-0-9]");

                  if (!regex.test(firstName.value)) { 
                  er.push(" invalid   carecter exist in username ");
                    
                    flag=-1;

                  }
                 //--------------email------------------
                 const re ="/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i";
                 
                 if (!regex.test(email.value)) { 
                  er.push(" invalid email address ");
                    
                    flag=-1;

                  }

                 //---------------------------------------------
                console.log(er);


   er.forEach( function(myError){

    error.style.display="block";
    console.log(myError);
    error.innerHTML += myError;

   } );

    er=[];

    if(flag>0){return true;}
    else  {return false}
   
   
   

}
</script>
          </div>
        </div>
      </div>
 
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block


</body>
</html>