<?php
//$id = $this->uri->segment(3);
//
//$page = $this->db->get_where("pages",array("id"=>$id))->row();

?>

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Page</title>
<style type="text/css">

	<?php echo $page->css ?>
	
</style>


</head>

<body>

	<?php echo $page->html ?>
</body>
</html>