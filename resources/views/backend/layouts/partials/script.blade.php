<script src="{{ asset('backend') }}/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('backend') }}/vendor/js/bootstrap.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/node-waves/node-waves.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/@algolia/autocomplete-js.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/pickr/pickr.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/hammer/hammer.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/i18n/i18n.js"></script>
<script src="{{ asset('backend') }}/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('backend') }}/vendor/libs/swiper/swiper.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/tagify/tagify.js"></script>
<script src="{{ asset('backend') }}/js/forms-tagify.js"></script>
<script src="{{ asset('backend') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<!-- Main JS -->
<script src="{{ asset('backend') }}/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('backend') }}/js/dashboards-analytics.js"></script>

{{-- izitoast --}}
<script src="{{ asset('js/iziToast.js') }}"></script>
@include('vendor.lara-izitoast.toast')
{{-- custom css --}}
<script src="{{ asset('backend') }}/js/custom.js"></script>

{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- select2 --}}
<script src="{{ asset('backend') }}/vendor/libs/select2/select2.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- tagsinput --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                ? "100%"
                : "style",
            placeholder: $(this).data("placeholder"),
        });
    });
</script>

@stack('scripts')