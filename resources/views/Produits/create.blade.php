@include('layouts.partials.navbar')
@section('content')
<div class="container">
    <h1>Ajouter un nouveau produit</h1>

    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du produit</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" id="prix" name="prix" class="form-control" value="{{ old('prix') }}" required min="0">
            @error('prix')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantité">Quantité</label>
            <input type="number" id="quantité" name="quantité" class="form-control" value="{{ old('quantité') }}" required min="1">
            @error('quantité')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>
@endsection
