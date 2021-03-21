<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dimensao;
use App\Models\Pergunta;

$app->get('/dimensoes', function ($request, $response) {
  try {
    $dimensoes = Dimensao::where(
      'excluidaDimensao',
      '=',
      '0'
    )
      ->get();
    return $response->withJson($dimensoes);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->post('/dimensoes', function ($request, $response) {
  try {
    $dados = $request->getParsedBody();
    $dimensao = Dimensao::create($dados);
    return $response->withJson($dimensao);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->get('/dimensoes/{id}', function ($request, $response, $args) {
  try {
    $dimensao = Dimensao::findNaoExcluida($args['id']);
    return $response->withJson($dimensao);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->put('/dimensoes/{id}', function ($request, $response, $args) {
  try {
    $dados = $request->getParsedBody();
    $dimensao = Dimensao::findNaoExcluida($args['id']);
    $dimensao->update($dados);
    return $response->withJson($dimensao);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});

$app->delete('/dimensoes/{id}', function ($request, $response, $args) {
  try {
    $dimensao = Dimensao::findNaoExcluida($args['id']);
    $hasPerguntas = Pergunta::where(
      [
        ['idDimensao', '=', $args['id']],
        ['excluidaPergunta', '=', '0']
      ]
    )->exists();

    if ($hasPerguntas) {
      throw new Exception(
        'Não é possível excluir a dimensão, pois há perguntas vinculadas a ela'
      );
    }

    $dimensao->update(['excluidaDimensao'=>'1']);
    return $response->withJson($dimensao);
  } catch (Exception $e) {
    return $response->withJson(
      ['status' => 'erro', 'mensagem' => $e->getMessage()],
      400
    );
  }
});
