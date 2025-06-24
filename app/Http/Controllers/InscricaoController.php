<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Signin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Rules\ValidCpf;

class InscricaoController extends Controller
{
    public function index()
    {
        // Obtenha os cursos disponíveis da tabela `cursos`
        $cursos = Curso::select('id', 'nome')->get();

        // Passe os cursos para a view
        return view('inscricao.index', compact('cursos'));
    }
    public function store(Request $request)
    {

        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'unique:signins,cpf', new ValidCpf],
            //'cpf' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:signins,email', // Validação do email
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string',
            'estado_civil' => 'required|string',
            'ensino_medio' => 'required|string',
            'cor_raca' => 'required|string',
            //'nome_pai' => 'nullable|string|max:255',
            //'nome_mae' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:15',
            'telefone_celular' => 'required|string|max:15',
            'tipo_aluno' => 'required|string',
            'valor_mensalidade' => 'required|numeric',
            'pos_graduacao' => 'required|string',
            'login' => 'required|string|max:255|unique:signins,login',
            'senha' => 'required|string|min:8|confirmed',
        ]);


        // Encriptação da senha
        $validated['senha'] = bcrypt($validated['senha']);

        // Criação da inscrição
        $signin = Signin::create($validated);

        // Retorna com mensagem de sucesso
        //return redirect()->route('inscricao.index')->with('success', 'Inscrição realizada com sucesso!');
        return redirect()->route('inscricao.comprovante', ['id' => $signin->id]);
    }
    public function comprovante($id)
    {
        $inscricao = Signin::findOrFail($id);

        return view('inscricao.comprovante', compact('inscricao'));
    }

    public function downloadComprovante($id)
    {
        $inscricao = Signin::findOrFail($id);

        // Gera o PDF com os dados da inscrição
        $pdf = Pdf::loadView('inscricao.comprovante-pdf', compact('inscricao'))
            ->setPaper('a4', 'portate');

        // Retorna o download do PDF
        return $pdf->stream('comprovante-inscricao.pdf');
    }
}
