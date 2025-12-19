<?php

class Application
{
    private DatabaseManager $databaseManager;
    private Request $request;
    private Router $router;
    private View $view;

    public function __construct()
    {
        $this->databaseManager = new DatabaseManager();
        $this->request = new Request();
        $this->router = new Router($this->registerRouting());
        $this->view = new View(__DIR__ . '/views');
    }

    public function run(): void
    {
        $this->databaseManager->connectDatabase();
        // $model = $this->databaseManager->getModel('RecodeModel');
        // $model->search();

        $acessPath = $this->request->getAcessPath();
        $routing = $this->router->routing($acessPath);
        $controllerName = ucfirst($routing['controller']) . 'Controller';
        $actionName = $routing['action'];
        $response = $this->runAction($controllerName, $actionName);
        $response->send();
    }

    public function runAction(string $controllerName, string $actionName)
    {
        $controller = new $controllerName($this);
        return $controller->run($actionName);
    }
    
    public function getView(): View
    {
        return $this->view;
    }

    public function getDatabaseManager(): DatabaseManager
    {
        return $this->databaseManager;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function registerRouting(): array
    {
        return [
            '/app/web/' => ['controller' => 'graph', 'action' => 'init'],
            '/app/web/search' => ['controller' => 'graph', 'action' => 'search'],
        ];
    }

}