<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-900 text-gray-200">
        <h1 class="text-2xl font-bold text-gray-100 mb-6">Lista de Alunos</h1>

        <!-- Mensagem de sucesso -->
        @if (session('success'))
            <div class="bg-green-900 text-green-300 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabela -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-700 text-gray-300">
                        <th class="px-4 py-2 border border-gray-600">#</th>
                        <th class="px-4 py-2 border border-gray-600">Nome</th>
                        <th class="px-4 py-2 border border-gray-600">E-mail</th>
                        <th class="px-4 py-2 border border-gray-600">Curso</th>
                        <th class="px-4 py-2 border border-gray-600">Status do Boleto</th>
                        <th class="px-4 py-2 border border-gray-600">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alunos as $aluno)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2 border border-gray-600">{{ $aluno->id }}</td>
                            <td class="px-4 py-2 border border-gray-600">{{ $aluno->nome }}</td>
                            <td class="px-4 py-2 border border-gray-600">{{ $aluno->email }}</td>
                            <td class="px-4 py-2 border border-gray-600">{{ $aluno->pos_graduacao }}</td>
                            <td class="px-4 py-2 border border-gray-600">
                                @if ($aluno->asaas_payment_id)
                                    @php
                                        $statusTraduzido = [
                                            'PENDING' => 'Pendente',
                                            'RECEIVED' => 'Recebido',
                                            'CONFIRMED' => 'Confirmado',
                                            'OVERDUE' => 'Atrasado',
                                            'REFUNDED' => 'Reembolsado',
                                            'CANCELLED' => 'Cancelado',
                                            'CHARGEBACK' => 'Chargeback',
                                            'PAGO' => 'Pago',
                                            'ERROR' => 'Erro'
                                        ][$aluno->boleto_status ?? ''] ?? 'Desconhecido';
                                    @endphp
                            
                                    <span class="{{ $statusTraduzido == 'Pago' || $statusTraduzido == 'Recebido' ? 'text-green-400' : ($statusTraduzido == 'Pendente' || $statusTraduzido == 'Atrasado' ? 'text-yellow-400' : 'text-red-400') }}">
                                        {{ $statusTraduzido }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Sem Boleto</span>
                                @endif
                            </td>
                            
                            <td class="px-4 py-2 border border-gray-600">
                                <!-- Botão para Reimprimir Boleto -->
                                @if ($aluno->asaas_payment_id)
                                    <button onclick="openModal('{{ route('boleto.reimprimir', $aluno->asaas_payment_id) }}')"
                                            class="text-green-400 hover:text-green-500">Reimprimir</button>
                                @endif
                                
                                <!-- Botão Editar -->
                                <a href="{{ route('alunos.edit', $aluno->id) }}" 
                                   class="text-blue-400 hover:text-blue-500 ml-4">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 p-4">Nenhum aluno encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $alunos->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-800 text-gray-200 rounded-lg shadow-lg p-6 w-4/5 md:w-3/5 lg:w-2/5">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">Boleto</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-200 text-lg font-semibold px-4 py-2 bg-gray-700 rounded">
                    Fechar
                </button>
            </div>
            <div class="mt-4">
                <iframe id="boleto-iframe" src="" class="w-full h-96 rounded-lg"></iframe>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openModal(url) {
            const modal = document.getElementById('modal');
            const iframe = document.getElementById('boleto-iframe');

            iframe.src = url; // Define o link do boleto no iframe
            modal.classList.remove('hidden'); // Exibe o modal
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            const iframe = document.getElementById('boleto-iframe');

            iframe.src = ''; // Limpa o link do boleto no iframe
            modal.classList.add('hidden'); // Esconde o modal
        }
    </script>
</x-app-layout>
