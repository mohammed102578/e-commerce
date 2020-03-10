
<nav class="navbar navbar-expand-lg navbar-light bg-color justify-content-between ">
  <a  style="color: red;" class=" navbar-brand " href="dashbord.php"><i class="fa fa-home fa-lg " aria-hidden="true"></i><?php echo lang('brand'); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav nav-ml mr-auto" >
      <li class="nav-item ">
        <a class="nav-link nav-activ bold" href="categoreis.php"><?php echo lang('fetures'); ?><span class="sr-only">(current)</span></a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="Item.php"><?php echo lang('ITEMS'); ?><span class="sr-only">(current)</span></a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="members.php"><?php echo lang('MEMPERS'); ?><span class="sr-only">(current)</span></a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="comment.php"><?php echo lang('COMMENT'); ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link nav-activ bold" href="#"><?php echo lang('STATISTICS'); ?><span class="sr-only">(current)</span></a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="#"><?php echo lang('LOGS'); ?><span class="sr-only">(current)</span></a>
      </li>

  </ul>
      <div class="dropdown">
  <a class=" dropdown-toggle mr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    option
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="../index.php"><i class="fa fa-eye" aria-hidden="true"></i>Visible shop</a>
    <a class="dropdown-item" href="members.php?do=Edit&userID=<?php echo  $_SESSION['ID'] ;?>"><i class="fa fa-pencil" aria-hidden="true"></i>Edit profile</a>
    <a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i>setting</a>
    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>log out</a>
  </div>
</div>
    
  </div>
</nav>






<?php include $template."footer.inc"; ?>