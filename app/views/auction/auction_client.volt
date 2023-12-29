<div class="container mt-3">
    <div class="row mb-5 justify-content-center">
        <span class="badge badge-success">Welcome! <?php echo $_SESSION['username']; ?></span>
    </div>

    <div class="row">
        <div class="col-6">
        <div class="input-group mb-3">
            <input type="text" id="item-search" class="form-control" placeholder="Search for an item" aria-label="Search for an item" aria-describedby="button-addon2">
        </div>
        </div>
        <div class="col-4">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="BuyerPortal.php">All</a>
                   
                        <a class="dropdown-item" href="BuyerPortal.php?CategoryId=<?php echo $row['CategoryID']; ?>"><?php echo $row['Name']; ?></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All items</a>
            <a class="nav-item nav-link" id="nav-bidded-tab" data-toggle="tab" href="#nav-bidded" role="tab" aria-controls="nav-bidded" aria-selected="false">Bidded</a>
            <a class="nav-item nav-link" id="nav-watched-tab" data-toggle="tab" href="#nav-watched" role="tab" aria-controls="nav-watched" aria-selected="false">Watched</a>
            <a class="nav-item nav-link" id="nav-recommended-tab" data-toggle="tab" href="#nav-recommended" role="tab" aria-controls="nav-recommended" aria-selected="false">Recommended</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

            <div class="container mt-3">

                <div class="row">

                    
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/Auction.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                            <p class="card-text"><?php echo $row['Description']; ?></p>
                            <a href="<?= $this->router->getControllerName().'/entry' ?>" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                

                </div>

            </div> 
        </div>

        <div class="tab-pane fade" id="nav-bidded" role="tabpanel" aria-labelledby="nav-bidded-tab">

            <div class="container mt-3">
                <div class="row">
              
                        
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="images/Auction.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                                <p class="card-text"><?php echo $row['Description']; ?></p>
                                <a href="BuyerItem.php?ItemId=<?php echo $row['ItemID']; ?>" class="btn btn-primary">See Details</a>
                            </div>
                        </div>


                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="nav-watched" role="tabpanel" aria-labelledby="nav-watched-tab">

            <div class="container mt-3">
            <div class="row">
             
                        
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="images/Auction.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                                <p class="card-text"><?php echo $row['Description']; ?></p>
                                <a href="BuyerItem.php?ItemId=<?php echo $row['ItemID']; ?>" class="btn btn-primary">See Details</a>
                            </div>
                        </div>


                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="nav-recommended" role="tabpanel" aria-labelledby="nav-recommended-tab">

            <div class="container mt-3">
            <div class="row">
                
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                                <p class="card-text"><?php echo $row['Description']; ?></p>
                                <a href="BuyerItem.php?ItemId=<?php echo $row['ItemID']; ?>" class="btn btn-primary">See Details</a>
                            </div>
                        </div>
                </div>
            </div>

        </div>

    </div>

</div>