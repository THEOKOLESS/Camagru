

    <?php 
    if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        require('view/Profile/profile_view.php');
    }
    ?>


    
 


