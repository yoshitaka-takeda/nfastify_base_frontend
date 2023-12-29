<link href="<?=$this->url->get('css/navbar-top-fixed.css')?>" rel="stylesheet">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">
    <a class="navbar-brand" href="<?=$this->url->getBaseUri().'dashboard'?>">
        <?=$_ENV['APP_NAME']?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>                
                    <div class="dropdown-menu" aria-labelledby="dropdownMen"uLink">
                        <?php 
                            if($this->router->getControllerName()!='dashboard'){
                        ?>
                        <a class="dropdown-item" href="<?='/dashboard'?>">Dashboard</a>
                        <?php
                            }
                        ?>
                        <a class="dropdown-item" href="<?='/user/manager'?>">User Manager</a>
                        <a class="dropdown-item" href="<?='/auction'?>">Auction List</a>
                        <a class="dropdown-item" href="<?='/auth?op=logout'?>">Logout</a>
                    </div>
                </div>
            </li>            
        </ul>
    </div>
</nav>