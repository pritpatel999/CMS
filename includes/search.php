<?php include "db.php";?>
<?php include "header.php";?>


    <!-- Navigation -->
<?php include "navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">



            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
        
            if(isset($_POST['submit'])){
            $search = $_POST['search'];

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";           //this query is used to find the search string from databse. we already create post_tags row in databse and write some tag related to our post. it compare search string with our database tag.
            $search_query = mysqli_query($connection,$query);

            if(!$search_query){
                die('QUERY FAILED'.mysqli_query($connection));
            }

            $count = mysqli_num_rows($search_query);           //this function is used to find the count of string.
            if($count == 0){
                echo "<h1>no result found</h1>";
            }
            else{
                
                while($row = mysqli_fetch_assoc($search_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];           //to display image we have to write name of image in database image section.
                    $post_content = $row['post_content'];
                    ?>
                
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src='../images/<?php echo $post_image ?>' alt="">         <!--images are inside the images folder so we write php tage after images folder. and to display image in website we have to write image name in image seciton of database.-->
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php 
            } 
            }
            }
            ?>


            </div>

        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "footer.php";?>