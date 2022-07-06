<?php

namespace App\Listeners;

use App\Events\NewsletterSubscribe;
use App\Events\NewsletterUnsubscribe;
use App\Events\SendNewsletter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewsletterEmail;

class NewsletterEventSubscriber implements ShouldQueue
{
    /**
     * Handle newsletter subscribe events.
     */
    public function handleNewsletterSubscribe(NewsletterSubscribe $event) {
        \Mail::to($event->email)->send(
            new NewsletterEmail('You are subscribed to our newsletter')
        );
    }
 
    /**
     * Handle user newsletter unsubscribe events.
     */
    public function handleNewsletterUnsubscribe(NewsletterUnsubscribe $event) {
        \Mail::to($event->email)->send(
            new NewsletterEmail('You are un-subscribed to our newsletter')
        );
    }

    /**
     * Handle send newsletter events.
     */
    public function handleSendNewsletter(SendNewsletter $event) {
        \Mail::to($event->email)->send(
            new NewsletterEmail('Here is our newsletter')
        );
    }
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            NewsletterSubscribe::class,
            [NewsletterEventSubscriber::class, 'handleNewsletterSubscribe']
        );
 
        $events->listen(
            NewsletterUnsubscribe::class,
            [NewsletterEventSubscriber::class, 'handleNewsletterUnsubscribe']
        );

        $events->listen(
            SendNewsletter::class,
            [NewsletterEventSubscriber::class, 'handleSendNewsletter']
        );
    }
}
