<?php
    $login;
    
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        $login = false;
    }
    else{
        $login = true;
    }

?>

<!-- Navbar starts -->


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Coder Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_blog.php">Create Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tableView.php">Table View</a>
                </li>
            </ul>
            <div>
                <?php
                    if($login){
                        echo '<a href="login.php" class="btn btn-outline-primary">Login</a>
                        <a href="register.php" class="btn btn-primary">Register</a>';
                    }
                    else{
                      echo '<a class="btn btn-primary rounded-circle mx-3 fw-bold">'.strtoupper(substr($_SESSION['username'],0,1)).'</a>
                        <a href="index.php?logout=true" class="btn btn-danger">Logout</a>';
                    }
                    ?>
            </div>
        </div>
    </div>
</nav>

<!-- Navbar ends -->