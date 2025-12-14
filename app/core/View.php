<?php

class View
{
    public function __construct(private string $baseDir)
    {
    }

    public function render(array $templates, array $params, $layout = 'layout'): string
    {
        extract($params);

        // HTMLの部品パーツをレンダリング
        $contents = [];
        foreach ($templates as $template) {
            $componentPath = $this->baseDir . '/component/' . $template . '.php';
            ob_start();
            include $componentPath;
            $name = $template . 'Content';
            $contents[$name] = ob_get_clean();
        }

        // HTMLの部品パーツを結合させて1つの返却ファイルをレンダリング
        extract($contents);
        $layoutPath = $this->baseDir . '/' . $layout . '.php';
        ob_start();
        include $layoutPath;
        return ob_get_clean();
    }
}
