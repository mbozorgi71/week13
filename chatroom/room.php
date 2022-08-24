<?php
session_start();

function func()
{
    $host = 'localhost';
    $user = 'root';
    $password = '1234567';
    $dbname = 'chat';
    
    // set DSN
    
    $dsn = 'mysql:host='. $host . ';dbname=' .$dbname;
    
    // create pdo instance
     
    $pdo = new PDO($dsn , $user , $password);
    $pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO:: FETCH_OBJ);
    
     
    $sql = 'SELECT *FROM usermessage';
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $msg = $stmt -> fetchAll();
    
    // echo "<pre>";
    // print_r($msg);
        //print_r($msg);
 
        return $msg;
}

 if(isset($_POST['send']))
 {

   // session_destroy() ;
    // echo "<pre>";
    // print_r($_POST);
    // echo "<br>".$_SESSION['name'];

$host = 'localhost';
$user = 'root';
$password = '1234567';
$dbname = 'chat';

// set DSN

$dsn = 'mysql:host='. $host . ';dbname=' .$dbname;

// create pdo instance
 
$pdo = new PDO($dsn , $user , $password);
$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO:: FETCH_OBJ);

 
//-------------------------------------
$sql = 'INSERT INTO usermessage(massage,username)
VALUES(:massage,:username)';
$stmt = $pdo ->prepare($sql);
$stmt -> execute([ 
'massage'=>$_POST["massage"], 
'username'=>$_SESSION["name"]
  
]);

 }
 //--------delete


//------------------------------------
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
            
            <form name="myForm" action="" onsubmit="return validateForm()" method="post">
              <!-- 2 column grid layout with text inputs for the first and last names -->
             <div class="row">  
              <div class=" col-sm form-outline mb-4">
                <input type="text" name="massage"   id="massage" placeholder="enter your message" class="form-control" />
            
              </div>
                <!-- send button -->
                <button type="submit" name="send" class=" col-sm btn btn-primary  w-50 h-50   ">
                send
              </button>
             </div>

              </div>

              <?php 
 //-------------------------
 
 $msg = func();
 
 //print_r($msg);

 foreach($msg as $m)
 {
     //echo $row['title'] . '<br>';
 
 //------------------------
  
    ?>
<div class="d-flex flex-row">
  <div class="p-2">
    <?php echo $m->username. ' : ';
          echo $m->massage; ?>
  </div>
  <div class="p-2">
  <div class="form-outline mb-4">
                <input type="edit" name="edited" placeholder="edit now"  class="form-control" />
                 
              </div>
  </div>
  <div class="p-2">
     <!-- Login in button -->
     <button type="submit" name="edit" class="btn btn-primary btn-block mb-4">
                edit
     </button>
  </div>
  <div class="p-2">
  <button type="submit" name="delete" class="btn btn-primary btn-block mb-4">
                delete
     </button>
  </div>
</div>
<?php }?>

            </form>
          </div>
        </div>
      </div>
 
    </div>
  </div>
  
</section>
 
</body>
</html>