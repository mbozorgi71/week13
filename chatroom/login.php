
<?php
session_start();

    if(isset($_POST["login"]))
    {
      //----DB ---------------
     $flag = -1;

$host = 'localhost';
$user = 'root';
$password = '1234567';
$dbname = 'chat';

// set DSN

$dsn = 'mysql:host='. $host . ';dbname=' .$dbname;

// create pdo instance

$pdo = new PDO($dsn , $user , $password);
$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO:: FETCH_OBJ);

$sql = 'SELECT *FROM userdata';
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
$user = $stmt -> fetchAll();

foreach($user as $us)
{
   if( $us->username ==$_POST["user"] &&  $us->passwoord ==$_POST["password"] )
   {
       $flag= 1;
       $_SESSION["name"] = $us->username;
     
       echo "hello  ". $_SESSION["name"] ."  you are logged in";
       header('Location: room.php');
       break;
   } 
}


      //----------------------
        //jason file
        /*
          $data= file_get_contents("data.json");
          $flag=-1;
          $data=json_decode($data,true);
          $use=$_POST["user"];
          $pass=$_POST["password"];

          foreach($data as $a){
            if($use==$a['user'] && $pass==$a['password'] ){
              
          $_SESSION["name"] = $use;
 
              $flag=1;
              echo "you are logged in";
              break;
            
            } 
          }
           */
        if($flag==-1)
        {
        echo "you are not logged in";}
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
<section class="text-center text-lg-start text-primary">
 

  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">enter username and password</h2>
            <form name="myForm" action="" onsubmit="return validateForm()" method="post">
              <!-- 2 column grid layout with text inputs for the first and last names -->
               

              <div class="form-outline mb-4">
                <input type="text" name="user"   class="form-control" />
                <label class="form-label"  >user name</label>
              </div>
               

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" />
                <label class="form-label"  >Password</label>
              </div>
 
               
                <!-- Login in button -->
                <button type="submit" name="login" class="btn btn-primary btn-block mb-4">
                Login now
              </button>
              </div>
            </form>
          </div>
        </div>
      </div>
 
    </div>
  </div>
  
</section>
<!-- Section: Design Block


</body>
</html>