<?php
    function parse_data($file_path) {
        $data = array();
        $lines = file($file_path);
        foreach ($lines as $line) {
            $values = explode("|", $line);
            array_push($data, $values);
        }
        return $data;
    }
?>