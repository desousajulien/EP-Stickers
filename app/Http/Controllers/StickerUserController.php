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

        // Mes stickers en double (state_id = 3)
        $myDoubles = StickerUser::where('user_id', $currentUserId)
            ->where('state_id', 3)
            ->with('sticker')
            ->get();

        // Numéros des stickers que je n'ai pas
        $myMissingNumbers = StickerUser::where('user_id', $currentUserId)
            ->where('state_id', 1)
            ->join('stickers', 'stickers.id', '=', 'user_stickers.sticker_id')
            ->pluck('stickers.number')
            ->toArray();

        // Stickers en double chez d'autres utilisateurs que je n'ai pas
        $potentialTrades = StickerUser::where('state_id', 3)
            ->where('user_id', '!=', $currentUserId)
            ->join('stickers', 'stickers.id', '=', 'user_stickers.sticker_id')
            ->whereIn('stickers.number', $myMissingNumbers)
            ->with(['sticker', 'user'])
            ->get();

        // Indexer mes doubles par leur numéro
        $myDoublesByNumber = $myDoubles->keyBy(function ($item) {
            return $item->sticker->number;
        });

        $groupedSuggestions = [];

        foreach ($potentialTrades as $stickerFromOtherUser) {
            $otherUser = $stickerFromOtherUser->user;
            $otherUserId = $otherUser->id;

            if (!isset($groupedSuggestions[$otherUserId])) {
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
            $otherMissingNumbers = StickerUser::where('user_id', $userId)
                ->where('state_id', 1)
                ->join('stickers', 'stickers.id', '=', 'user_stickers.sticker_id')
                ->pluck('stickers.number')
                ->toArray();

            $iCanGive = $myDoubles->filter(function ($item) use ($otherMissingNumbers) {
                return in_array($item->sticker->number, $otherMissingNumbers);
            });

            $suggestion['iCanGive'] = $iCanGive->values();
        }

        $exchangeSuggestions = array_values($groupedSuggestions);

        return view('exchanges', compact('exchangeSuggestions'));
    }
}
