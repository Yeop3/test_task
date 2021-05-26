<?php
namespace app;

class controller{
    public $layoutFile = 'views/layouts/default.php';

    public function renderLayout ($body)
    {

        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.$this->layoutFile;
        return ob_get_clean();

    }

    public function render ($viewName, array $params = [])
    {

        $view = ROOTPATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $view;
        $body = ob_get_clean();
        ob_end_clean();
        return $this->renderLayout($body);

    }
}
