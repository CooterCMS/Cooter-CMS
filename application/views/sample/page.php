<div id="content">
<?php	
foreach ($post_data as $post) {
?>
<div style="width: 100%; min-height: 200px;">
<?php
echo '<div id="breadcrumb">'.$post->breadcrum.' &rsaquo;</div>';
	$post->html = (empty($post->html)) ? '' : $post->html;
	echo $post->html;
	echo '<br />';
	echo $post->author_name;
?>
	</div>
	<div class="clearfix"></div>
<?php } ?>	
</div>