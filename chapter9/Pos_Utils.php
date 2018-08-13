<?php

class Pos_Utils
{
    public static function getFirst($text, $number = 2)
    {
        $result = array();

        if ($number == 0) {
            $result[0] = $text;
            $result[1] = false;
        } else {
            // Regular expression to find typical sentence endings
            $pattern = '/([.?!]["\']?)\s/';

            // Use regex to insert break indicator
            $text = str_replace('&#13;', '', $text);
            $text = preg_replace($pattern, '$1bRE@kH3re', strip_tags($text));

            // Use break indicator to create array of sentences
            $sentences = preg_split('/bRE@kH3re/', $text);

            // Check relative length of array and requested number
            $howMany = count($sentences);
            $number = $howMany >= $number ? $number : $howMany;

            // Rebuild extract and return as single string
            $remainder = array_splice($sentences, $number);
            $result[0] = implode(' ', $sentences);
            $result[1] = empty($remainder) ? false : true;
        }

        return $result;
    }
}