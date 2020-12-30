<?php
    // For preventing HTML injections
    function mysql_fix_string($conn, $string) {
        if (get_magic_quotes_gpc()) {
            $string = stripslashes($string);
        }
        $string = strip_tags($string);
        $string = htmlentities($string, ENT_COMPAT | ENT_HTML401, 'UTF-8');
        return $string;
    }

    function mysql_entities_fix_string($conn, $string) {
        $string = $conn->real_escape_string($string);
        $string = mysql_fix_string($conn, $string);
        return $string;
    }
?>