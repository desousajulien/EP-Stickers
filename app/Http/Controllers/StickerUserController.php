<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StickerUser;

class StickerUserController extends Controller
{
    public function myStickers()
    {
        $stickers = StickerUser::where('user_id', auth()->id())
    ->with('sticker.category') // relation imbriquée
    ->with('state') // si tu utilises aussi la relation state
    ->get();


        $totalStickers = 156;

        $totalPosseded = StickerUser::where('user_id', auth()->id())
        ->where('state_id', '!=', 1)
        ->count();

        $tauxPosseded = round(($totalPosseded * 100) / $totalStickers);

        $totalMissing = $totalStickers - $totalPosseded;

        $tauxMissing = round(($totalMissing * 100) / $totalStickers);

        $totalDoubles = StickerUser::where('user_id', auth()->id())
        ->where('state_id', 3)
        ->count();

        $tauxDoubles = round(($totalDoubles * 100) / $totalStickers);

        // Retourner la vue avec les stickers
        return view('myStickers', [
            'stickers' => $stickers,
            'totalStickers' => $totalStickers,
            'totalPosseded' => $totalPosseded,
            'tauxPosseded' => $tauxPosseded,
            'totalMissing' => $totalMissing,
            'tauxMissing' => $tauxMissing,
            'totalDoubles' => $totalDoubles,
            'tauxDoubles' => $tauxDoubles,
        ]);
    }

    public function updateSticker(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'value' => 'required|integer',
        ]);

        $item = StickerUser::where('sticker_id', $request->id)
            ->where('user_id', auth()->id())
            ->first();

        $item->state_id = $request->value;
        $item->save();
    }

    public function findStickers()
    {
        $currentUserId = auth()->id();

    // Tes doubles (à toi)
    $myDoubles = StickerUser::where('user_id', $currentUserId)
        ->where('state_id', 3)
        ->with('sticker')
        ->get();

    // Les stickers que tu ne possèdes pas
    $myMissingIds = StickerUser::where('user_id', $currentUserId)
        ->where('state_id', 1)
        ->pluck('sticker_id')
        ->toArray();

    // Les stickers que d'autres possèdent en double et que tu n'as pas
    $potentialTrades = StickerUser::where('state_id', 3)
        ->where('user_id', '!=', $currentUserId)
        ->whereIn('sticker_id', $myMissingIds)
        ->with(['sticker', 'user'])
        ->get();

    // Indexer tes propres doubles par leur ID pour les rechercher rapidement
    $myDoublesMap = $myDoubles->keyBy('sticker_id');

    $groupedSuggestions = [];

foreach ($potentialTrades as $stickerFromOtherUser) {
    $otherUser = $stickerFromOtherUser->user;
    $otherUserId = $otherUser->id;

    if (!isset($groupedSuggestions[$otherUserId])) {
        // Initialisation si l'utilisateur n'existe pas encore dans le tableau
        $groupedSuggestions[$otherUserId] = [
            'other_user' => $otherUser,
            'theyCanGive' => [],
            'iCanGive' => [],
        ];
    }

    $groupedSuggestions[$otherUserId]['theyCanGive'][] = $stickerFromOtherUser;
}

// Associer les stickers que tu peux donner à chaque utilisateur
foreach ($groupedSuggestions as $userId => &$suggestion) {
    $otherMissing = StickerUser::where('user_id', $userId)
        ->where('state_id', 1)
        ->pluck('sticker_id')
        ->toArray();

    $iCanGive = $myDoubles->filter(function ($item) use ($otherMissing) {
        return in_array($item->sticker_id, $otherMissing);
    });

    $suggestion['iCanGive'] = $iCanGive->values();
}

$exchangeSuggestions = array_values($groupedSuggestions); // Réindexation propre

return view('exchanges', compact('exchangeSuggestions'));
    }
}
