<?php
class LogOut {

    function get($slug) {
        session_destroy();
        header("Location: " . URL);
    }
    function post($slug) {

    }

}