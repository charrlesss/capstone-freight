<?php



$url = explode($controller_filename,$controller_request);
$slice_apart = explode('/',$url[1]);
$join_parts = join(' ',$slice_apart);
$slice_function_params = explode(' ',trim($join_parts));
$function_name = array_shift($slice_function_params);
$params =implode(',', $slice_function_params);


?>