<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class AlunniController
{
    function alunni(Request $request, Response $response, $args)
    {
        $miaclasse = new Classe();
        $view = new Alunni();
        $view->setData($miaclasse);
        $response->getBody()->write($view->render());
        return $response;
    }

    function alunniJson(Request $request, Response $response, $args)
    {
        $miaclasse = new Classe();
        $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($miaclasse));
        return $response;
    }

    function alunno(Request $request, Response $response, $args)
    {
        $miaclasse = new Classe();
        $view = new AlunnoView();
        $view->setData($miaclasse->getAlunno($args['cognome'], $args['nome'], false));
        $response->getBody()->write($view->render());
        return $response;
    }

    function alunnoJson(Request $request, Response $response, $args)
    {
        $miaclasse = new Classe();
        $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($miaclasse->getAlunno($args['cognome'], $args['nome'], true)));
        return $response;
    }
}