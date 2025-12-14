<?php

class Controller
{
    protected View $view;

    public function __construct(Application $app)
    {
        $this->view = $app->getView();
    }

    public function run(string $actionName): Response
    {
        return $this->$actionName();
    }

    protected function render(array $params = [], string $layout = 'layout'): string
    {
        $templates = ['sidebar', 'graph', 'setting'];
        return $this->view->render($templates, $params, $layout);
    }
}
