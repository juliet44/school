<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('greenville_storage_get')) {
	function greenville_storage_get($var_name, $default='') {
		global $GREENVILLE_STORAGE;
		return isset($GREENVILLE_STORAGE[$var_name]) ? $GREENVILLE_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('greenville_storage_set')) {
	function greenville_storage_set($var_name, $value) {
		global $GREENVILLE_STORAGE;
		$GREENVILLE_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('greenville_storage_empty')) {
	function greenville_storage_empty($var_name, $key='', $key2='') {
		global $GREENVILLE_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($GREENVILLE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($GREENVILLE_STORAGE[$var_name][$key]);
		else
			return empty($GREENVILLE_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('greenville_storage_isset')) {
	function greenville_storage_isset($var_name, $key='', $key2='') {
		global $GREENVILLE_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($GREENVILLE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($GREENVILLE_STORAGE[$var_name][$key]);
		else
			return isset($GREENVILLE_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('greenville_storage_inc')) {
	function greenville_storage_inc($var_name, $value=1) {
		global $GREENVILLE_STORAGE;
		if (empty($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = 0;
		$GREENVILLE_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('greenville_storage_concat')) {
	function greenville_storage_concat($var_name, $value) {
		global $GREENVILLE_STORAGE;
		if (empty($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = '';
		$GREENVILLE_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('greenville_storage_get_array')) {
	function greenville_storage_get_array($var_name, $key, $key2='', $default='') {
		global $GREENVILLE_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($GREENVILLE_STORAGE[$var_name][$key]) ? $GREENVILLE_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($GREENVILLE_STORAGE[$var_name][$key][$key2]) ? $GREENVILLE_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('greenville_storage_set_array')) {
	function greenville_storage_set_array($var_name, $key, $value) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if ($key==='')
			$GREENVILLE_STORAGE[$var_name][] = $value;
		else
			$GREENVILLE_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('greenville_storage_set_array2')) {
	function greenville_storage_set_array2($var_name, $key, $key2, $value) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if (!isset($GREENVILLE_STORAGE[$var_name][$key])) $GREENVILLE_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$GREENVILLE_STORAGE[$var_name][$key][] = $value;
		else
			$GREENVILLE_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('greenville_storage_merge_array')) {
	function greenville_storage_merge_array($var_name, $key, $value) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if ($key==='')
			$GREENVILLE_STORAGE[$var_name] = array_merge($GREENVILLE_STORAGE[$var_name], $value);
		else
			$GREENVILLE_STORAGE[$var_name][$key] = array_merge($GREENVILLE_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('greenville_storage_set_array_after')) {
	function greenville_storage_set_array_after($var_name, $after, $key, $value='') {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if (is_array($key))
			greenville_array_insert_after($GREENVILLE_STORAGE[$var_name], $after, $key);
		else
			greenville_array_insert_after($GREENVILLE_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('greenville_storage_set_array_before')) {
	function greenville_storage_set_array_before($var_name, $before, $key, $value='') {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if (is_array($key))
			greenville_array_insert_before($GREENVILLE_STORAGE[$var_name], $before, $key);
		else
			greenville_array_insert_before($GREENVILLE_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('greenville_storage_push_array')) {
	function greenville_storage_push_array($var_name, $key, $value) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($GREENVILLE_STORAGE[$var_name], $value);
		else {
			if (!isset($GREENVILLE_STORAGE[$var_name][$key])) $GREENVILLE_STORAGE[$var_name][$key] = array();
			array_push($GREENVILLE_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('greenville_storage_pop_array')) {
	function greenville_storage_pop_array($var_name, $key='', $defa='') {
		global $GREENVILLE_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($GREENVILLE_STORAGE[$var_name]) && is_array($GREENVILLE_STORAGE[$var_name]) && count($GREENVILLE_STORAGE[$var_name]) > 0) 
				$rez = array_pop($GREENVILLE_STORAGE[$var_name]);
		} else {
			if (isset($GREENVILLE_STORAGE[$var_name][$key]) && is_array($GREENVILLE_STORAGE[$var_name][$key]) && count($GREENVILLE_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($GREENVILLE_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('greenville_storage_inc_array')) {
	function greenville_storage_inc_array($var_name, $key, $value=1) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if (empty($GREENVILLE_STORAGE[$var_name][$key])) $GREENVILLE_STORAGE[$var_name][$key] = 0;
		$GREENVILLE_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('greenville_storage_concat_array')) {
	function greenville_storage_concat_array($var_name, $key, $value) {
		global $GREENVILLE_STORAGE;
		if (!isset($GREENVILLE_STORAGE[$var_name])) $GREENVILLE_STORAGE[$var_name] = array();
		if (empty($GREENVILLE_STORAGE[$var_name][$key])) $GREENVILLE_STORAGE[$var_name][$key] = '';
		$GREENVILLE_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('greenville_storage_call_obj_method')) {
	function greenville_storage_call_obj_method($var_name, $method, $param=null) {
		global $GREENVILLE_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($GREENVILLE_STORAGE[$var_name]) ? $GREENVILLE_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($GREENVILLE_STORAGE[$var_name]) ? $GREENVILLE_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('greenville_storage_get_obj_property')) {
	function greenville_storage_get_obj_property($var_name, $prop, $default='') {
		global $GREENVILLE_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($GREENVILLE_STORAGE[$var_name]->$prop) ? $GREENVILLE_STORAGE[$var_name]->$prop : $default;
	}
}
?>