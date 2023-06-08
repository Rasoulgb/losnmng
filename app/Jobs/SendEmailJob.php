<?php

namespace App\Jobs;

use App\Mail\NewPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct(  $data)
    {
          $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Mail::to($this->data['to'])->send(new NewPostEmail($this->data));
    }
}
