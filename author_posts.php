<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php session_start(); ?>


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
                if(isset($_GET['author'])){
                    $the_post_author=$_GET['author'];
                    $the_post_id = $_GET['p_id'];
                }

            $query = "SELECT * FROM posts WHERE post_author='{$the_post_author}'";
                $select_posts_query = mysqli_query($connection,$query); 
                if(!$select_posts_query){
                    die('QUERY FAILED'.mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($select_posts_query)){
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
                   All Posts By <?php echo $post_author?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">         <!--images are inside the images folder so we write php tage after images folder. and to display image in website we have to write image name in image seciton of database.-->
                <hr>
                <p><?php echo $post_content?></p>

                <hr>
                

                
                                
                <?php } ?>

                <!-- Blog Comments -->


                    <?php
                    
                    // if(isset($_POST['create_comment'])){

                    //     $the_post_id = $_GET['p_id'];
                    //     $comment_author = $_POST['comment_author'];
                    //     $comment_email = $_POST['comment_email'];
//                  //     $comment_content = $_POST['comment_content'];

                        // if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                        //     $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}','approve',now())";
                        //     $create_comment_query = mysqli_query($connection,$query);
    
                        //     if(!$create_comment_query){
                        //         die('QUERY FAILED'.mysqli_error($connection));
                        //     }
    
    
//                          //find total nujmber of count in perticular psot.
//                             $query = "UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id = $the_post_id";
//                             $update_commnet_count_query = mysqli_query($connection,$query);
                        

//                         }else{
//                             echo "<script>alert('Your comment is not submmited because you missed to fill information.')</script>";
//                         }
// }
                    
                    
                    ?>


                <!-- Comments Form -->
                <!-- <div class="well">
                    <h4><u>Leave a Comment:</u></h4>
                    <form role="form" action="" method="post">
    
                        <div class="form-group">
                            <label for="Author">Your Name:</label>
                            <input type="text" class="form-control" name="comment_author" placeholder="NAME" id="">
                        </div>
    
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="text" name="comment_email" placeholder="abc@gmail.com" class="form-control" id="">
                        </div>
    
                        <div class="form-group">
                            <label for="Comment">Your Comment:</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
 -->


                <!-- Posted Comments -->
                    <?php
                        // $query ="SELECT * from comments WHERE comment_post_id = $the_post_id ";
                        // $query .= "AND comment_status = 'approved'";
                        // $query .= "ORDER BY comment_id DESC";

                        // $select_comment_query = mysqli_query($connection,$query);
                        // if(!$select_comment_query){
                        //     die('QUERY FAILED'.mysqli_error($connection));
                        // }
                        // while($row = mysqli_fetch_assoc($select_comment_query)){
                        //     $comment_date = $row['comment_date'];
                        //     $comment_content = $row['comment_content'];
                        //     $comment_author = $row['comment_author'];
                   ?>
                   
                   

                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author?>
                            <small><?php echo $comment_date?></small>
                        </h4>
                            <?php echo $comment_content?>
                    </div>
                </div> -->
                   
                     <?php   //} ?>


                
            </div>

           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>



        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php";?>