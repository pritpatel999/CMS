<?php include "includes/admin_header.php";?>


<div id="wrapper">
    







        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>
        



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->



       
                <!-- /.row -->
                
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  

                    <div class='huge'><?php echo $post_count=recordCount('posts'); ?></div>              
                       
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Posts</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <!-- // //display comment in dashboard dynamically. -->
                    <div class='huge'><?php echo $comment_count = recordCount('comments'); ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Comments</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <!-- users count dynamically from function file. -->
                    <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Users</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <!-- find category count dynamically from admin.functions.php file  -->
                    <div class='huge'><?php echo $categories_count = recordCount('categories'); ?></div>

                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Categories</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->




    <?php


    // $query ="SELECT * FROM posts WHERE post_status='published'";
    // $published_post_query=mysqli_query($connection,$query);
    // $published_post_count = mysqli_num_rows($published_post_query);
    $published_post_count = statusCount('posts','post_status','published');
   
    
    // $query = "SELECT * FROM posts WHERE post_status = 'pending'";
    // $pending_posts_query = mysqli_query($connection,$query);
    // $pending_posts_count = mysqli_num_rows($pending_posts_query);            
    $pending_posts_count = statusCount('posts','post_status','pending');            
                

    // $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
    // $approved_comment_query = mysqli_query($connection,$query);
    // $approved_comment_count = mysqli_num_rows($approved_comment_query);
    $approved_comment_count = statusCount('comments','comment_status','approved');


    // $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    // $subscriber_query = mysqli_query($connection,$query);
    // $subscriber_count = mysqli_num_rows($subscriber_query);
    $subscriber_count = statusCount('users','user_role','subscriber');


?>



                <div class="row ">

                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php
// creating dynamic dashboard chart.
// in this we need internet.            
            $element_text = ['All Posts','Published Posts','Pending Posts','Comments','Approved Comments','users','Categories','Subscriber'];
            $element_count = [$post_count,$published_post_count , $pending_posts_count, $comment_count, $approved_comment_count, $users_count, $categories_count,$subscriber_count];


// count() function is used to find the size of array.
            for($i=0;$i<count($element_text);$i++){
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            ?>


        //   ['Posts', 1000],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>




                </div>






            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php";?>
