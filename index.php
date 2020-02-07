<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php session_start();?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>

<?php //echo password_hash('secret',PASSWORD_DEFAULT,array('cost'=>7));?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">



            <!-- Blog Entries Column -->
            <div class="col-md-8">
<!-- if we want to add html code n while loop then first we have to finish our php tag then add html code and again start php tag for complition of while loop and again close it. -->
<!-- create different types of data in posts table which we created in database and it will display in website dynamically.  -->
                
                <?php


if(isset($_SESSION['user_role']) && $_SESSION['user_role']='admin'){
//pagination
$per_page=3;
$post_query_count = "SELECT * FROM posts";
$find_count = mysqli_query($connection,$post_query_count);
$count = mysqli_num_rows($find_count);                
$pagination_no = ceil($count/$per_page);


if(isset($_GET['page'])){
   $page=$_GET['page'];
}else{
    $page="";
}
if($page=="" || $page==1){
    $page_1 = 0;
}else{
$page_1 = ($page*$per_page)-$per_page;
}
//end of pagination

    $query = "SELECT * FROM posts LIMIT $page_1,$per_page";
}else{
//pagination
$per_page=3;
$post_query_count = "SELECT * FROM posts WHERE post_status='published'";
$find_count = mysqli_query($connection,$post_query_count);
$count = mysqli_num_rows($find_count);                
$pagination_no = ceil($count/$per_page);


if(isset($_GET['page'])){
   $page=$_GET['page'];
}else{
    $page="";
}
if($page=="" || $page==1){
    $page_1 = 0;
}else{
$page_1 = ($page*$per_page)-$per_page;
}
//end of pagination



    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,$per_page";
}


                $select_all_posts_query = mysqli_query($connection,$query); 
                
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];           //to display image we have to write name of image in database image section.
                    $post_content = substr($row['post_content'],0,200);  //this function is used to make our content small. in this only first 200 character will be display.
                    $post_status = $row['post_status'];
?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>          <!--images are inside the images folder so we write php tage after images folder. and to display image in website we have to write image name in image seciton of database.-->
                <hr>
                <p><?php echo $post_content?></p>
                
                <a href="post.php?p_id=<?php echo $post_id?>" class="btn btn-primary">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                
                <?php } ?>


                
            </div>

           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>



        </div>
        <!-- /.row -->

        <hr>

        <!-- pagination -->
        <ul class="pager">
<?php
            for($i=1;$i<=$pagination_no;$i++){
                if($i==$page){
                    echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
            }else{
                echo "<li><a href='index.php?page=$i'>$i</a></li>";
            }
        }
?>
        </ul>

<?php include "includes/footer.php";?>