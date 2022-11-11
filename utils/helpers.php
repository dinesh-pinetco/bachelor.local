<?php

function kbFromBytes($bytes)
{
    return round($bytes / 1024);
}

function isNotEmptyValue($optionArray)
{
    return count(array_filter($optionArray, function ($array) {
        return count(array_filter($array)) >= 2;
    })) == count($optionArray);
}

function urlContains($string, $url = null)
{
    return str_contains($url ?? request()->url(), $string);
}

function get_string_between($string, $start, $end)
{
    $string = ' '.$string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return '';
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);
}

function camelCaseToSnakeCase($input)
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
}

function snakeCaseToCamelCase($string, $capitalizeFirstCharacter = false)
{
    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

    if (! $capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}

function key_replace($array, $old_key, $new_key)
{
    if (! array_key_exists($old_key, $array)) {
        return $array;
    }

    $keys = array_keys($array);
    $keys[array_search($old_key, $keys)] = $new_key;

    return array_combine($keys, $array);
}

function datetimeFormatForHubspot(Carbon\Carbon $datetime)
{
    return $datetime->getTimestampMs();
}
