<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="alert alert-success" role="alert">
            This item's auction has ended! 
            <?php
                echo $msg;
            ?>
        </div>
    </div>

    <div class="row">

        <div class="col-2">
            <img src="" alt="item image" class="img-thumbnail">
        </div>

        <div class="col-4">
            <h1><?php echo $item['Name']; ?></h1>
        </div>

        <div class="col-4">
            <h5>Item Description: </h5>
            <p><?php echo $item['Description']; ?></p>
        </div>

        <div class="col-2">
            <a href="<?= $this->request->getHttpReferer() ?>"><button class="btn btn-outline-success">Back</button></a>
        </div>

    </div>

    <div class="row mt-5">
        <h5><span class="badge badge-info">Starting Price: </span>   £<?php echo $item['StartingPrice']; ?></h5>
    </div>
    <div class="row">
        <h5><span class="badge badge-info">Starting Date: </span>     <?php echo $item['DateCreated']; ?></h5>
    </div>
    <div class="row">
        <h5><span class="badge badge-info">Ending Date: </span>       <?php echo $item['DateExpires']; ?></h5>
    </div>

    <div class="row  mt-5">
        <h1>Bidding History</h1>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">User</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="row mt-5">
        <div class="col-4">
            <form method="post" action="BuyerItem.php?ItemId=<?php echo $item['ItemID']; ?>">
                <div class="form-group">
                <label for="InputBidPrice">Bid the item: </label>
                <input type="number" min=<?php echo $maxBidPrice; ?> class="form-control" id="InputBidPrice" placeholder="Bid Price" name="bidprice" required>
                </div>
                <button type="submit" class="btn btn-outline-primary" name='bidbutton'>Submit</button>
            </form>
        </div>
        <div class="col-4">

        </div>
        <div class="col-4 mt-3">
            <form method="post" action="BuyerItem.php?ItemId=<?php echo $item['ItemID']; ?>">
                <button type="submit" class="btn btn-outline-success" name="watchbutton">Watch Item</button>
            </form>
            
        </div>
    </div>
</div>