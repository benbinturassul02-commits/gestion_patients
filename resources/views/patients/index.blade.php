<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Liste des patients</h2>

        <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">
            Ajouter
        </a>

        <form method="GET" action="{{ route('patients.index') }}" class="mb-4">

            <input 
                type="text" 
                name="search" 
                placeholder="Rechercher..." 
                value="{{ $search }}"
                class="border p-2"
            >

            <select name="sort" class="border p-2">
                <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>A → Z</option>
                <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Z → A</option>
            </select>

            <button class="bg-gray-500 text-white px-3 py-1">Appliquer</button>

        </form>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @if($patients->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center text-red-500">
                            Aucun patient trouvé
                        </td>
                    </tr>
                @endif

                @foreach($patients as $p)
                <tr>
                    <td>{{ $p->nom }}</td>
                    <td>{{ $p->prenom }}</td>
                    <td>{{ $p->age }}</td>
                    <td>
                        <a href="{{ route('patients.edit', $p->id) }}" class="text-blue-500">Modifier</a>

                        <form action="{{ route('patients.destroy',$p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $patients->appends([
                'search' => $search,
                'sort' => $sort,
            ])->links() }}
        </div>

    </div>
</x-app-layout>