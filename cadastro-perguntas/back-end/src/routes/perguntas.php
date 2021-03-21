<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Pergunta;

$app->get('/perguntas', function ($request, $response) {
  try {

    $perguntas = Pergunta::join(
      'dimensoes',
      'dimensoes.idDimensao',
      '=',
      'perguntas.idDimensao'
    )->where('perguntas.excluidaPergunta', '=', '0')
      ->get();
    return $response->withJson($perguntas);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->post('/perguntas', function ($request, $response) {
  try {
    $dados = $request->getParsedBody();
    $pergunta = Pergunta::create($dados);
    return $response->withJson($pergunta);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->get('/perguntas/{id}', function ($request, $response, $args) {
  try {

    $pergunta = Pergunta::findNaoExcluida($args['id']);

    return $response->withJson($pergunta);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->put('/perguntas/{id}', function ($request, $response, $args) {
  try {
    $dados = $request->getParsedBody();

    $pergunta = Pergunta::findNaoExcluida($args['id']);
    $pergunta->update($dados);
    return $response->withJson($pergunta);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'Erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->delete('/perguntas/{id}', function ($request, $response, $args) {
  try {
    $pergunta = Pergunta::findNaoExcluida($args['id']);
   
    $pergunta->update(['excluidaPergunta'=>'1']);
    return $response->withJson($pergunta);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});
