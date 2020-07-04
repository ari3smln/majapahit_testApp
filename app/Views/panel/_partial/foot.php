<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url() ?>/vendors/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>