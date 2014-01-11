<div id="content">
	<div style="width: 100%; height: 200px;">
		
<div id="breadcrumb">Welcome &rsaquo;</div>

<?php	
foreach ($page_data as $page) {
	echo $page->html = (empty($page->html)) ? '' : $page->html;
}	
?>
	</div>
	<div class="clearfix"></div>
</div>