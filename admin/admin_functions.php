<?php

//<!-- find the total number of online users. -->
function users_online(){
//ajax request
    if(isset($_GET['onlineusers'])){
        global $connection;   

        if(!$connection){

            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_second = 10;            //after this seconds whenever 
            $time_out = $time-$time_out_in_second;
            
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection,$query);
            $count = mysqli_num_rows($send_query);
            
            
            if($count == NULL){
                mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
            }else{
                mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session='$session'");
            }
            
            $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time>$time_out");
            echo $count_user = mysqli_num_rows($users_online_query);

        }
}
}
users_online();



// //function to check query
function confirmQuery($result){
    global $connection;
    if(!$result){
        die('QUERY FAILED'.mysqli_error($connection));
    }
}




// //php query for insert or create categories
                        // //to insert category into table dynamically from admin side we have to use create query.
function insert_categories(){
        global $connection; 
        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo "<h2>TITLE SHOULD NOT BE EMPTY</h2>";
            }else{
                $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
                $create_category_query = mysqli_query($connection,$query);
            
                if(!$create_category_query){
                    die('QUERY FAILED'.mysqli_error($connection));
                }
            }
        }
    }

function FindAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories_admin = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($select_categories_admin)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function Delete_Category(){
    //to delete something from database we first have to create get request as i created in upper line with question mark.
    //then we get that value in our isset method and then perform delete operation.
    global $connection;
    if(isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete}";
    $delete_query = mysqli_query($connection,$query);
    header("Location:categories.php");          //this function basically used to refresh our page. whenever we use this function at that time we have to use op_buffer() function at the top of header.php file.
    }
}


function recordCount($table){

    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection,$query);

    $result = mysqli_num_rows($select_all_posts);
    confirmQuery($result);
    return $result;

}

function statusCount($table,$status,$position){
    global $connection;
    $query = "SELECT * FROM $table WHERE $status = '$position'";
    $status_query = mysqli_query($connection,$query);
    $result = mysqli_num_rows($status_query);
    confirmQuery($result);
    return $result;
}


function username_exist($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);

    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }

}


function email_exist($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);

    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }

}


?>

