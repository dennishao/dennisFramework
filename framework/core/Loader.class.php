<?php
class Loader
{
    public function library($lib)
    {
        require_once LIBRARIES_PATH."/$lib.class.php";
    }
    public function helper($helper)
    {
        require_once HELPERS_PATH."/$helper.php";
    }
}