<script src="{{ asset('backend') }}/vendor/libs/jquery/jquery.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('backend') }}/vendor/js/bootstrap.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('backend') }}/vendor/js/menu.js"></script>

<script src="{{ asset('backend/izitoast/js/iziToast.min.js') }}"></script>

<script src="{{ asset('backend') }}/js/main.js"></script>

<script>
    $(document).on('hide.bs.modal', '.modal', function() {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
</script>

@stack('js')
