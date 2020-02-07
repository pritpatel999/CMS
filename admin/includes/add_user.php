<?php

// //add new post from admin side
// //this file is come from get request as we put file name in switch case statement. so write "?source=add_post" after post.php file. 
if(isset($_POST['create_user'])){
// $user_id=$_POST['user_id'];
$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
$user_role=$_POST['user_role'];
$username=$_POST['username'];

$user_image = $_FILES['user_image']['name'];                        //we have to use files instead of post. first parameter is name of image and second parameter is name.
$user_image_temp = $_FILES['user_image']['tmp_name'];              //this is used to store image as a temporary storage.

$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
$post_date = date('d-m-y');                                   //to display date we have to use date function.
// $post_comment_count = 0;

//in form if we click on chhose image file and select image with "JPG" extention then it dont work. we have to use image with "png" extention.
//because in inetrnet world we have to use image with "png" extention. because "jpg" image comes with lossy algorithm so it cant be able to fetch.
//so whenever we use image in any website, use image with "png" extention.
move_uploaded_file($user_image_temp,"../images/$user_image");


$user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));


//in this query if we use '(ephostophy s) in title or tag or any string then it show query because in php it cant accept this type of data.
$query="INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}')";
$create_user_query=mysqli_query($connection,$query);

confirmQuery($create_user_query);

echo "User Created: "."<a href='users.php'>View Users</a>";


}?>




<form action="" method="post" enctype="multipart/form-data">       <!--if we want to uplodat pitcture in our form then we have to use attribute called enctype in form.-->

<div class="form-group">
    <label for="Firstname">Firstname</label>
    <input type="text" name="user_firstname" class="form-control">
</div>
<div class="form-group">
    <label for="Lastname">Lastname</label>
    <input type="text" name="user_lastname" class="form-control">
</div>


<div class="form-group">
    <label for="user_role">User Role:</label>
<select name="user_role" id="">

    <option value="admin">Admin</option>
    <option value="subscriber" selected>Subscriber</option>

</select>
</div>


<div class="form-group">
    <label for="Username">Username</label>
    <input type="text" name="username" class="form-control">
</div>

<div class="form-group">
    <label for="user_email">User Email</label>
    <input type="email" name="user_email" class="form-control">
</div>

<div class="form-group">
    <label for="user_password">User Password</label>
    <input type="password" name="user_password" class="form-control">
</div>


<div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" name="user_image" class="form-control">
</div>

<div class="form-group">
    <input type="submit" name="create_user" class="btn btn-primary" value="Add User">
</div>

</form>