<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Modifier patient</h2>

        <form action="{{ route('patients.update',$patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-200 text-red-800 p-3 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input name="nom" value="{{ $patient->nom }}" class="border p-2 block mb-2">
            <input name="prenom" value="{{ $patient->prenom }}" class="border p-2 block mb-2">
            <input type="date" name="date_naissance" value="{{ $patient->date_naissance }}" class="border p-2 block mb-2">
            <input name="telephone" value="{{ $patient->telephone }}" class="border p-2 block mb-2">
            <input name="adresse" value="{{ $patient->adresse }}" class="border p-2 block mb-2">

            <button class="bg-blue-500 text-white px-3 py-1 rounded">Modifier</button>
        </form>

    </div>
</x-app-layout>