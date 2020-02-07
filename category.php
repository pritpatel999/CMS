<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php session_start();?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">



            <!-- Blog Entries Column -->    
            <div class="col-md-8">
<!-- if we want to add html code n while loop then first we have to finish our php tag then add html code and again start php tag for complition of while loop and again close it. -->
<!-- create different types of data in posts table which we created in database and it will display in website dynamically.  -->
                
                <?php

                if(isset($_GET['category'])){
                    $the_post_id=$_GET['category'];

                    
                if(isset($_SESSION['user_role']) && $_SESSION['user_role']='admin'){
                    $query = "SELECT * FROM posts WHERE post_category_id = $the_post_id";
                }else{
                    $query = "SELECT * FROM posts WHERE post_category_id = $the_post_id AND post_status = 'published'";
                }
                    
                $select_post_query = mysqli_query($connection,$query); 
                
                if(mysqli_num_rows($select_post_query)>0){
                
                while($row = mysqli_fetch_assoc($select_post_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];           //to display image we have to write name of image in database image section.
                    $post_content = substr($row['post_content'],0,200);  //this function is used to make our content small. in this only first 200 character will be display.
                
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
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>          <!--images are inside the images folder so we write php tage after images folder. and to display image in website we have to write image name in image seciton of database.-->
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                
                
                
                <?php } }else{echo "<h2 class='text-center'>No Post Available</h2>";}}?>


                
            </div>

           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>



        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php";?>