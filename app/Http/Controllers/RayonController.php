<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Récupérer tous les rayons
     */

     /**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Créer un nouveau compte utilisateur",
 *     tags={"Authentification"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123")
 *         ),
 *     ),
 *     @OA\Response(response=201, description="Compte créé avec succès"),
 *     @OA\Response(response=400, description="Erreur de validation"),
 * )
 */
    public function index()
    {
        $rayons = Rayon::all();
        return response()->json($rayons);
    }

    /**
     * Ajouter un nouveau rayon
     */

     /**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Créer un nouveau compte utilisateur",
 *     tags={"Authentification"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123")
 *         ),
 *     ),
 *     @OA\Response(response=201, description="Compte créé avec succès"),
 *     @OA\Response(response=400, description="Erreur de validation"),
 * )
 */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon = Rayon::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return response()->json($rayon, 201);
    }

    /**
     * Modifier un rayon existant
     */

     /**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Créer un nouveau compte utilisateur",
 *     tags={"Authentification"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123")
 *         ),
 *     ),
 *     @OA\Response(response=201, description="Compte créé avec succès"),
 *     @OA\Response(response=400, description="Erreur de validation"),
 * )
 */
    public function update(Request $request, $id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon->update($request->only(['nom', 'description']));

        return response()->json($rayon);
    }

    /**
     * Supprimer un rayon
     */
    /**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Créer un nouveau compte utilisateur",
 *     tags={"Authentification"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123")
 *         ),
 *     ),
 *     @OA\Response(response=201, description="Compte créé avec succès"),
 *     @OA\Response(response=400, description="Erreur de validation"),
 * )
 */
    public function destroy($id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $rayon->delete();

        return response()->json(['message' => 'Rayon supprimé avec succès']);
    }

    /**
     * Récupérer les produits d'un rayon spécifique
     */

     /**
 * @OA\Get(
 *     path="/rayons/{id}/produits",
 *     summary="Obtenir tous les produits d'un rayon",
 *     tags={"Rayons"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du rayon",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Liste des produits du rayon"),
 *     @OA\Response(response=404, description="Rayon non trouvé")
 * )
 */

    public function getProduitsParRayon($id)
    {
        $rayon = Rayon::find($id);

        if (!$rayon) {
            return response()->json(['message' => 'Rayon non trouvé'], 404);
        }

        $produits = Produit::where('rayon_id', $id)->get();

        return response()->json($produits);
    }
}
