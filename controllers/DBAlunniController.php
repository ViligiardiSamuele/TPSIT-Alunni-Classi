<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
    function alunni(Request $request, Response $response, $args)
    {
        $view = new Alunni();
        $view->setData(Classe::getInstance());
        $response->getBody()->write($view->render());
        return $response;
    }

    function alunno(Request $request, Response $response, $args)
    {
        $view = new AlunnoView();
        $view->setData(Classe::getInstance()->getAlunno($args['cognome'], $args['nome'], false));
        $response->getBody()->write($view->render());
        return $response;
    }
    
    function alunniJson(Request $request, Response $response, $args)
    {
        $response->getBody()->write(json_encode(Classe::getInstance()));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }

    function alunnoJson(Request $request, Response $response, $args)
    {
        $response->getBody()->write(json_encode(Classe::getInstance()->getAlunno($args['cognome'], $args['nome'], true)));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }

    function CreateAlunno(Request $request, Response $response, $args)
    {
        $dati = json_decode($request->getBody()->getContents(), true);
        $alunno = new Alunno($dati["nome"], $dati["cognome"], $dati["eta"]);

        if (isset($alunno)) {
            $response->getBody()->write(json_encode([
                'success' => Database::getInstance()->insert($alunno)
            ], JSON_PRETTY_PRINT));
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
