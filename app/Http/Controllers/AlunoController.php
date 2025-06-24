<?php

namespace App\Http\Controllers;

use App\Models\Signin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlunoController extends Controller
{
    // Listar alunos com paginação
    public function index()
    {
        $alunos = Signin::paginate(10);

        foreach ($alunos as $aluno) {
            if ($aluno->asaas_payment_id) {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'access_token' => env('ASAAS_API_KEY')
                ])->get(env('ASAAS_URL') . '/payments/' . $aluno->asaas_payment_id);

                if ($response->successful()) {
                    $boletoData = $response->json();
                    $aluno->boleto_status = strtoupper($boletoData['status']); // Exemplo: PENDING, CONFIRMED
                } else {
                    $aluno->boleto_status = 'ERRO AO OBTER STATUS';
                }
            } else {
                $aluno->boleto_status = 'SEM BOLETO';
            }
        }

        return view('alunos.index', compact('alunos'));
    }



    // Tela de edição de um único aluno
    public function edit($id)
    {
        $aluno = Signin::findOrFail($id);

        // Buscar status do boleto no Asaas
        $boletoStatus = null;
        if ($aluno->asaas_payment_id) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => env('ASAAS_API_KEY')
            ])->get(env('ASAAS_URL') . '/payments/' . $aluno->asaas_payment_id);

            if ($response->successful()) {
                $boletoData = $response->json();
                $boletoStatus = strtoupper($boletoData['status']); // Status: PAGO, PENDENTE, CANCELADO
            } else {
                $boletoStatus = 'ERRO AO OBTER STATUS';
            }
        }

        return view('alunos.edit', compact('aluno', 'boletoStatus'));
    }


    // Atualizar os dados de um aluno
    public function update(Request $request, $id)
    {
        // Obter o registro do aluno
        $aluno = Signin::findOrFail($id);

        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:255|unique:signins,cpf,' . $aluno->id,
            'email' => 'required|email|max:255|unique:signins,email,' . $aluno->id,
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string',
            'estado_civil' => 'required|string',
            'ensino_medio' => 'required|string',
            'cor_raca' => 'required|string',
            'nome_pai' => 'nullable|string|max:255',
            'nome_mae' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:15',
            'telefone_celular' => 'required|string|max:15',
            'tipo_aluno' => 'required|string',
            'valor_mensalidade' => 'required|numeric',
            'login' => 'required|string|max:255|unique:signins,login,' . $aluno->id,
            'senha' => 'nullable|string|min:8|confirmed', // Permite a senha ser opcional
        ]);

        // Atualização dos dados, exceto a senha
        $data = $request->except('senha', 'senha_confirmation');

        // Verifica se a senha foi preenchida
        if ($request->filled('senha')) {
            $data['senha'] = bcrypt($request->senha); // Criptografa a nova senha
        }

        // Atualiza o aluno
        $aluno->update($data);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('alunos.index')->with('success', 'Dados do aluno atualizados com sucesso!');
    }
    public function reimprimirBoleto($paymentId)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'access_token' => env('ASAAS_API_KEY')
        ])->get(env('ASAAS_URL') . '/payments/' . $paymentId);

        if ($response->successful()) {
            $boletoData = $response->json();
            if (isset($boletoData['bankSlipUrl'])) {
                return redirect($boletoData['bankSlipUrl']); // Redireciona para o link do boleto
            }
        }

        return redirect()->back()->with('error', 'Erro ao obter o boleto.');
    }
}
