<div id="content">
	<div style="width: 100%; height: 200px;">
		
<div id="breadcrumb">Posts &rsaquo;</div>

<?php	
foreach ($post_data as $post) {
	$post->html = (empty($post->html)) ? '' : $post->html;
	echo $post->html;
	echo '<br />';
}	
?>
	</div>
	<div class="clearfix"></div>
</div>