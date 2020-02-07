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
                            <small>Author</small>
                        </h1>

                        <!-- add category at admin side -->
                        <div class="col-xs-6">
                            
                        <?php insert_categories();?>

                        
        
        <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                                </div>
                            </form>
                            
                            <?php
                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "includes/edit_categories.php";
                        }
                        
                        ?>
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">CATEGORY</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    <!-- create table dynamically by using read operation. -->
                                    <!-- fetch data for edit operation.this is not edit(update) operation but this is read operation. -->
                                    <?php 
                                FindAllCategories();
                            ?>

                            <!-- delete category -->
                            <?php Delete_Category(); ?>

                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php";?>
