<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <!-- Botão Voltar -->
                <div class="mb-4">
                    <a href="{{ route('processos.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center gap-2">
                        <i class="fa fa-arrow-left"></i>
                        Voltar
                    </a>
                </div>

                <!-- Título -->
                <div class="flex justify-center mb-4">
                    <h1 class="text-2xl font-bold text-center">
                        {{ isset($processo) ? 'Editar Processo Seletivo' : 'Inserir Processo Seletivo' }}
                    </h1>
                </div>

                <!-- Formulário -->
                <form 
                    action="{{ isset($processo) ? route('processos.update', $processo) : route('processos.store') }}" 
                    method="POST" 
                    class="space-y-4">
                    @csrf
                    @if (isset($processo))
                        @method('PUT')
                    @endif
                    

                    <div>
                        <label for="nome" class="block font-medium text-gray-700">Nome</label>
                        <input 
                            type="text" 
                            name="nome" 
                            id="nome" 
                            value="{{ old('nome', $processo->nome ?? '') }}" 
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label for="numero_etapas" class="block font-medium text-gray-700">Número de Etapas</label>
                        <input 
                            type="number" 
                            name="numero_etapas" 
                            id="numero_etapas" 
                            value="{{ old('numero_etapas', $processo->numero_etapas ?? '') }}" 
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label for="numero_ofertas" class="block font-medium text-gray-700">Número de Ofertas</label>
                        <input 
                            type="number" 
                            name="numero_ofertas" 
                            id="numero_ofertas" 
                            value="{{ old('numero_ofertas', $processo->numero_ofertas ?? '') }}" 
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <button type="submit" class="px-4 py-2 w-24 bg-green-500 text-white rounded-lg">
                        {{ isset($processo) ? 'Atualizar' : 'Salvar' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
