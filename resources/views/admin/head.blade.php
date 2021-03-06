<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Административная часть</title>
	<link href="/_admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/_admin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="/_admin/css/animate.css" rel="stylesheet">
	<link href="/_admin/css/style.css" rel="stylesheet">
	<link href="/_admin/js/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="/_admin/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
	<link href="/_admin/css/dual_listbox.css" rel="stylesheet">
	@if(in_array(Route::currentRouteName(),[ 'admin-dishes-edit','admin-dishes-create'])   )
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
	@endif
	<link href="/_admin/css/common.css" rel="stylesheet">
	<script src="/_admin/js/jquery-2.1.1.js"></script>
	<script src="/_admin/js/jquery.json.min.js"></script>
	<script>
		$(document).ready(function(){
			$( '.i-checks' ).iCheck( {
				checkboxClass: 'icheckbox_square-green',
				radioClass   : 'iradio_square-green'
			} );
		});
	</script>
</head>