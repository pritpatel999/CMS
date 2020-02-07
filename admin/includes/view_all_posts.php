<?php

include("delete_modal.php");

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId) {
        // echo "$postValueId";
        
        $bulk_options = $_POST['bulk_options'];
   
        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$postValueId";
                $publish_posts_query = mysqli_query($connection,$query);
                confirmQuery($publish_posts_query);
                break;

            case 'pending':
                $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$postValueId";
                $pending_posts_query = mysqli_query($connection,$query);
                confirmQuery($pending_posts_query);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id=$postValueId";
                $delete_post_query = mysqli_query($connection,$query);
                confirmQuery($delete_post_query);
                break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = $postValueId";
                $select_post_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_post_query)){
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
            
                }

                $query ="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}')";
                $clone_query = mysqli_query($connection,$query);
                if(!$clone_query){
                    die('QUERY FAILED'.mysqli_error($connection));
                }
                break;
            }
   
    }
}

?>




<form action="" method="post">
<table class="table table-bordered table-hover summary ">
   
   <div class="col-xs-4" id="bulkOptionContainer" style="padding:0px;">
   <select name="bulk_options" class="form-control">
   <option value="">Select Option</option>
   <option value="published">Publish</option>
   <option value="pending">Pending</option>
   <option value="delete">Delete</option>
   <option value="clone">Clone</option>
   </select>
   </div>

   <div class="col-xs-4">
   <input type="submit" value="Apply" name="submit" class="btn btn-success">
   <a href='posts.php?source=add_post' class="btn btn-primary">Add New</a>
   </div>
<br><br>
   
   
   
   
    <thead>
        <tr>
            <th><input type="checkbox" name="" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views Count</th>
        </tr>
    </thead>

    <tbody>
        
        <?php
                // echo "<br><br><br>";
                //// by this query new added post will display first.
            // $query = "SELECT * FROM posts ORDER BY post_id DESC";
            
            //join two tables
            $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date,posts.post_views_count, ";
            $query .= "categories.cat_id, categories.cat_title ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id";
            
            $select_post=mysqli_query($connection,$query);
            
            if(!$select_post){
                die('QUERY FAILED'.mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($select_post)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
            
                


            echo "<tr>";
            ?>
            <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
            <?php
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            


            // $query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
            // $select_cat_id=mysqli_query($connection,$query);
            // while($row=mysqli_fetch_assoc($select_cat_id)){
            //     $cat_id=$row['cat_id'];
            //     $cat_title=$row['cat_title'];
            // }            
            echo "<td>$cat_title</td>";
            
            

            
            
            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/$post_image' width=100px;></td>";
            echo "<td>{$post_tags}</td>";
            
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $comment_query = mysqli_query($connection,$query);
            
            $row = mysqli_fetch_assoc($comment_query);
            $comment_id = $row['comment_id'];

            $post_comment_count = mysqli_num_rows($comment_query);
            

            echo "<td class='text-center'><a href='post_comments.php?id=$post_id'>{$post_comment_count}</a></td>";
            
            
            
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";            
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' class='btn btn-primary btn-sm'>Edit</a></td>";
//            echo "<td><a onClick=\"javascript: return confirm('Are you sure want to delete this post?')\" href='posts.php?delete={$post_id}'>Delete</a></td>";
            
?>



            <!-- delete post by post method. if we use get method then it is not secure. -->
            <form method="post">
            
            <input type="hidden" name="post_id" value="<?php echo $post_id?>">
            
            <?php 

                echo "<td><input type='submit' class='btn btn-danger btn-sm' value='Delete' name='delete'></td>";
            
            ?>

            </form>


<?php
    //    echo "<td><a  href='javascript:void0)' rel='$post_id' class='delete_link'>Delete</a></td>";
            
            
            
            
            echo "<td>{$post_views_count}</td>";
            echo "</tr>";
            }



            if(isset($_POST['delete'])){
                if(isset($_SESSION['username'])){
                $the_post_id=$_POST['post_id'];
                $query="DELETE FROM posts WHERE post_id={$the_post_id}";
                $delete_query=mysqli_query($connection,$query);
                header("Location:posts.php");                //basically this function refresh the page.
            }}
?>




<script>

            $(document).ready(function(){
                $(".delete_link").on('click',function(){

                    var id = $(this).attr("rel");

                    var delete_url = "posts.php?delete="+id;
                    $(".modal_delete_link").attr("href",delete_url);
                    $("#myModal").modal('show');
                });
            });
</script>


    </tbody>
</table>
</form>
