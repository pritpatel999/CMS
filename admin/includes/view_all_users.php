<table class="table table-bordered table-hover summary ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <!-- <th>Date</th> -->
        </tr>
    </thead>

    <tbody>
        
        <?php
            $query = "SELECT * FROM users";
            $select_users=mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                
            


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            
            // $query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
            // $select_cat_id=mysqli_query($connection,$query);
            // while($row=mysqli_fetch_assoc($select_cat_id)){
            //     $cat_id=$row['cat_id'];
            //     $cat_title=$row['cat_title'];
            // }            
            // echo "<td>$cat_title</td>";
            
            
            
            
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img src='../images/$user_image' width=100px;></td>";
            echo "<td>{$user_role}</td>";
            // echo "<td></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
            }


            if(isset($_GET['delete'])){
                if(isset($_SESSION['username'])){
                $the_user_id=$_GET['delete'];
                $query="DELETE FROM users WHERE user_id={$the_user_id}";
                $delete_query=mysqli_query($connection,$query);
                header("Location:users.php");                //basically this function refresh the page.
            }}
?>


    </tbody>
</table>

