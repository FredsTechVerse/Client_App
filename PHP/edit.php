<!-- WORKING PRINCIPLE -->
<!-- a) 2 METHODS ARE INVOLVED HERE[GET & POST].Get is involved while fetching the page and post involved 
     when submitting the form data.
     b) Since the data is being submitted to the same mother page , the action form attribute is not required but the method
     remains constant.
     c) Ideally , the get method executes b4 the post method.THe if else statement is here to give direction so as to avoid confusion.
 -->

 <?php 
// Creating connnection to the database.
$servername="localhost";
$username="root";
$password="";
$database="todoapp"; 
// Database connection string & Testing.
$connection = new mysqli($servername,$username,$password,$database);
//Checking / Verifying Connection.
if($connection->connect_error){
die("Connection failed: " . $connection->error);
}

//  INITIALIZATION OF THE VARIABLES IN PLAY. 
// ==========================================
$id = "";
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["id"])){
        header("location: /todoApp/HTML/index.php");//PHP gesture for performing redirects.
        exit;
    }

    $id = $_GET["id"];

    //  Reading the row of the selected client from the db.
    $sql = "SELECT * FROM clients WHERE id=$id ";//THe query
    $result = $connection->query($sql); //Execution of the SQL query
    $row = $result->fetch_assoc(); // Reading the data from the database in the form of an associative array.

    // If there is no data from the database we direct user to the homepage and seize further execution of this file
    if(!$row){
        header("location : todoApp/HTML/index.php");
        exit;
    }

    // Otherwise we read the data from the database. 

    $name = $row["name"];
    $email= $row["email"];
    $phone= $row["phone"];
    $address= $row["address"];

}else{
    // IF THE METHOD IS A POST METHOD...
    // Step 1 : We read the values from the post method.
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
    $address= $_POST["address" ];
    // Step 2 : Using the do while loop to check if there is an empty field.
    do {
        // LOGIC : If any field is empty, we display the error message & seize further execution of the while loop.
        if(empty($id)||empty($name)||empty($email)||empty($phone)||empty($address)){
            $errorMessage="All the fields are required";
            break;
        }

        // Otherwise we create and execute the SQL query.
        $sql = "UPDATE clients
        SET name='$name',email='$email',phone='$phone',address='$address'
        WHERE id = $id";

        $result = $connection->query($sql); 

        // If we don't get the results as expected... What should then happen? Let us find out.
        if (!$result){
            $errorMessage = "Invalid query : " . $connection->error;
            break;
        } 
       $successMessage = "Client data updated successfully.";
        // Having no other business to perform , we head to the homepage and seize file operations.
        header("location:/todoApp/HTML/index.php");
        exit;
    } while (true);
}
?>
     
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5">
        <h2>Edit Client Information</h2>
        <?php 
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            </div>";
        }?>
        <form method="post">
            <!-- A hidden input needed to store the id attribute. -->
            <input type="hidden" name="id" value="<?php echo $id;?>">
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