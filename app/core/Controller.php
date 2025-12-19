<?php

class Controller
{
    protected View $view;
    protected DatabaseManager $databaseManager;
    protected $service;

    public function __construct(Application $app)
    {
        $this->view = $app->getView();
        $this->databaseManager = $app->getDatabaseManager();
        $this->service = $this->getService($this->databaseManager);
    }

    public function run(string $actionName): Response
    {
        return $this->$actionName();
    }

    protected function render(array $params = [], string $layout = 'layout'): string
    {
        $templates = ['sidebar', 'graph', 'search'];
        return $this->view->render($templates, $params, $layout);
    }

    private function getService()
    {
        $serviceName = $this->getControllerName() . 'Service';
        return new $serviceName($this->databaseManager);
    }

    private function getControllerName(): string
    {
        $controller = str_replace('App\\Controllers\\', '', get_class($this));
        return str_replace('Controller', '', $controller);
    }
}
