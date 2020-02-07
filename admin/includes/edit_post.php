<?php
if(isset($_GET['p_id'])){
    $the_post_id=$_GET['p_id'];    
}

$query = "SELECT * FROM posts WHERE post_id=$the_post_id";
$select_post_by_id=mysqli_query($connection,$query);

while ($row=mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content=$row['post_content'];
    $post_tags = $row['post_tags'];
  }


//// move updated data to the database
if(isset($_POST['update_post'])){

    $post_title=$_POST['title'];
    $post_author=$_POST['author'];
    $post_category_id=$_POST['post_category'];
    $post_status=$_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];                        //we have to use files instead of post. first parameter is name of image and second parameter is name.
    $post_image_temp = $_FILES['image']['tmp_name'];              //this is used to store image as a temporary storage.
    
    $post_content=$_POST['post_content'];
    $post_tags=$_POST['post_tags'];
  
    move_uploaded_file($post_image_temp,"../images/$post_image");

    //if someone dont change image then it will remain same. so we have to write this if statement. 
    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id=$the_post_id";
        $select_image=mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_image)){
            $post_image=$row['post_image'];
        }
    }


$query="UPDATE posts SET post_title='{$post_title}', post_category_id='{$post_category_id}', post_date=now(), post_author='{$post_author}', post_status='{$post_status}', post_tags='{$post_tags}', post_content='{$post_content}', post_image='{$post_image}', post_views_count=null WHERE post_id={$the_post_id}";

$update_post=mysqli_query($connection,$query);

confirmQuery($update_post);

echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a>.OR <a href='posts.php'>Edit Other Posts</a></p>";


}
?>








<form action="" method="post" enctype="multipart/form-data">       <!--if we want to uplodat pitcture in our form then we have to use attribute called enctype in form.-->

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" value="<?php echo $post_title; ?>" class="form-control">
</div>

<div class="form-group">
<label for="category">Category</label>
<select name="post_category" id="">
<?php
 $query = "SELECT * FROM categories";
 $select_categories = mysqli_query($connection,$query);

 confirmQuery($select_categories);

 while($row = mysqli_fetch_assoc($select_categories)){
    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];

    if($cat_id == $post_category_id){
        echo "<option value='{$cat_id}' selected>{$cat_title}</option>";        
    }else{
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }

}

?>
</select>

</div>

<div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" value="<?php echo $post_author?>" name="author" class="form-control">
</div>


<div class="form-group">
<select name="post_status" id="">
<option value='<?php echo "$post_status" ?>'><?php echo $post_status?></option>;
<?php
if($post_status == 'pending'){
echo "<option value='published'>published</option>";
}else{
echo "<option value='pending'>pending</option>";    
}
?>



</select>
</div>



<!-- 
<div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" value="<?php echo $post_status?>" name="post_status" class="form-control">
</div> -->

<div class="form-group">
<label for="post_image">Post Image</label><br>
<img src='../images/<?php echo $post_image?>' width=100px;>
</div>
<div class="form-group">
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" value="<?php echo $post_tags?>" name="post_tags" class="form-control">
</div>

<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" cols="30" rows="10" class="form-control"><?php echo $post_content?></textarea>
</div>

<div class="form-group">
    <input type="submit" name="update_post" class="btn btn-primary" value="Update post">
</div>

</form>