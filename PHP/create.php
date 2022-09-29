<!-- CONSUMING THE DATA LOCALLY. No need for the action form attribute but the method is important for the sake of a clue.  --> 
<?php
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successMessage = "";

// Creating connnection to the database.
$servername="localhost";
        $username="id19643036_root";
        $password="l1Sx[MAu}L)DMvb5";  
        $database="id19643036_todoapp";
// Database connection string & Testing.
        $connection = new mysqli($servername,$username,$password,$database);
//Checking/ Verifying Connection.
    if($connection->connect_error){
        die("Connection failed: " . $connection->error);
            }

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
    $address= $_POST["address"];

    do{
        if(empty($name)||empty($email)||empty($phone)||empty($address)){
            $errorMessage="All the fields are required";
            break;
        }
        // The interesting pattern is already known. Save query in variable parse the variable to the connection string for cleaner & more undestandable code.
        $sql = "INSERT INTO clients(name,email,phone,address)"."VALUES('$name','$email','$phone','$address')";
        $result = $connection->query($sql); //Here is where we execute the sql query
        
        if(!$result){//If any error we display our custom error message and break out of the while loop(No further execution.)
            // $errorMessage = "Invalid query : " . $connection->error; 
            die("Invalid query:" . $connection->error);
            break; 
        }

        // Then we set our variables to blanks.
        $name="";
        $email="";
        $phone="";
        $address="";
        // Then we output the success message since it is not empty. 
        $successMessage = "Client added successfully.";

        header("location: /todoApp/HTML/index.php");
        exit;

    }while(false); 

}
// <!-- Cheking if the data has been transmitted using the post method. -->

// <!-- We are just checking if the fields are empty alafu we do the necessary actions.Php goes line by line . So we can break out b4 it even sees the crack of dawn. -->
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5">
        <h2>New Client Information</h2>
        <?php 
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            </div>";
        }?>
        <form method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $email?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-3 col-form-label">Contact</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address?>">
                </div>
            </div>
            <?php 
        if(!empty($successMessage)){
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            </div>";
        }?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             <div class="col-sm-3 d-grid">
                    <a role="button" href="/todoApp/HTML/index.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>


        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>