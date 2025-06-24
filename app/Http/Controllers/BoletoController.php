<?php

namespace App\Http\Controllers;

use App\Models\Signin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BoletoController extends Controller
{
    public function gerar($id)
    {
        // dd('Entrou no método gerar com ID: ' . $id);
        // Obter dados do aluno
        $inscricao = Signin::findOrFail($id);

        // Verificar se já existe um boleto gerado
        if ($inscricao->asaas_payment_id) {
            \Log::info('Boleto já gerado para este aluno:', ['id' => $inscricao->asaas_payment_id]);

            // Recuperar a URL do boleto existente
            $boletoResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => env('ASAAS_API_KEY'),
            ])->get(env('ASAAS_URL') . '/payments/' . $inscricao->asaas_payment_id);

            $boleto = $boletoResponse->json();

            if (isset($boleto['bankSlipUrl'])) {
                return redirect()->route('boleto.mostrar', ['id' => $id, 'url' => $boleto['bankSlipUrl']]);
            }

            return redirect()->back()->with('error', 'Não foi possível recuperar o boleto existente.');
        }

        // Ajustar telefone para o formato internacional
        $telefone = preg_replace('/[^0-9]/', '', $inscricao->telefone_celular); // Remove caracteres não numéricos
        if (strlen($telefone) === 11) {
            $telefone = '+55' . $telefone; // Adiciona o código do país (Brasil)
        } else {
            return redirect()->back()->with('error', 'Número de telefone inválido.');
        }

        try {
            // Criar cliente no ASAAS
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => env('ASAAS_API_KEY'),
            ])->post(env('ASAAS_URL') . '/customers', [
                'name' => $inscricao->nome,
                'cpfCnpj' => $inscricao->cpf,
                'email' => $inscricao->email,
                'phone' => $telefone,
            ]);

            $cliente = $response->json();

            if (!isset($cliente['id'])) {
                \Log::error('Erro ao criar cliente no ASAAS:', ['response' => $response->body()]);
                return redirect()->back()->with('error', 'Erro ao criar cliente no ASAAS.');
            }

            // Criar boleto para o cliente
            $boletoResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => env('ASAAS_API_KEY'),
            ])->post(env('ASAAS_URL') . '/payments', [
                'customer' => $cliente['id'],
                'billingType' => 'BOLETO',
                'dueDate' => now()->addDays(7)->toDateString(),
                'value' => (float) $inscricao->valor_mensalidade,
                'description' => 'Mensalidade do curso ' . $inscricao->pos_graduacao,
            ]);

            $boleto = $boletoResponse->json();

            \Log::info('Resposta da criação do boleto:', $boleto);

            if (!isset($boleto['id']) || !isset($boleto['bankSlipUrl'])) {
                \Log::error('Erro ao gerar boleto no ASAAS:', ['response' => $boletoResponse->body()]);
                return redirect()->back()->with('error', 'Erro ao gerar boleto no ASAAS.');
            }

            // Salvar o ID do boleto no banco de dados
            $inscricao->asaas_payment_id = $boleto['id'];
            $inscricao->save();

            // Enviar mensagem pelo WhatsApp com link do boleto
            $this->enviarWhatsApp($telefone, $boleto['bankSlipUrl'], $inscricao->nome);

            // Redirecionar para a tela de exibição do boleto
            return redirect()->route('boleto.mostrar', ['id' => $id, 'url' => $boleto['bankSlipUrl']])
                ->with('success', 'Boleto gerado, enviado pelo WhatsApp e disponível para visualização.');
        } catch (\Exception $e) {
            \Log::error('Erro ao gerar boleto:', ['exception' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao gerar boleto. Verifique os logs para mais detalhes.');
        }
    }





    // private function enviarWhatsApp($telefone, $linkBoleto, $nome)
    // {
    //     // Formatando a mensagem
    //     $mensagem = "Olá $nome, segue o link do seu boleto: $linkBoleto. Qualquer dúvida, estamos à disposição!";

    //     // Endpoint da API do CloudServo
    //     $url = 'https://crm2.cloudservo.com.br/api/messages/send';

    //     try {
    //         // Requisição para enviar mensagem via API do CloudServo
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . env('CLOUDSERVO_API_TOKEN'), // Token dinâmico no .env
    //             'Content-Type' => 'application/json',
    //         ])->post($url, [
    //             'number' => $telefone,
    //             'body' => $mensagem,
    //         ]);

    //         if ($response->successful()) {
    //             return true; // Mensagem enviada com sucesso
    //         } else {
    //             throw new \Exception('Erro ao enviar mensagem: ' . $response->body());
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Erro ao enviar mensagem pelo WhatsApp', [
    //             'telefone' => $telefone,
    //             'error' => $e->getMessage(),
    //         ]);
    //         return false;
    //     }
    // }

    private function enviarWhatsApp($telefone, $linkBoleto, $nome)
    {
        $url = 'https://crm2.cloudservo.com.br/api/messages/send';

        try {
            // 1. Mensagem da Secretaria (boas-vindas)
            $mensagemSecretaria = "Olá $nome, seja bem-vindo(a) à sua nova jornada acadêmica na Pós-Graduação! 🎓\n\n" .
                "Estamos felizes por tê-lo conosco. Caso precise de ajuda com documentação ou informações, estamos à disposição na Secretaria Acadêmica.\n\n" .
                "Desejamos muito sucesso!";

            $responseSecretaria = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('CLOUDSERVO_API_TOKEN'),
                'Content-Type' => 'application/json',
            ])->post($url, [
                'number' => $telefone,
                'body' => $mensagemSecretaria,
            ]);

            // 2. Mensagem do Financeiro (link do boleto)
            $mensagemFinanceiro = "Olá $nome, segue o link do seu boleto referente à matrícula da Pós-Graduação:\n" .
                "$linkBoleto\n\n" .
                "Qualquer dúvida financeira, entre em contato com o setor responsável. 📞";

            $responseFinanceiro = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('CLOUDSERVO_API_TOKEN2'),
                'Content-Type' => 'application/json',
            ])->post($url, [
                'number' => $telefone,
                'body' => $mensagemFinanceiro,
            ]);

            // Verifica sucesso nos dois envios
            if ($responseSecretaria->successful() && $responseFinanceiro->successful()) {
                return true;
            } else {
                throw new \Exception('Erro ao enviar uma das mensagens: Secretaria=' . $responseSecretaria->status() . ', Financeiro=' . $responseFinanceiro->status());
            }
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar mensagens pelo WhatsApp', [
                'telefone' => $telefone,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }





    public function mostrarBoleto(Request $request, $id)
    {
        $inscricao = Signin::findOrFail($id);
        $linkBoleto = $request->query('url'); // Receber a URL do boleto

        if (!$linkBoleto) {
            return redirect()->back()->with('error', 'URL do boleto não encontrada.');
        }

        return view('boleto.mostrar', compact('inscricao', 'linkBoleto'));
    }
}
