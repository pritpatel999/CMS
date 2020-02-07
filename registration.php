<?php  include "includes/db.php"; ?>
<?php include "admin/admin_functions.php";?>
<?php  include "includes/header.php"; ?>


<?php
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];



    if(username_exist($username) && email_exist($email)){
        echo "<h3 class='text-center bg-success'>you already registered before. So log in from <a href='index.php' class='text-danger'>here</a></h3> ";
    }else{
    
    
    
    //validation
    if(!empty($username) && !empty($email) && !empty($password)){
        
       // mysqli_real_escape_string($connection,$other parameter) function is used to increapt the parameter.
           $username = mysqli_real_escape_string($connection,$username);
           $email = mysqli_real_escape_string($connection,$email);
           $password = mysqli_real_escape_string($connection,$password);
        


$password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 10));


//     $query = "SELECT randSalt FROM users";
//     $select_randsalt_query = mysqli_query($connection,$query);

//     if(!$select_randsalt_query){
//         die('QUERY FAILED'.mysqli_error($connection));
//     }



// $row = mysqli_fetch_array($select_randsalt_query);
// $salt = $row['randSalt'];

// //encryption of password.
// $password = crypt($password,$salt);

$query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES('{$username}','{$email}','{$password}','subscriber')";
$register_user_query = mysqli_query($connection,$query);

if(!$register_user_query){
    die('QUERY FAILED'.mysqli_error($connection));
}
echo "<p class='bg-success text-center'>Your Registration has benn done successfully</p>";

}else {
    echo "<script>alert('Please Fill All The Information Properly');</script>";
}


}


}
?>





    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class='text-center text-danger'><u>Register</u></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="on">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" autocomplete="on" value="<?php echo isset($username)?$username:'' ?>" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" autocomplete="on" value="<?php echo isset($email)?$email:''?>" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer.php";?>
