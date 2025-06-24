<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <!-- Título -->
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Gerenciar Ofertas de Vagas por Curso</h1>
                </div>

                <!-- Formulário -->
                <form 
                    action="{{ isset($oferta) ? route('ofertas.update', $oferta) : route('ofertas.store') }}" 
                    method="POST" 
                    class="space-y-4">
                    @csrf
                    @if (isset($oferta))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Campo Processo Seletivo -->
                        <div>
                            <label for="processo_seletivo_id" class="block font-medium text-gray-700">Processo Seletivo *</label>
                            <select 
                                name="processo_seletivo_id" 
                                id="processo_seletivo_id" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="" disabled selected>-- Selecione um Processo Seletivo --</option>
                                @foreach ($processosSeletivos as $processo)
                                    <option 
                                        value="{{ $processo->id }}" 
                                        {{ old('processo_seletivo_id', $oferta->processo_seletivo_id ?? '') == $processo->id ? 'selected' : '' }}>
                                        {{ $processo->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="curso_id" class="block font-medium text-gray-700">Curso *</label>
                            <select 
                                name="curso_id" 
                                id="curso_id" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="" disabled>-- Selecione um Curso --</option>
                                @foreach ($cursos as $curso)
                                    <option 
                                        value="{{ $curso->id }}" 
                                        {{ (int) old('curso_id', $oferta->curso_id ?? '') === $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="turno" class="block font-medium text-gray-700">Turno *</label>
                            <select 
                                name="turno" 
                                id="turno" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="" disabled>-- Selecione um Turno --</option>
                                <option value="Manhã" {{ (old('turno', $oferta->turno ?? '') == 'Manhã') ? 'selected' : '' }}>Manhã</option>
                                <option value="Tarde" {{ (old('turno', $oferta->turno ?? '') == 'Tarde') ? 'selected' : '' }}>Tarde</option>
                                <option value="Noite" {{ (old('turno', $oferta->turno ?? '') == 'Noite') ? 'selected' : '' }}>Noite</option>
                            </select>
                        </div>
                        <div>
                            <label for="quantidade_vagas" class="block font-medium text-gray-700">Quantidade de Vagas *</label>
                            <input 
                                type="number" 
                                name="quantidade_vagas" 
                                id="quantidade_vagas" 
                                value="{{ old('quantidade_vagas', $oferta->quantidade_vagas ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="locais_prova" class="block font-medium text-gray-700">Locais de Prova *</label>
                            <input 
                                type="text" 
                                name="locais_prova" 
                                id="locais_prova" 
                                value="{{ old('locais_prova', $oferta->locais_prova ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="valor_taxa" class="block font-medium text-gray-700">Valor da Taxa de Inscrição</label>
                            <input 
                                type="text" 
                                name="valor_taxa" 
                                id="valor_taxa" 
                                value="{{ old('valor_taxa', $oferta->valor_taxa ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="data_vencimento_taxa" class="block font-medium text-gray-700">Data de Vencimento da Taxa</label>
                            <input 
                                type="date" 
                                name="data_vencimento_taxa" 
                                id="data_vencimento_taxa" 
                                value="{{ old('data_vencimento_taxa', $oferta->data_vencimento_taxa ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="conta_recebimento" class="block font-medium text-gray-700">Conta de Recebimento</label>
                            <input 
                                type="text" 
                                name="conta_recebimento" 
                                id="conta_recebimento" 
                                value="{{ old('conta_recebimento', $oferta->conta_recebimento ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600">
                        {{ isset($oferta) ? 'Atualizar' : 'Salvar' }}
                    </button>
                </form>

                <!-- Listagem -->
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <!-- Cabeçalho -->
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Curso</th>
                                <th class="border px-4 py-2">Turno</th>
                                <th class="border px-4 py-2">Ações</th>
                            </tr>
                        </thead>

                        <!-- Corpo -->
                        <tbody>
                            @forelse ($ofertas as $oferta)
                            <tr>
                                <td class="border px-4 py-2">{{ $oferta->curso->nome }}</td>
                                <td class="border px-4 py-2">{{ $oferta->turno }}</td>
                                <td class="border px-4 py-2 flex justify-end gap-2">
                                    <form action="{{ route('ofertas.duplicate', $oferta) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Duplicar</button>
                                    </form>
                                    <a href="{{ route('ofertas.edit', $oferta) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Editar</a>
                                    <form action="{{ route('ofertas.destroy', $oferta) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="border px-4 py-2 text-center">Nenhuma oferta encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $ofertas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
