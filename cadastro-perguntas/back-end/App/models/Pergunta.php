<?php

namespace App\Models;

use App\Models;

class Pergunta extends BaseModel
{
  protected $primaryKey = 'idPergunta';
  protected $fillable = [
    'textoPergunta',
    'idDimensao',
    'ativaPergunta',
    'excluidaPergunta'
  ];
 
  public static function findNaoExcluida($id)
  {
    $pergunta = Pergunta::where(
      [
        ['idPergunta', '=', $id],
        ['excluidaPergunta', '=', '0']
      ]
    )->firstOrFail();
    return $pergunta;
  }
  
}
