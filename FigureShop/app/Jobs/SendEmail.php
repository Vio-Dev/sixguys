<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected $data;
    protected $users;


    /**
     * Create a new job instance.
     */
    public function __construct($data, $users)
    {
        $this->data = $data;
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // foreach ($this->users as $user) {
        //     Mail::to($user->email)->send(new MailNotify($this->data));
        // }
    }
}
