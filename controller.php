<?php
require_once('model.php');
require_once('view.php');
class Controller
{
    public function controller_get_table()
    {
        $m = new Model();
        $phones = $m->model_get_table();
        return $phones;
    }

    public function show_website()
    {
        $v = new View();
        $v->show();
    }
}
