<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$akey = 'd88b2868cf66e6c0f46d738dedb00f6e';
	?>
	<script src="<?php echo base_url().'assets/tinymce/tinymce.min.js';?>"></script>
	<script>tinymce.init({ selector:'textarea', plugins: [
"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor"],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview fullpage | forecolor backcolor emoticons font',
	  });
	</script>
<?php
	if(isset($loncat))
	{
	?>
	<script src="<?php echo base_url();?>assets/js/jumpmenu.js"></script>
	<?php
	}
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="/assets/js/tambahan.js"></script>
  </body>
</html>
