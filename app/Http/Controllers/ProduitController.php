<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $produits = Produit::when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->paginate(10);

        return view('produits.index', compact('produits')); // Corrigé pour correspondre à la casse du dossier
    }

    public function create()
    {
        return view('produits.create'); // Corrigé pour correspondre à la casse du dossier
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:1',
            'description' => 'required|string|max:500',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('Produits.edit', compact('produit')); // Corrigé pour correspondre à la casse du dossier
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:1',
            'description' => 'required|string|max:500',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
