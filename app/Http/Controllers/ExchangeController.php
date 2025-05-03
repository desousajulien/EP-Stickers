<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function sendEmail(Request $request)
    {
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to($request->to)
                ->subject('Demande d\'échange de stickers Europa-Park')
                ->from(Auth::user()->email, Auth::user()->name);
        });

        return response()->json(['success' => true]);
    }
}
