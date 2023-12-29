<main role="main" class="container">
    <div class="jumbotron">
        <h1>Navbar example</h1>
        <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser’s viewport.</p>
        
    </div>

    <div class="form">

        <?php
            echo "<pre>"; 

            echo base64_decode($_ENV['KEYPAIR1'],true)."\n";

            echo base64_encode('202311221041202311291956')."\n";

            $plaintext = 'My secret message 1234';
            $password = '3sc3RLrpd17';
            $method = 'aes-256-cbc';
            
            $key = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            echo "Key:" . $key . "\n";
            
            // IV must be exact 16 chars (128 bit)
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            
            // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
            $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));
            
            // My secret message 1234
            $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);
            
            echo 'plaintext=' . $plaintext . "\n";
            echo 'cipher=' . $method . "\n";
            echo 'encrypted to: ' . $encrypted . "\n";
            echo 'decrypted to: ' . $decrypted . "\n\n";
            echo "</pre>";
            echo "<br/>";
            echo "<pre>";
                print_r($vx);
                echo "</pre>";
                echo "<pre>";
                    print_r($vy);
                    echo "</pre>";
            echo "<pre>";
            print_r(base64_decode($vx));
            echo "</pre>";
        ?>
    </div>
</main>

<div class="modal fade usermanager" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-4">You</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body my-2">
                <div class="form-group mx-4">
                    <div class="row">
                        <div class="input group">

                        </div>
                    </div>
                    <div class="col-12">
                        ooo
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<div class="modal fade add_auction_entry" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-4">You</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body my-2">
                <div class="form-group mx-4">
                    <div class="row">
                        <div class="input group">

                        </div>
                    </div>
                    <div class="col-12">
                        ooo
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
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