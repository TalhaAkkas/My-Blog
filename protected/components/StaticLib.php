<?php

class StaticLib {

    static function cuttags($string) {
        $chuncks = array();
        $inchar = false;
        $def = false;
        $chunk = "";
        foreach (str_split($string) as $letter) {
            if ($def) {
                $def = false;
                $chunk = $chunk . $letter;
                continue;
            }
            switch ($letter) {
                case '\\': {
                        $def = true;
                        $chunk = $chunk . $letter;
                        break;
                    }
                case '<': {
                        array_push($chuncks, $chunk);
                        $chunk = $letter;
                        break;
                    }
                case '&': {
                        $inchar = true;
                        array_push($chuncks, $chunk);
                        $chunk = $letter;
                        break;
                    }
                case '>': {

                        $chunk = $chunk . $letter;
                        array_push($chuncks, $chunk);
                        $chunk = "";
                        break;
                    }
                case ';': {
                        if ($inchar) {
                            $chunk = $chunk . $letter;
                            array_push($chuncks, $chunk);
                            $chunk = "";
                            $inchar = false;
                        } else {
                            $chunk = $chunk . $letter;
                        }
                        break;
                    }
                default: {
                        $chunk = $chunk . $letter;
                    }
            }
        }

        return $chuncks;
    }

    static function htmlcut($string, $length) {
        $newstring = "";
        $stack = array();
        foreach (StaticLib::cuttags($string) as $tag) {
            if (StaticLib::endswith($tag, '/>')) {
                $newstring = $newstring . $tag;
                continue;
            } elseif (StaticLib::startswith($tag, '</')) {
                array_pop($stack);
                $newstring = $newstring . $tag;
            } elseif (StaticLib::startswith($tag, '<')) {
                array_push($stack, $tag);
                $newstring = $newstring . $tag;
            } elseif (StaticLib::startswith($tag, '&nbsp;')) {
                $newstring = $newstring . $tag;
            } else {
                if (strlen($tag) < $length) {
                    $length -= strlen($tag);
                    $newstring = $newstring . $tag;
                } else {
                    $newstring = $newstring . substr($tag, 0, $length);
                    $length = 0;
                }
            }
            if ($length <= 0) {
                break;
            }
        }
        foreach ($stack as $tag) {
            $newstring = $newstring . StaticLib::closetag($tag);
        }
        return $newstring;
    }

    static function closetag($tag) {
        $closetag = "";
        foreach (str_split($tag) as $letter) {
            if ($letter === '<') {
                $closetag = "</";
            } elseif ($letter === ' ') {
                $closetag = $closetag . ">";
                break;
            } else {
                $closetag = $closetag . $letter;
            }
        }
        return $closetag;
    }

    static function startswith($Haystack, $Needle) {
        // Recommended version, using strpos
        return strpos($Haystack, $Needle) === 0;
    }

    static function endswith($Haystack, $Needle) {
        // Recommended version, using strpos
        return strrpos($Haystack, $Needle) === strlen($Haystack) - strlen($Needle);
    }

}

?>
