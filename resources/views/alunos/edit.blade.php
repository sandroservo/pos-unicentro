<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Aluno</h1>

        <!-- Formulário -->
        <form action="{{ route('alunos.update', $aluno->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="nome" id="nome" value="{{ $aluno->nome }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nome')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CPF -->
                <div>
                    <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                    <input type="text" name="cpf" id="cpf" value="{{ $aluno->cpf }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('cpf')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ $aluno->email }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Data de Nascimento -->
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de
                        Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento"
                        value="{{ $aluno->data_nascimento }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('data_nascimento')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sexo -->
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select name="sexo" id="sexo"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="masculino" {{ $aluno->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ $aluno->sexo == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ $aluno->sexo == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('sexo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Estado Civil -->
                <div>
                    <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                    <select name="estado_civil" id="estado_civil"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="solteiro" {{ $aluno->estado_civil == 'solteiro' ? 'selected' : '' }}>Solteiro
                        </option>
                        <option value="casado" {{ $aluno->estado_civil == 'casado' ? 'selected' : '' }}>Casado</option>
                        <option value="divorciado" {{ $aluno->estado_civil == 'divorciado' ? 'selected' : '' }}>
                            Divorciado</option>
                        <option value="viúvo" {{ $aluno->estado_civil == 'viúvo' ? 'selected' : '' }}>Viúvo</option>
                    </select>
                    @error('estado_civil')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ensino Médio -->
                <div>
                    <label for="ensino_medio" class="block text-gray-700 font-bold mb-2">Ensino Médio *</label>
                    <select id="ensino_medio" name="ensino_medio" required
                        class="w-full border rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecione</option>
                        <option value="completo"
                            {{ old('ensino_medio', $aluno->ensino_medio) == 'completo' ? 'selected' : '' }}>
                            Completo
                        </option>
                        <option value="incompleto"
                            {{ old('ensino_medio', $aluno->ensino_medio) == 'incompleto' ? 'selected' : '' }}>
                            Incompleto
                        </option>
                    </select>
                    @error('ensino_medio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cor/Raça -->
                <div>
                    <label for="cor_raca" class="block text-sm font-medium text-gray-700">Cor/Raça</label>
                    <select name="cor_raca" id="cor_raca"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="branco" {{ $aluno->cor_raca == 'branco' ? 'selected' : '' }}>Branco</option>
                        <option value="preto" {{ $aluno->cor_raca == 'preto' ? 'selected' : '' }}>Preto</option>
                        <option value="pardo" {{ $aluno->cor_raca == 'pardo' ? 'selected' : '' }}>Pardo</option>
                        <option value="indígena" {{ $aluno->cor_raca == 'indígena' ? 'selected' : '' }}>Indígena
                        </option>
                        <option value="outro" {{ $aluno->cor_raca == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('cor_raca')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nome do Pai -->
                <div>
                    <label for="nome_pai" class="block text-sm font-medium text-gray-700">Nome do Pai</label>
                    <input type="text" name="nome_pai" id="nome_pai" value="{{ $aluno->nome_pai }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nome_pai')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nome da Mãe -->
                <div>
                    <label for="nome_mae" class="block text-sm font-medium text-gray-700">Nome da Mãe</label>
                    <input type="text" name="nome_mae" id="nome_mae" value="{{ $aluno->nome_mae }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nome_mae')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Endereço -->
                <div>
                    <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" name="endereco" id="endereco" value="{{ $aluno->endereco }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('endereco')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bairro -->
                <div>
                    <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                    <input type="text" name="bairro" id="bairro" value="{{ $aluno->bairro }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('bairro')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CEP -->
                <div>
                    <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" name="cep" id="cep" value="{{ $aluno->cep }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('cep')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Telefone -->
                <div>
                    <label for="telefone_celular" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="text" name="telefone_celular" id="telefone_celular"
                        value="{{ $aluno->telefone_celular }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('telefone_celular')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipo de Aluno -->
                <div class="mb-4">
                    <label for="tipo_aluno" class="block text-gray-700 font-bold mb-2">Tipo de Aluno *</label>
                    <select id="tipo_aluno" name="tipo_aluno" onchange="updateMensalidade()" required
                        class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        <option value="ativo"
                            {{ old('tipo_aluno', $aluno->tipo_aluno) == 'ativo' ? 'selected' : '' }}>Aluno Ativo
                        </option>
                        <option value="egresso"
                            {{ old('tipo_aluno', $aluno->tipo_aluno) == 'egresso' ? 'selected' : '' }}>Aluno Egresso
                        </option>
                        <option value="externo"
                            {{ old('tipo_aluno', $aluno->tipo_aluno) == 'externo' ? 'selected' : '' }}>Aluno Externo
                        </option>
                    </select>
                    @error('tipo_aluno')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Valor da Mensalidade -->
                <div class="mb-4">
                    <label for="valor_mensalidade" class="block text-gray-700 font-bold mb-2">Valor da Mensalidade
                        *</label>
                    <input type="text" id="valor_mensalidade" name="valor_mensalidade"
                        value="{{ old('valor_mensalidade', $aluno->valor_mensalidade) }}" readonly
                        class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                    @error('valor_mensalidade')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Login -->
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">Login</label>
                    <input type="text" name="login" id="login" value="{{ $aluno->login }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('login')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Senha -->
                <!-- Senha -->
                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="senha" id="senha"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Deixe em branco para manter a senha atual">
                    @error('senha')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmar Senha -->
                <div>
                    <label for="senha_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <input type="password" name="senha_confirmation" id="senha_confirmation"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Deixe em branco para manter a senha atual">
                </div>
            </div>

            <!-- Botões -->
            <div class="mt-6 flex justify-end">
                <a href="{{ route('alunos.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Salvar
                </button>
            </div>
        </form>
    </div>
    <script>
        const mensalidades = {
            ativo: 150.00,
            egresso: 200.00,
            externo: 250.00
        };

        function updateMensalidade() {
            const tipoAluno = document.getElementById('tipo_aluno').value;
            const valorMensalidadeInput = document.getElementById('valor_mensalidade');

            // Define o valor da mensalidade baseado no tipo de aluno
            if (mensalidades[tipoAluno]) {
                valorMensalidadeInput.value = mensalidades[tipoAluno].toFixed(2); // Formato americano
            } else {
                valorMensalidadeInput.value = ''; // Limpa o campo
            }
        }

        // Corrige o valor antes de submeter o formulário
        document.querySelector('form').addEventListener('submit', function() {
            const valorMensalidadeInput = document.getElementById('valor_mensalidade');
            if (valorMensalidadeInput.value) {
                valorMensalidadeInput.value = valorMensalidadeInput.value.replace(',',
                '.'); // Substitui vírgulas por pontos
            }
        });

        // Atualiza a mensalidade ao carregar a página (se o tipo já estiver selecionado)
        document.addEventListener('DOMContentLoaded', () => {
            updateMensalidade();
        });
    </script>
</x-app-layout>
