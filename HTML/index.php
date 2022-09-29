<!DOCTYPE html>
<!-- BUGS TO FIX -->
<!-- How do i handle redirects? Error pops up kinda insinuating that the header has already been send -->
<!-- Hiding valuable information in PHP . My passwords and stuff like that. -->
<!-- Optimization & Lovely Design of website to look like a real application. -->
<!-- SUBJECTS TO LEARN -->
<!-- ================= -->
<!-- 1) I have to get farmiliar with the do while loop.
     2) Go through the SQL crud operations. Get comfortable.
     3) Farmiliarize with the do while loop and how it helps with destructure.
     4) Learn how to destructure fetched data from the DB other than the associative array format. '
        Get to destructure like real men dealing with indexed arrays and objects.
     5) Get to undestand the role of (->) for destructure and why the hell php doesn't use template literal for string concatenation and uses (.)
     6) We also have to get into the knowlege of inbuild variable object e.g $_SERVER , $_REQUEST , $_POST , $_GET coz it feels like 
        they are the main players when it comes to playing around with mysql and form for right functionalities.
     7) isset() = Wow... Determines if a variable is declared and returns true if the variable has a different value from NULL.
     8) Working with the url parameters php.
     9) Hosting PHP script and the DB in real time so that the world out there can see.
     10) What is the role of the hidden id input ? Meditate upon it and is echo value just a sugar syntax ? Ama it represents the default value? We need to find this out.
     11) How do I save names with apostrophe's to the database.
-->

<!-- OBSERVATIONS -->
<!-- ============ -->
<!-- THE DEFINATIONS AS YOU USE THIS KEYWORDS REALLY SLAP . DON'T SWEAT, USE THIS TO YOUR BENEFIT . I SWEAR FULLSTACK WEB DEV IS ALL ABOUT CONFIDENCE.THE REST
    WE LEARN AS WE GO & UNCLE GOOGLE IS ALWAYS THERE TO HELP US OUT WHEN WE GET STACK . KEEP THIS AT HEART -->

<!-- THE GOSPEL OF MASTERING ONE LANGUAGE THEN SWITCHING TO ANOTHER IS REALLY TRUE . THE CONCEPTS REALLY REMAIN THE SAME . JUST ENSURE THAT YOU GOT EVERYTING RIGHT
IN ONE LANGUAGE. SWITCHING ITAKUWA SO EASY . COZ ITS JUST A MATTER OF CHANGING THE SYNTAX TO DO THE SAME LOGIC, -->

<!--a) Die() Is a form of console.log for the mysql db especially when anything goes wrong. Its like a suicide note detailing what happened b4 death.
       You know they never got to echo out their concerns.
    b) Double quotes cannot be used inside double quotes. You know , we have to differentiate this things. 
    c) It seems that double quotes is the king of PHP. Its used in speedy and easy text and php variables concatenation just like template literals pale Javascript
       It also performs its primary role diligently which is to output strings.
    d) echo() spits out to the page unlike console.log() which relays its information to the console.I have seen it being used to append data to PHP variables which 
       is  quite weird but okay. It seems that is just the ways things are around here.
    e) PHP seems to really depend upon associative arrays. You know , the arrays that name their elements. Its weird coz its like defining an object with "key" => value pairs but now is an array.
    f) exit timebomb is used to exit the execution of a certain file. Usually comes after a redirect
    g) break timebomb is used to break out of the while loop.
    h) header() is used to redirect to a certain page. You know head home.
    i) If we do not provide any baptisimal name to the data being posted / requested , THe is no way to reference the data hence the "Undefined array key error when we were dealing with the hidden array field.
    j) The created_at timing is perfect.
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div> <div class="container my-5">
        <h2>HOMEPAGE</h2>
        <a href="/todoApp/PHP/create.php" class="btn btn-primary">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- To render the database rows dynamically , we start the php code. -->
                <?php 
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
                // Haitaendelea if connection fails. But if everything is well let's see what happens
                // Reading all data from the clients table.
                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql); //Where we make the query via the connection object.

                if(!$result){
                    die("Invalid query:" . $connection->error);
                }
                // Otherwise we have the option to fetch the data as associative arrays.
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                    <a href='/todoApp/PHP/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='/todoApp/PHP/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
                
                };
                ?>
                
                <tr>
                    <td>12</td>
                    <td>Alfred Gichia</td>
                    <td>alfredgithinji87@gmail.com</td>
                    <td>+254112615416</td>
                    <td>Nyeri,Kenya</td>
                    <td>28/09/2022</td>
                    <td>
                    <a href="/todoApp/PHP/edit.php" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/todoApp/PHP/delete.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div></div>
    
</body>
</html>


