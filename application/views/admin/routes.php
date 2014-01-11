<h2>Routes</h2>

<?php
foreach ($routes as $value) {
echo $value->Order."\n";
echo $value->Url."\n";
echo $value->Url_Variable."\n";
echo $value->Class."\n";
echo $value->Method."\n";
echo $value->Variable."\n";
echo '<br/>';
}

var_dump($routes);
?>