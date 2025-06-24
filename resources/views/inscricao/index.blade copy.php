<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro na Plataforma</title>
    @vite('resources/css/app.css') <!-- Adiciona o Tailwind CSS -->
</head>

<body class="bg-gray-100">

    <div class="bg-blue-900 text-white p-4 flex items-center justify-between">
        <img src="{{ asset('images/unicentroma.png') }}" alt="Unicentro MA" class="h-12">
        <h1 class="text-center text-xl flex-grow">Cadastro na Plataforma</h1>
        <a href="" class="text-sm text-white hover:underline">Portal do Inscrito</a>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="max-w-4xl mx-auto my-3 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-center text-2xl text-blue-900 mb-6">Cadastro</h2>

        <!-- Formulário -->
        <form action="{{ route('inscricao.store') }}" method="POST" autocomplete="off">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-bold mb-2">Nome *</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                    class="w-full border rounded-lg px-3 py-2 uppercase"
                    oninput="this.value = this.value.toUpperCase();">
                @error('nome')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- CPF -->
            <div class="mb-4">
                <label for="cpf" class="block text-gray-700 font-bold mb-2">CPF *</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required maxlength="14"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder="000.000.000-00">
                @error('cpf')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">E-mail *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full border rounded-lg px-3 py-2" oninput="updateLogin();">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Data de Nascimento e Sexo -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="data_nascimento" class="block text-gray-700 font-bold mb-2">Data de Nascimento *</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" required
                        class="w-full border rounded-lg px-3 py-2">
                    @error('data_nascimento')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="sexo" class="block text-gray-700 font-bold mb-2">Sexo *</label>
                    <select id="sexo" name="sexo" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ old('sexo') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                    </select>
                    @error('sexo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Estado Civil e Ensino Médio -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="estado_civil" class="block text-gray-700 font-bold mb-2">Estado Civil *</label>
                    <select id="estado_civil" name="estado_civil" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        <option value="solteiro" {{ old('estado_civil') == 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="casado" {{ old('estado_civil') == 'casado' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="divorciado" {{ old('estado_civil') == 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="viuvo" {{ old('estado_civil') == 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                    </select>
                    @error('estado_civil')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="ensino_medio" class="block text-gray-700 font-bold mb-2">Formação </label>
                    <select id="ensino_medio" name="ensino_medio" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        <option value="superior_completo" {{ old('ensino_medio') == 'superior_completo' ? 'selected' : '' }}>Superior Completo</option>
                        <option value="superior_incompleto" {{ old('ensino_medio') == 'superior_incompleto' ? 'selected' : '' }}>Superior Incompleto</option>
                        <option value="pos-graduado" {{ old('ensino_medio') == 'pos-graduado' ? 'selected' : '' }}>Pós-Graduado</option>
                    </select>
                    @error('ensino_medio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Cor e Raça/Etnia -->
            <div class="mb-4">
                <label for="cor_raca" class="block text-gray-700 font-bold mb-2">Cor e Raça/Etnia *</label>
                <select id="cor_raca" name="cor_raca" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">Selecione</option>
                    <option value="branca" {{ old('cor_raca') == 'branca' ? 'selected' : '' }}>Branca</option>
                    <option value="preta" {{ old('cor_raca') == 'preta' ? 'selected' : '' }}>Preta</option>
                    <option value="parda" {{ old('cor_raca') == 'parda' ? 'selected' : '' }}>Parda</option>
                    <option value="indigena" {{ old('cor_raca') == 'indigena' ? 'selected' : '' }}>Indígena</option>
                    <option value="amarela" {{ old('cor_raca') == 'amarela' ? 'selected' : '' }}>Amarela</option>
                </select>
                @error('cor_raca')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Endereço e Contato -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="endereco" class="block text-gray-700 font-bold mb-2">Logradouro *</label>
                    <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}" required
                        class="w-full border rounded-lg px-3 py-2">
                    @error('endereco')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="bairro" class="block text-gray-700 font-bold mb-2">Bairro *</label>
                    <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" required
                        class="w-full border rounded-lg px-3 py-2">
                    @error('bairro')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="cep" class="block text-gray-700 font-bold mb-2">CEP *</label>
                    <input type="text" id="cep" name="cep" value="{{ old('cep') }}" required maxlength="9"
                        class="w-full border rounded-lg px-3 py-2" placeholder="00000-000">
                    @error('cep')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="telefone_celular" class="block text-gray-700 font-bold mb-2">Telefone Celular *</label>
                    <input type="tel" id="telefone_celular" name="telefone_celular" value="{{ old('telefone_celular') }}" required maxlength="15"
                        class="w-full border rounded-lg px-3 py-2" placeholder="(00) 00000-0000">
                    @error('telefone_celular')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Curso e Tipo de Aluno -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="tipo_aluno" class="block text-gray-700 font-bold mb-2">Forma de Pagamento</label>
                    <select id="tipo_aluno" name="tipo_aluno" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        <option value="1" {{ old('tipo_aluno') == '1' ? 'selected' : '' }}>12x de R$ 225,00 (total R$ 2.700,00)</option>
                        <option value="2" {{ old('tipo_aluno') == '2' ? 'selected' : '' }}>15x de R$ 212,50 (total R$ 3.187,50</option>
                        <option value="3" {{ old('tipo_aluno') == '3' ? 'selected' : '' }}>18x de R$ 190,00 (total R$ 3.420,00)
                        </option>
                    </select>
                    @error('tipo_aluno')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="pos_graduacao" class="block text-gray-700 font-bold mb-2">Pós-Graduação *</label>
                    <select id="pos_graduacao" name="pos_graduacao" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Selecione</option>
                        @foreach ($cursos as $curso)
                        <option value="{{ $curso->nome }}" {{ old('pos_graduacao') == $curso->nome ? 'selected' : '' }}>{{ $curso->nome }}</option>
                        @endforeach
                    </select>
                    @error('pos_graduacao')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Valor da Mensalidade -->
            <div class="mb-6">
                <label for="valor_mensalidade" class="block text-gray-700 font-bold mb-2">Valor da Mensalidade *</label>
                <input type="text" id="valor_mensalidade" name="valor_mensalidade" value="{{ old('valor_mensalidade') }}" readonly
                    class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                @error('valor_mensalidade')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Login e Senhas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="login" class="block text-gray-700 font-bold mb-2">Login *</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required
                        class="w-full border rounded-lg px-3 py-2">
                    @error('login')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="senha" class="block text-gray-700 font-bold mb-2">Senha *</label>
                    <input type="password" id="senha" name="senha" required autocomplete="new-password"
                        class="w-full border rounded-lg px-3 py-2">
                    @error('senha')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="senha_confirmation" class="block text-gray-700 font-bold mb-2">Confirme a Senha *</label>
                    <input type="password" id="senha_confirmation" name="senha_confirmation" required autocomplete="new-password"
                        class="w-full border rounded-lg px-3 py-2">
                    @error('senha_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botão de envio -->
            <button type="submit"
                class="bg-blue-900 text-white w-full py-3 rounded-lg font-bold hover:bg-blue-700">
                Enviar Dados
            </button>

            <!-- Botão para preencher automaticamente -->
            <button type="button" onclick="preencherCampos()"
                class="bg-yellow-500 text-white w-full py-2 mb-4 rounded-lg font-bold hover:bg-yellow-600">
                Preencher Campos Automaticamente
            </button>
        </form>
    </div>

    {{-- <script>
        function updateMensalidade() {
            const tipoAluno = document.getElementById("tipo_aluno").value;
            const mensalidade = document.getElementById("valor_mensalidade");

            if (tipoAluno === "ativo") {
                mensalidade.value = "150.00";
            } else if (tipoAluno === "egresso") {
                mensalidade.value = "200.00";
            } else if (tipoAluno === "externo") {
                mensalidade.value = "250.00";
            } else {
                mensalidade.value = "";
            }
        }
    </script> --}}
    <script>
        function updateLogin() {
            const email = document.getElementById('email').value;
            document.getElementById('login').value = email;
        }

        document.getElementById('tipo_aluno').addEventListener('change', function() {
            const tipoAluno = this.value;
            const mensalidade = document.getElementById('valor_mensalidade');

            switch (tipoAluno) {
                case '1':
                    mensalidade.value = '225.00';
                    break;
                case '2':
                    mensalidade.value = '212.00';
                    break;
                case '3':
                    mensalidade.value = '190.00';
                    break;
                default:
                    mensalidade.value = '';
            }
        });
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const senha = document.getElementById('senha').value;
            const confirmaSenha = document.getElementById('confirma_senha').value;
            const senhaError = document.getElementById('senha-error');

            if (senha !== confirmaSenha) {
                event.preventDefault(); // Impede o envio do formulário
                senhaError.classList.remove('hidden'); // Mostra a mensagem de erro
            } else {
                senhaError.classList.add('hidden'); // Esconde a mensagem de erro
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Máscara CPF
            const cpfInput = document.getElementById('cpf');
            cpfInput.addEventListener('input', function() {
                let value = cpfInput.value.replace(/\D/g, ''); // Remove não numéricos
                if (value.length > 3) value = value.replace(/^(\d{3})(\d)/, '$1.$2');
                if (value.length > 6) value = value.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                if (value.length > 9) value = value.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/,
                    '$1.$2.$3-$4');
                cpfInput.value = value;
            });

            // Máscara CEP
            const cepInput = document.getElementById('cep');
            cepInput.addEventListener('input', function() {
                let value = cepInput.value.replace(/\D/g, ''); // Remove não numéricos
                if (value.length > 5) value = value.replace(/^(\d{5})(\d)/, '$1-$2');
                cepInput.value = value;
            });

            // Máscara Telefone Celular
            const telefoneInput = document.getElementById('telefone_celular');
            telefoneInput.addEventListener('input', function() {
                let value = telefoneInput.value.replace(/\D/g, ''); // Remove não numéricos
                if (value.length > 0) value = value.replace(/^(\d{0,2})/, '($1');
                if (value.length > 3) value = value.replace(/^(\(\d{2})(\d)/, '$1) $2');
                if (value.length > 10) value = value.replace(/(\d{5})(\d{4})/, '$1-$2');
                telefoneInput.value = value;
            });
        });
    </script>
    {{-- <script>
        function updateLogin() {
            const emailInput = document.getElementById('email');
            const loginInput = document.getElementById('login');

            // Define o valor do login com o valor do email
            loginInput.value = emailInput.value;
        }
    </script> --}}
    <script>
        function preencherCampos() {
            document.getElementById('nome').value = 'João da Silva';
            document.getElementById('cpf').value = '123.456.789-00';
            document.getElementById('email').value = 'joao@email.com';
            document.getElementById('data_nascimento').value = '1990-05-15';
            document.getElementById('sexo').value = 'masculino';
            document.getElementById('estado_civil').value = 'solteiro';
            document.getElementById('ensino_medio').value = 'superior_completo';
            document.getElementById('cor_raca').value = 'branca';
            document.getElementById('endereco').value = 'Rua das Flores, 123';
            document.getElementById('bairro').value = 'Centro';
            document.getElementById('cep').value = '12345-678';
            document.getElementById('telefone_celular').value = '(99) 91234-5678';
            document.getElementById('tipo_aluno').value = '1';
            document.getElementById('valor_mensalidade').value = '225.00';
            document.getElementById('pos_graduacao').selectedIndex = 1; // Primeiro curso da lista
            document.getElementById('login').value = 'joao@email.com';
            document.getElementById('senha').value = '12345678';
            document.getElementById('senha_confirmation').value = '12345678';
        }
    </script>
</body>

</html>