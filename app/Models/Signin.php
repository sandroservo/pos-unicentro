<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signin extends Model
{
    protected $table = 'signins';
    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'data_nascimento',
        'sexo',
        'estado_civil',
        'ensino_medio',
        'cor_raca',
        //'nome_pai',
        //'nome_mae',
        'endereco',
        'bairro',
        'cep',
        'telefone_celular',
        'tipo_aluno',
        'valor_mensalidade',
        'pos_graduacao',
        'login',
        'senha',
    ];
    
}
