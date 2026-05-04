<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Liste des rendez-vous</h2>

        <a href="{{ route('rendezvous.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">
            Ajouter
        </a>

        <form method="GET" action="{{ route('rendezvous.index') }}" class="mb-4">

            <input 
                type="date" 
                name="date" 
                value="{{ $date }}"
                class="border p-2"
            >

            <button class="bg-gray-500 text-white px-3 py-1">
                Filtrer
            </button>

        </form>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                
                @if($rendezvous->isEmpty())
                    <tr>
                        <td colspan="5">Aucun rendez-vous trouvé</td>
                    </tr>
                @endif

                @foreach($rendezvous as $rdv)
                <tr>
                    <td>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
                    <td>{{ $rdv->date }}</td>
                    <td>{{ $rdv->heure }}</td>
                    <td>{{ $rdv->description }}</td>
                    <td>
                        <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="text-blue-500">Modifier</a>

                        <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" style="display:inline;">
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
            {{ $rendezvous->appends(['date' => $date])->links() }}
        </div>

    </div>
</x-app-layout>