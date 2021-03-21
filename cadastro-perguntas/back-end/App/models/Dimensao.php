<?php

namespace App\Models;
use App\Models\BaseModel;

class Dimensao extends BaseModel {
  protected $primaryKey = 'idDimensao';
  protected $table = 'dimensoes';
  protected $fillable = [
    'descricaoDimensao',
    'excluidaDimensao'
  ];

  public static function findNaoExcluida($id)
  {
    $dimensao = Dimensao::where(
      [
        ['idDimensao', '=', $id],
        ['excluidaDimensao', '=', '0']
      ]
    )->firstOrFail();
    return $dimensao;
  }
}
