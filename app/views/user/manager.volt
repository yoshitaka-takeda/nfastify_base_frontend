<main role="main" class="container">
    <div class="jumbotron">
        <div class="form-group ml-3">
            <div class="col-md-12">
                <a href="<?='new'?>" class="btn btn-success"><i class="fa fa-plus col-md-2"></i>&nbsp;Add User</a>
                <a href="<?='acl/list'?>" class="btn btn-secondary col-md-2"><i class="fa fa-list"></i>&nbsp;ACL</a>       
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