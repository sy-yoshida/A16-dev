<?php

class GraphController extends Controller
{
    public function init(): Response
    {
        $content = $this->render();
        return Response::html(200, $content);
    }
}
