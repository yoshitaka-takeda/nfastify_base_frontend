<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }
    .card-registration .select-arrow {
        top: 13px;
    }

    .gradient-custom-2 {
        /* fallback for old browsers */
        background: #a1c4fd;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
    }

    .bg-indigo {
        background-color: #4835d4;
    }
    @media (min-width: 992px) {
        .card-registration-2 .bg-indigo {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    }
    @media (min-width: px) and (max-width: 991px) {
        .card-registration-2 .bg-indigo {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    }

    .form-label-group {
        position: relative;
        /* margin-bottom: 1rem; */
    }

    .form-label-group input,.form-label-group label {
        height: 3.125rem;
        padding: .75rem;
    }

    .form-label-group label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0; /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        pointer-events: none;
        cursor: text; /* Match the input under the label */
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:-moz-placeholder-shown) {
        padding-top: 1.25rem;
        padding-bottom: .25rem;
    }

    .form-label-group input:not(:-ms-input-placeholder) {
        padding-top: 1.25rem;
        padding-bottom: .25rem;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: 1.25rem;
        padding-bottom: .25rem;
    }

    .form-label-group input:not(:-moz-placeholder-shown) ~ label {
        padding-top: .25rem;
        padding-bottom: .25rem;
        font-size: 12px;
        color: #777;
    }

    .form-label-group input:not(:-ms-input-placeholder) ~ label {
        padding-top: .25rem;
        padding-bottom: .25rem;
        font-size: 12px;
        color: #777;
    }

    .form-label-group input:not(:placeholder-shown) ~ label {
        padding-top: .25rem;
        padding-bottom: .25rem;
        font-size: 12px;
        color: #777;
    }

    .form-label-group input:-webkit-autofill ~ label {
        padding-top: .25rem;
        padding-bottom: .25rem;
        font-size: 12px;
        color: #777;
    }

    /* Fallback for Edge
    -------------------------------------------------- */
    @supports (-ms-ime-align: auto) {
        .form-label-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column-reverse;
            flex-direction: column-reverse;
        }

        .form-label-group label {
            position: static;
        }

        .form-label-group input::-ms-input-placeholder {
            color: #777;
        }
    }
</style>
<main role="main">
    <div class="mask d-flex align-items-center h-100 my-2">
        <div class="container h-100 my-3">
            <div class="row d-flex justify-content-center align-items-center h-100 my-4">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <form class="" method="post" action="">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body px-3">
                                <p class="text-center mb-4">
                                    Thanks!
                                </p>
                                <p class="align-left mb-0">
                                    We've received your necessary detail(s).
                                </p>
                                <p class="align-left mb-0">
                                    It shall take time as it is being Reviewed by our Registrant Reviewer. 
                                </p>
                                <p class="align-left mb-5">
                                    Once done we'll have the result e-mailed to <?=(isset($registrant_mail_address))?$registrant_mail_address:'your e-mail address' ?>.
                                </p>
                                <p class="text-center text-muted mt-4 mb-0">Return to <a href="<?='/'?>"
                                        class="fw-bold text-body"><u>Main Page</u></a></p>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>