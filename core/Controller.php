<?php
namespace Formacom\Core;
abstract class Controller{
    abstract public function index(...$params);
    public function view($view, $data = []) {
        require_once './app/views/' . $view . '.php';
    }
}
?>