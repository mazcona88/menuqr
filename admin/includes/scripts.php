	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/icons.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<?php include "functions.php"; ?>
	<script>
	var expanded = false;

	function showCheckboxes() {
		var checkboxes = document.getElementById("checkboxes");
		if (!expanded) {
			checkboxes.style.display = "block";
			expanded = true;
		}else{
			checkboxes.style.display = "none";
			expanded = false;
		}
	}
	</script>