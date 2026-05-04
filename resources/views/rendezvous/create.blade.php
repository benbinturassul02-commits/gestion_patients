<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Ajouter un rendez-vous</h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rendezvous.store') }}" method="POST">
            @csrf

            <select name="patient_id" class="border p-2 block mb-2">
                <option value="">Choisir un patient</option>
                @foreach($patients as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nom }} {{ $p->prenom }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" class="border p-2 block mb-2">
            <input type="time" name="heure" class="border p-2 block mb-2">
            <textarea name="description" placeholder="Description" class="border p-2 block mb-2"></textarea>

            <button class="bg-green-500 text-white px-3 py-1 rounded">
                Ajouter
            </button>
        </form>

    </div>
</x-app-layout>