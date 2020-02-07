<?php

// //add new post from admin side
// //this file is come from get request as we put file name in switch case statement. so write "?source=add_post" after post.php file. 
if(isset($_POST['create_post'])){
$post_title=$_POST['title'];
$post_author=$_POST['author'];
$post_category_id=$_POST['post_category'];
$post_status=$_POST['post_status'];

$post_image = $_FILES['image']['name'];                        //we have to use files instead of post. first parameter is name of image and second parameter is name.
$post_image_temp = $_FILES['image']['tmp_name'];              //this is used to store image as a temporary storage.

$post_tags=$_POST['post_tags'];
$post_content=$_POST['post_content'];
$post_date = date('d-m-y');                                   //to display date we have to use date function.
// $post_comment_count = 0;

//in form if we click on chhose image file and select image with "JPG" extention then it dont work. we have to use image with "png" extention.
//because in inetrnet world we have to use image with "png" extention. because "jpg" image comes with lossy algorithm so it cant be able to fetch.
//so whenever we use image in any website, use image with "png" extention.
move_uploaded_file($post_image_temp,"../images/$post_image");


//in this query if we use '(ephostophy s) in title or tag or any string then it show query because in php it cant accept this type of data.
$query="INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
$create_post_query=mysqli_query($connection,$query);

confirmQuery($create_post_query);

}?>


<form action="" method="post" enctype="multipart/form-data">       <!--if we want to uplodat pitcture in our form then we have to use attribute called enctype in form.-->

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control">
</div>

<div class="form-group">
<label for="category_title">Category Title</label>
<select name="post_category" id="">
<?php
 $query = "SELECT * FROM categories";
 $select_categories = mysqli_query($connection,$query);

 confirmQuery($select_categories);

 while($row = mysqli_fetch_assoc($select_categories)){
    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];
    echo "<option value='{$cat_id}'>{$cat_title}</option>";
}
?>
</select>
</div>



<div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" name="author" class="form-control">
</div>


<div class="form-group">
<label for="post_status">Post Status</label>
    <select name="post_status" id="">
    
    <option value="published">Publish</option>
    <option value="pending">Pending</option>
    </select>

<!-- 
    <label for="post_status">Post Status</label>
    <input type="text" name="post_status" class="form-control"> -->
</div>

<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" name="post_tags" class="form-control">
</div>

<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" cols="30" id="body" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
    <input type="submit" name="create_post" class="btn btn-primary" value="publish post">
</div>

</form>