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

    .card { background-color: rgba(245, 245, 245, 0.8); }
    .card-hidden { background-color: rgba(245, 245, 245, 0); }
    .card-header, .card-footer { opacity: 1}

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
<h1>500</h1>
<h2 class="mb-0">Whoops!</h2>
<h2 class="mt-1 mb-5">Unexpected Error <b>:(</b></h2>
<input type="hidden" name="engine" value="">
<div class="gears mt-3">
    <div class="gear one">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="gear two">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="gear three">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>
<script>
    $(function() {
        let timer=0;
        setTimeout(function(){
            $('body').removeClass('loading');
        }, 2000);
        setInterval(() => {
            timer++;
            if(timer > 5)
                location.reload();                            
        }, 1000);
    });
</script>