<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>
                                    <?php
                        ////php query for edit the category

                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                        $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                        $edit_query = mysqli_query($connection,$query);
                        
                        while($row = mysqli_fetch_assoc($edit_query)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

?>

<input type="text" name="cat_title" class="form-control" value="<?php if(isset($cat_title)){echo $cat_title;}?>">
                
                <?php        
                    }
                    }
                    ?>
                
                    <?php
                    if(isset($_POST['edit_category'])){
                        $the_cat_title = $_POST['cat_title'];
                    $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
                    $update_query = mysqli_query($connection,$query);
                    if(!$update_query){
                        die('QUERY FAILED'.mysqli_error($connection));
                    }
                    }
                    
                    ?>

                                </div>
                                <div class="form-group">
                                    <input type="submit" name="edit_category" class="btn btn-primary" value="Edit Category">
                                </div>
                            </form>
                       
