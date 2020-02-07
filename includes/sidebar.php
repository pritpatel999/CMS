<div class="col-md-4">
<!-- Blog Search Well -->

<div class="well">
    <h4>Blog Search</h4>
  
    <form action="includes/search.php" method="post">           <!--whenever we click on search button at that time it navigate to the search.php file.-->
    <div class="input-group">
        <input type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
  
    <!-- /.input-group -->
</div>
    
<div class="well">
<?php

if(isset($_SESSION['username'])){
    echo "<h4>you are loged in as <small>{$_SESSION['username']}</small></h4>";
    echo "<br><br>" . "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";

}else{
?>

<h4>Login</h4>  
    <form action="includes/login.php" method="post">           <!--whenever we click on search button at that time it navigate to the search.php file.-->
    <div class="form-group">
        <input type="text" placeholder="Enter Username" class="form-control" name="username">
    </div>
    <div class="input-group">
        <input type="password" name="password" placeholder="Enter Password" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-primary form-control" type="submit" name="login">Login</button>
        </span>
        </div>
    </form>


<?php
}


?>

  
    <!-- /.input-group -->
</div>
    



<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
     <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled">
          <!-- create category dynamically from database -->
            <?php
                $query = "SELECT * FROM categories";          // LIMIT 4 /only 4 catagories will be display.
                $select_categories_sidebar = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                    $cat_title = $row['cat_title'];          //in this write a row name which we created in database.
                    $cat_id=$row['cat_id'];
                    echo "<li title='{$cat_title}'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                }
            ?>
                            
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>


<!-- Side Widget Well -->
<?php include "widget.php";?>

</div>