<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Inserir Processo Seletivo</h1>

                <form action="{{ route('processos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nome" class="block font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" id="nome" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label for="numero_etapas" class="block font-medium text-gray-700">Número de Etapas</label>
                        <input type="number" name="numero_etapas" id="numero_etapas" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label for="numero_ofertas" class="block font-medium text-gray-700">Número de Ofertas</label>
                        <input type="number" name="numero_ofertas" id="numero_ofertas" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
