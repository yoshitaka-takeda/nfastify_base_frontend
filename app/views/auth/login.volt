<?php $regs='register'?>
<style>
    input::-ms-reveal {
        display: none;
    }

    span#toggle_pwd {
        position: absolute;
        right: 0.58vw;
        top: 51%;
        transform: translateY(-57%);
        z-index: 100;
    }
    
    .fa {
        opacity: 0.15;
    }

    .fa:hover{
        opacity: 0.65;
    }

    #toggle_pwd {
        cursor: pointer;
    }
</style>
<div id="state">
    <input type="hidden" name="engine" value="<?=$api_status?>">
</div>
<form class="form-signin" method="post" action="">
    <div class="card my-4">
        <div class="card-header">
            <div class="text-center">
                <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>' value='<?php echo $this->security->getToken() ?>'/>
                <h3 class="mt-2 mb-2 text-uppercase"><?=$_ENV['APP_NAME']?></h3>
                <img class="mb-4" src="<?php echo $this->url->get('img/favicon.png')?>" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" name="inputEmail" placeholder="Email address" autofocus>
                <label for="inputEmail">Email address</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="inputPassword" placeholder="Password">
                <label for="inputPassword">Password</label>
                <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
            </div>
            <div class="checkbox mb-3" style="text-align: left;">
                <label>
                    <input type="checkbox" name="rememberMe" value="remember-me"> Remember me
                </label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                        <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>
                    </div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-12">
                    <p class="text-center text-muted mb-0">Don't have an account? <a href="<?='/'.$regs?>"
                        class="fw-bold text-body"><u>Register here</u></a></p>
                </div>
            </div>
            <div class="text-center">
                <p class="mt-5 mb-3 text-muted">&copy; <?=($this->config->app_date < date('Y'))?$this->config->app_date.' -':''?><?=date('Y')?></p>
            </div>
        </div>
    </div>
</form>
<script>
    if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
        //alert('Opera');
    } else if (navigator.userAgent.indexOf("Edg") != -1) {
        //alert('Edge');
    } else if (navigator.userAgent.indexOf("Chrome") != -1) {
        //alert('Chrome');
    } else if (navigator.userAgent.indexOf("Safari") != -1) {
        //alert('Safari');
    } else if (navigator.userAgent.indexOf("Firefox") != -1) {
        //alert('Firefox');
    } else if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) //IF IE > 10
    {
        //alert('IE');
    } else {
        //alert('unknown');
    }

    $(function () {
        $("#toggle_pwd").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash revealed");
            var type = $(this).hasClass("fa-eye-slash revealed") ? "text" : "password";
            $("#inputPassword").attr("type", type);
            if($("#inputPassword").hasClass("revealed")){
                $("#inputPassword").removeClass("revealed");
            }else{
                $("#inputPassword").addClass("revealed");
            }
        });
    });

    if($('input[name="engine"]').val()){
        // alert($('input[name="engine"]').val());
        let timer=0;
        setInterval(() => {
            timer++;
            // console.log(timer);
            if($('input[name="engine"]').val()==0){
                console.log("reloading");
                if(timer > 5)                                
                    location.reload();
            }else if($('input[name="engine"]').val()==1){
                //console.log("refresh");
                if(timer > 5){
                    $.ajax({
                        type: 'GET',
                        url: '/?op=checkapi', 
                        success: function(res) {
                            //console.log(res);
                            let assign= res ?1:0;
                            $('input[name="engine"]').val(assign);
                        }
                    });
                }
            }         
        }, 1000);
    }

    <?php if($hasError) : ?>
    Swal.fire({
        title: 'Error!',
        html: "<?=$message?><br/>Auto-close within <b></b> milliseconds.",
        icon: 'error',
        confirmButtonText: 'Ok',
        timer: 2000,
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
