<?php

class GraphController extends Controller
{
    public function init(): Response
    {
        $content = $this->render();
        return Response::html(200, $content);
    }

    public function search()
    {
        $searchRequest = Request::getRequestData();
        var_dump($searchRequest);
        $searchData = $this->service->search($searchRequest);
        return Response::json(200, $searchData);
    }
}
