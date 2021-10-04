<?php 
    function getTimeDifference($time) {
        $time = strtotime($time);
        $timeNow = time();

        $difference = $timeNow - $time;

        if ($difference < 60) {
            $output = $difference . " seconds ago";
        }
        else if ($difference < (60 * 60)) {
            $output = (int)($difference / 60) . " minutes ago";
        }
        else if ($difference < (60 * 60 * 24)) {
            $output = (int)($difference / 60 / 60) . " hours ago";
        }
        else if ($difference < (60 * 60 * 24 * 30)) {
            $output = (int)($difference / 60 / 60 / 24) . " days ago";
        }
        else if ($difference < (60 * 60 * 24 * 365)) {
            $output = (int)($difference / 60 / 60 / 24 / 30) . " months ago";
        }
        else {
            $output = (int)($difference / 60 / 60 / 24 / 365) . " years ago";
        }
        return $output;
    }
?>