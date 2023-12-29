<main role="main" class="container">
    <div class="form-group ml-3">
        <a href="<?=$this->request->getHttpReferer()?>" class="btn btn-outline-info"><i class="fa fa-angle-left"></i>&nbsp;Back</a>
    </div>
    
    <div class="container" style="overflow-y: auto;">
        <form class="" method="post" action="?add">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body px-3">
                    <h2 class="text-uppercase text-center mb-5">New User</h2>
                        <div class="form-label-group form-outline mb-3">
                            <input type="text" id="_username" name="username" class="col-12 form-control form-control-lg"  />
                            <label class="form-label" for="username">Prefered Username</label>
                        </div>

                        <div class="form-label-group form-outline mb-3">
                            <input type="text" id="_realname" name="realname" class="form-control form-control-lg"  />
                            <label class="form-label" for="realname">Name</label>
                        </div>
          
                        <div class="form-label-group form-outline mb-3">
                            <input type="email" id="_emailaddress" name="email" class="form-control form-control-lg"  />
                            <label class="form-label" for="email">Email</label>
                        </div>          
                        <div class="form-label-group form-outline mb-3">
                            <input type="password" id="_password" name="password" class="form-control form-control-lg"  />
                            <label class="form-label" for="form3Example4cg">Password</label>
                        </div>
          
                        <div class="form-label-group form-outline mb-3">
                            <input type="password" id="_vpassword" name="vpassword" class="form-control form-control-lg" />
                            <label class="form-label" for="_vpassword">Repeat password</label>
                        </div>                                           
                    <div class="px-1">
                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Proceed</button>
                    </div>
                </div>                            
            </div>
        </form>    
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