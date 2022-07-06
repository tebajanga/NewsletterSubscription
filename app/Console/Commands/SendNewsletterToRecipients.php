<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsletterRecipient;
use App\Events\SendNewsletter;

class SendNewsletterToRecipients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to recipients.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        NewsletterRecipient::whereNotNull('email')
            ->get()->each(function ($recipient) {
                SendNewsletter::dispatch($recipient->email);
            });
    }
}
