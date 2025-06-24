<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Título -->
                <h1 class="text-2xl font-bold mb-4">Gerenciar Processos Seletivos</h1>
    
                <!-- Botões de Listar e Inserir -->
                <div class="flex gap-4 mb-4">
                    <button
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center gap-2">
                        <i class="fa fa-list-alt"></i>
                        Listar
                    </button>
                    <a href="{{ route('processos.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 flex items-center gap-2">
                        <i class="fa fa-plus"></i>
                        Inserir
                    </a>
                </div>
    
                <!-- Filtros de Busca -->
                <div class="bg-gray-100 p-4 rounded-lg mb-4">
                    <h2 class="text-lg font-semibold mb-2">Filtros de Busca</h2>
                    <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="situacao" class="block text-sm font-medium text-gray-700">Situação</label>
                            <select id="situacao" name="situacao"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="ATIVO">ATIVO</option>
                                <option value="INATIVO">INATIVO</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button
                                class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
    
                <!-- Tabela -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                                <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Nome do Processo Seletivo</th>
                                <th class="border px-4 py-2 text-center text-sm font-medium text-gray-700">Número de Etapas</th>
                                <th class="border px-4 py-2 text-center text-sm font-medium text-gray-700">Número de Ofertas</th>
                                <th class="border px-4 py-2 text-center text-sm font-medium text-gray-700">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($processos as $processo)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $processo->id }}</td>
                                    <td class="border px-4 py-2">{{ $processo->nome }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $processo->numero_etapas }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $processo->numero_ofertas }}</td>
                                    <td class="border px-4 py-2 text-center flex justify-center gap-2">
                                        <a href="{{ route('inscricao.index', $processo) }}"
                                            class="bg-green-500 text-white px-2 py-1 rounded-lg">Link</a>

                                        <a href="{{ route('alunos.index', $processo) }}"
                                            class="bg-green-500 text-white px-2 py-1 rounded-lg">Inscritos</a>
                                            
                                        <a href="{{ route('ofertas.index', $processo) }}"
                                            class="bg-green-500 text-white px-2 py-1 rounded-lg">vagas</a>
                                        <a href="{{ route('processos.edit', $processo) }}"
                                            class="bg-yellow-500 text-white px-2 py-1 rounded-lg">Editar</a>
                                        <form action="{{ route('processos.destroy', $processo) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este processo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded-lg">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center">Nenhum processo seletivo encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
    
                <!-- Paginação -->
                <div class="mt-4">
                    {{ $processos->links() }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
