<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Modifier rendez-vous</h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rendezvous.update', $rendezvous->id) }}" method="POST">
            @csrf
            @method('PUT')

            <select name="patient_id" class="border p-2 block mb-2">
                @foreach($patients as $p)
                    <option value="{{ $p->id }}" 
                        {{ $rendezvous->patient_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nom }} {{ $p->prenom }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ $rendezvous->date }}" class="border p-2 block mb-2">
            <input type="time" name="heure" value="{{ $rendezvous->heure }}" class="border p-2 block mb-2">
            <textarea name="description" class="border p-2 block mb-2">{{ $rendezvous->description }}</textarea>

            <button class="bg-blue-500 text-white px-3 py-1 rounded">
                Modifier
            </button>
        </form>

    </div>
</x-app-layout>