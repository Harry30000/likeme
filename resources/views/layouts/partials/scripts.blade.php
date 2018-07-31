<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- jQuery UI - v1.11.4 -->
<script src="{{ asset('/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('/dist/js/pages/dashboard2.js') }}"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- PACE -->
<script src="{{ asset('/plugins/pace/pace.min.js') }}"></script>
<!-- Ion Slider -->
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
<!-- ToastrJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>

<script>
    $(function () {
        // Toastr
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "0",
            "extendedTimeOut": "2000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            'body-output-type': 'trustedHtml'
        }

        <!-- Ion Slider -->
        $("#limit").ionRangeSlider({
            min: 0,
            max: 150,
            from: 150,
            from_min: 1,
            from_max: 150,
            step: 10,
            from_shadow: false
        });

        <!-- Fast Click -->
        $(function () {
            FastClick.attach(document.body);
        });

        // Pace script
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function () {
            Pace.restart();
        });
    })
</script>