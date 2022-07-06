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
        $this->validate($request, [
            'email' => 'required|email|unique:newsletter_recipients,email',
        ]);
        
        $recipient = NewsletterRecipient::create([
            'email' => $request->email
        ]);

        NewsletterSubscribe::dispatch($request->email);

        return response()->json('Thanks for signing up!', 200);
    }

    public function unsubscribe(Request $request)
    {
        $recipient = NewsletterRecipient::where('email', $request->email)->first();
        if ($recipient) {
            $recipient->delete();
            NewsletterUnsubscribe::dispatch($request->email);

            return response()->json('You have un-subscribed from the newsletter.', 200);
        } else {
            return response()->json('The email is not found.', 404);
        }
    }
}
