<nav style="background-color: rgb(0,113,122);" class="navbar navbar-expand-lg navbar-dark d-flex">
<img src="images/logototal.png" style="width: 20%" class="card-img-top mx-auto" alt="...">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto p-1">
            <?php if(isset($_SESSION['uId'])){ ?>
            <a class="nav-item nav-link active" href="dashboard.php"><i class="fa fa-tachometer">&nbsp;</i>Dashboard</a>
            <?php }?>
            
            <?php if(isset($_SESSION['uId'])){ ?>
            <a class="nav-item nav-link active" href="logout.php"><i class="fa fa-user">&nbsp;</i>Logout</a>
            <?php }else { ?>
            <a class="nav-item nav-link active" href="index.php"><i class="fa fa-user">&nbsp;</i>Login</a>
            <?php }?>
        </div>
    </div>
</nav>