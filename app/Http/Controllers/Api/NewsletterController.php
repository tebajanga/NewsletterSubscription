<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterRecipient;
use App\Events\NewsletterSubscribe;
use App\Events\NewsletterUnsubscribe;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $recipient = NewsletterRecipient::create([
            'email' => $request->email
        ]);

        NewsletterSubscribe::dispatch($request->email);

        return response()->json(['Subscribed'], 200);
    }

    public function unsubscribe(Request $request)
    {
        $recipient = NewsletterRecipient::where('email', $request->email)->first();
        if ($recipient) {
            $recipient->delete();
            NewsletterUnsubscribe::dispatch($request->email);

            return response()->json(['UnSubscribed'], 200);
        }
    }
}
