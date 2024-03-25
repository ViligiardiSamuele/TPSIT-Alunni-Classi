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

    function CreateAlunno(Request $request, Response $response, $args)
    {
        $dati = json_decode($request->getBody()->getContents(), true);
        $alunno = new Alunno($dati["nome"], $dati["cognome"], $dati["eta"]);
        if (isset($alunno)) {
            $response->getBody()->write(json_encode($alunno, JSON_PRETTY_PRINT));
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode(['Error' => 500], JSON_PRETTY_PRINT));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }

    function UpdateAlunno(Request $request, Response $response, $args)
    {
        $dati = json_decode($request->getBody()->getContents(), true);
        $miaclasse = new Classe();
        $alunno = $miaclasse->getAlunnoByID($args['id']);
        if (isset($alunno)) {
            $alunno->setNome($dati['nome']);
            $alunno->setCognome($dati['cognome']);
            $alunno->setEta($dati['eta']);
            $response->getBody()->write(json_encode($alunno, JSON_PRETTY_PRINT));
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode(['Error' => 500], JSON_PRETTY_PRINT));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }

    function DeleteAlunno(Request $request, Response $response, $args)
    {
        $miaclasse = new Classe();
        if ($miaclasse->rmAlunnoByID($args['id'])) {
            $response->getBody()->write($args['id'] . ' eliminato');
            return $response->withStatus(202);
        } else {
            $response->getBody()->write(json_encode(['Error' => 500], JSON_PRETTY_PRINT));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }
}
