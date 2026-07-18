<link rel="stylesheet" href="{{ asset('backend') }}/vendor/fonts/iconify-icons.css" />
<link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/core.css" />
<link rel="stylesheet" href="{{ asset('backend') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="{{ asset('backend/izitoast/css/iziToast.min.css') }}">
<script src="{{ asset('backend') }}/vendor/js/helpers.js"></script>
<script src="{{ asset('backend') }}/js/config.js"></script>

<style>
    .authentication-wrapper {
        --bs-auth-basic-inner-max-width: 460px;
        display: flex;
        flex-basis: 100%;
        inline-size: 100%;
        min-block-size: 100vh;
    }

    .authentication-wrapper .authentication-bg {
        background-color: var(--bs-paper-bg);
    }

    .authentication-wrapper .authentication-inner {
        inline-size: 100%;
    }

    .authentication-wrapper.authentication-basic {
        overflow: hidden;
        align-items: center;
        justify-content: center;
    }

    .authentication-wrapper.authentication-basic .authentication-inner {
        position: relative;
        max-inline-size: var(--bs-auth-basic-inner-max-width);
    }

    .authentication-wrapper.authentication-basic .authentication-inner::before {
        position: absolute;
        background: color-mix(in sRGB, var(--bs-primary) 60%, var(--bs-paper-bg));
        block-size: 148px;
        content: " ";
        inline-size: 148px;
        inset-block-start: -55px;
        inset-inline-end: -50px;
        mask-repeat: no-repeat;
        mask-size: 100% 100%;
    }

    @media (max-width: 575.98px) {
        .authentication-wrapper.authentication-basic .authentication-inner::before {
            display: none;
        }
    }

    .authentication-wrapper.authentication-basic .authentication-inner::after {
        position: absolute;
        z-index: -1;
        background: color-mix(in sRGB, var(--bs-primary) 60%, var(--bs-paper-bg));
        block-size: 240px;
        content: " ";
        inline-size: 243px;
        inset-block-end: -88px;
        inset-inline-start: -50px;
        mask-repeat: no-repeat;
        mask-size: 100% 100%;
    }

    @media (max-width: 575.98px) {
        .authentication-wrapper.authentication-basic .authentication-inner::after {
            display: none;
        }
    }

    .authentication-wrapper.authentication-basic .authentication-inner .card {
        z-index: 1;
    }

    @media (min-width: 576px) {
        .authentication-wrapper.authentication-basic .authentication-inner .card {
            padding: 1.5rem;
        }
    }

    .authentication-wrapper.authentication-basic .authentication-inner .card .app-brand {
        margin-block-end: 1.5rem;
    }

    .authentication-wrapper .auth-input-wrapper .auth-input {
        font-size: 150%;
        max-inline-size: 50px;
        padding-inline: 0.4rem;
    }

    @media (max-width: 575.98px) {
        .authentication-wrapper .auth-input-wrapper .auth-input {
            font-size: 1.125rem;
        }
    }

    .auth-cover-brand {
        position: absolute;
        z-index: 1;
        inset-block-start: 2.1rem;
        inset-inline-start: 2.5rem;
    }

    @media (max-width: 575.98px) {
        .auth-cover-brand {
            inset-inline-start: 1.5rem;
        }
    }

    #twoStepsForm .fv-plugins-bootstrap5-row-invalid .form-control {
        border-width: 2px;
        border-color: #ff3e1d;
        box-shadow: none;
    }

    @media (max-width: 575.98px) {
        .numeral-mask-wrapper .numeral-mask {
            padding: 0;
        }

        .numeral-mask {
            margin-inline: 1px;
        }
    }
</style>

@stack('style')
