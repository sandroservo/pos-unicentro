<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <!-- Título -->
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Gerenciar Cursos</h1>
                </div>

                <!-- Formulário -->
                <form 
                    action="{{ isset($curso) ? route('cursos.update', $curso) : route('cursos.store') }}" 
                    method="POST" 
                    class="space-y-4">
                    @csrf
                    @if (isset($curso))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block font-medium text-gray-700">Nome do Curso *</label>
                            <input 
                                type="text" 
                                name="nome" 
                                id="nome" 
                                value="{{ old('nome', $curso->nome ?? '') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="tipo" class="block font-medium text-gray-700">Tipo do Curso *</label>
                            <select 
                                name="tipo" 
                                id="tipo" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="" disabled>-- Selecione um Tipo --</option>
                                <option value="Graduação" {{ (old('tipo', $curso->tipo ?? '') == 'Graduação') ? 'selected' : '' }}>Graduação</option>
                                <option value="Pós-Graduação" {{ (old('tipo', $curso->tipo ?? '') == 'Pós-Graduação') ? 'selected' : '' }}>Pós-Graduação</option>
                                <option value="Mestrado" {{ (old('tipo', $curso->tipo ?? '') == 'Mestrado') ? 'selected' : '' }}>Mestrado</option>
                                <option value="Doutorado" {{ (old('tipo', $curso->tipo ?? '') == 'Doutorado') ? 'selected' : '' }}>Doutorado</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600">
                        {{ isset($curso) ? 'Atualizar' : 'Salvar' }}
                    </button>
                </form>

                <!-- Listagem -->
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <!-- Cabeçalho -->
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Nome do Curso</th>
                                <th class="border px-4 py-2">Tipo</th>
                                <th class="border px-4 py-2">Ações</th>
                            </tr>
                        </thead>

                        <!-- Corpo -->
                        <tbody>
                            @forelse ($cursos as $curso)
                                <tr>
                                    <td class="border px-4 py-2">{{ $curso->nome }}</td>
                                    <td class="border px-4 py-2">{{ $curso->tipo }}</td>
                                    <td class="border px-4 py-2 flex justify-end gap-2">
                                        <a href="{{ route('cursos.edit', $curso) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Editar</a>
                                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="border px-4 py-2 text-center">Nenhum curso encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $cursos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
