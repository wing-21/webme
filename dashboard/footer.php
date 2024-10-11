    <!-- Main Footer -->
<footer class="main-footer" style="text-align:center;">
        <strong>&copy; 2024 Webmeid</strong>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function () {
        // Control sidebar toggle with click event
        $('[data-widget="pushmenu"]').on('click', function () {
            $('.sidebar').toggleClass('sidebar-collapse');
            // Optionally hide user panel info
            if ($('.sidebar').hasClass('sidebar-collapse')) {
                $('.user-panel .info').hide();
            } else {
                $('.user-panel .info').show();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Control sidebar toggle with click event
        $('[data-widget="pushmenu"]').on('click', function () {
            $('.sidebar').toggleClass('sidebar-collapse');
        });
    });
</script>
