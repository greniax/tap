<script type="text/javascript">
;(function($) {
	$(function() {
		$('#addcomm').bind('click', function(e) {
			e.preventDefault();
			$('#popupcomment').bPopup();
		});
	});
})(jQuery);

<?php #include 'assets/js/jquery.bpopup.min.js'; ?>
</script>
<!-- bpopup jquery plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery.bpopup.min.js"></script>
<div class="page-header"><h1><?php echo $title; ?></h1></div>
<div><button id="addcomm" class="glyphicon glyphicon-plus btn btn-primary"> Nuevo Comentario</button></div>

