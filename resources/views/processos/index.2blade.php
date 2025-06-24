<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Gerenciar Processos Seletivos</h1>
                <a href="{{ route('processos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Inserir</a>

                <table class="min-w-full mt-6 border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Nome</th>
                            <th class="border px-4 py-2">Número de Etapas</th>
                            <th class="border px-4 py-2">Número de Ofertas</th>
                            <th class="border px-4 py-2">Situação</th>
                            <th class="border px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($processos as $processo)
                            <tr>
                                <td class="border px-4 py-2">{{ $processo->id }}</td>
                                <td class="border px-4 py-2">{{ $processo->nome }}</td>
                                <td class="border px-4 py-2">{{ $processo->numero_etapas }}</td>
                                <td class="border px-4 py-2">{{ $processo->numero_ofertas }}</td>
                                <td class="border px-4 py-2">{{ $processo->situacao }}</td>
                                <td class="border px-4 py-2">
                                    <a href="#" class="px-3 py-1 bg-yellow-500 text-white rounded-lg">Editar</a>
                                    <a href="#" class="px-3 py-1 bg-red-500 text-white rounded-lg">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $processos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
