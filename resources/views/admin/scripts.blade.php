<script src="/_admin/js/bootstrap.min.js"></script>
<script src="/_admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/_admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/_admin/js/plugins/iCheck/icheck.js"></script>
<script src="/_admin/js/plugins/select2/select2.full.min.js"></script>
<script src="/_admin/js/inspinia.js"></script>
<script src="/_admin/ckeditor/ckeditor.js"></script>
<script src="/_admin/js/plugins/pace/pace.min.js"></script>
<script src="/_admin/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/_admin/js/dual_listbox.js"></script>
<script src="/_admin/js/common.js"></script>
@if(in_array(Route::currentRouteName(),[ 'admin-menus-edit','admin-menus-create'])   )
{{--<script src="/_admin/js/plugins/dropzone/dropzone.js"></script>--}}
<script src="/_admin/js/images.js"></script>
<script src="/_admin/js/menu.js"></script>
@endif
@if(in_array(Route::currentRouteName(),[ 'admin-dishes-edit','admin-dishes-create'])   )
	{{--<script src="/_admin/js/plugins/dropzone/dropzone.js"></script>--}}
	<script src="/_admin/js/images.js"></script>
	<script src="/_admin/js/dishes.js"></script>
@endif