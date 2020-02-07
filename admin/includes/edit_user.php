<?php
if(isset($_GET['edit_user'])){
    $the_user_id=$_GET['edit_user'];    
}

$query = "SELECT * FROM users WHERE user_id=$the_user_id";
$select_user_by_id=mysqli_query($connection,$query);

while ($row=mysqli_fetch_assoc($select_user_by_id)) {
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_password_db=$row['user_password'];
    $user_image = $row['user_image'];
}


//// move updated data to the database
if(isset($_POST['update_user'])){

    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_role=$_POST['user_role'];
    $username=$_POST['username'];
    
    $user_image = $_FILES['image']['name'];                        //we have to use files instead of post. first parameter is name of image and second parameter is name.
    $user_image_temp = $_FILES['image']['tmp_name'];              //this is used to store image as a temporary storage.
    
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    
    move_uploaded_file($user_image_temp,"../images/$user_image");

    //if someone dont change image then it will remain same. so we have to write this if statement. 
    if(empty($user_image)){
        $query="SELECT * FROM users WHERE user_id=$the_user_id";
        $select_image=mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_image)){
            $user_image=$row['user_image'];
        }
    }


    //if someopne changed password from edit_user.php page then password should be store in database with encryption.
    // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection,$query);
    // if (!$select_randsalt_query) {
    //     die('QUERY FAILED'.mysqli_error($connection));
    // }
    // $row = mysqli_fetch_array($select_randsalt_query);
    // $salt = $row['randSalt'];
    // $hashed_password = crypt($user_password,$salt);



    if(empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection,$query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_assoc($get_user_query);
        $hashed_password = $row['user_password'];

    }
        else{
            
            $hashed_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));
        
        }




     

        
$query="UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_role='{$user_role}', username='{$username}', user_email='{$user_email}', user_image='{$user_image}', user_password='{$hashed_password}' WHERE user_id={$the_user_id}";

$update_user=mysqli_query($connection,$query);

confirmQuery($update_user);

echo "<p class='bg-success'>User Updated <a href='users.php'>View User.</a></p>";

}

?>








<form action="" method="post" enctype="multipart/form-data">       <!--if we want to uplodat pitcture in our form then we have to use attribute called enctype in form.-->

<div class="form-group">
    <label for="Firstname">Firstname</label>
    <input type="text" value="<?php echo $user_firstname?>" name="user_firstname" class="form-control">
</div>
<div class="form-group">
    <label for="Lastname">Lastname</label>
    <input type="text" value="<?php echo $user_lastname?>" name="user_lastname" class="form-control">
</div>


<div class="form-group">
    <label for="user_role">User Role:</label>
<select name="user_role" id="">
    
    <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
    <?php
        if ($user_role=='admin') {
            echo "<option value='subscriber'>Subscriber</option>";
        }else{
            echo "<option value='admin'>Admin</option>";
        }
    
    ?>




</select>
</div>


<div class="form-group">
    <label for="Username">Username</label>
    <input type="text" name="username" value="<?php echo $username?>" class="form-control">
</div>

<div class="form-group">
    <label for="user_email">User Email</label>
    <input type="email" name="user_email" value="<?php echo $user_email?>" class="form-control">
</div>

<div class="form-group">
    <label for="user_password">User Password</label>
    <input type="password" autocomplete='off' name="user_password" class="form-control">
</div>


<div class="form-group">
    <label for="user_image">User Image</label>
     <img src="../images/<?php echo $user_image?>" alt="">
</div>
<div class="form-group">
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <input type="submit" name="update_user" class="btn btn-primary" value="Update User">
</div>

</form>