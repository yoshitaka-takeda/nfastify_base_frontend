<main role="main" class="container">
    <div class="jumbotron">
        <div class="form-group ml-3">
            <div class="col-md-12">
                <a href="<?=$this->router->getControllerName().'/addentry'?>" class="btn btn-success col-md-2"><i class="fa fa-plus"></i>&nbsp;Add Auction entry</a>
            </div>
        </div>
    </div>
    <div class="container" style="overflow-y: auto;">
        <div class="table-reponsive mx-0 d-block d-sm-block d-md-none">
            <table class="table">
                <thead>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                </thead>
                <tbody>
                    <tr><td>x</td></tr>
                    <tr><td>x</td></tr>
                </tbody>
            </table>
        </div>
        <div class="table-reponsive mx-0 d-none d-sm-none d-md-block">
            <table class="table">
                <thead>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                    <th>ooo</th>
                </thead>
                <tbody>
                    <tr><td>x</td></tr>
                    <tr><td>x</td></tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</main>

<script>
    <?php if($hasRouteError) : ?>
    Swal.fire({
        title: 'Error!',
        html: "<?=$message?><br/>Auto-close within <b></b> milliseconds.",
        icon: 'error',
        confirmButtonText: 'Ok',
        timer: 5000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
            timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });
    <?php endif ?>
</script>