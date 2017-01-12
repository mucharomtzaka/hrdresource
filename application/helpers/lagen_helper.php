<?php defined('BASEPATH') OR exit('No direct script access allowed');

	function label($str)
	{
	    $label = str_replace('_', ' ', $str);
	    $label = ucwords($label);
	    return $label;
	}

	function safe($str)
	{
    return strip_tags(trim($str));
	}