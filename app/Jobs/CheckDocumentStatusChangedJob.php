<?php

namespace App\Jobs;

use App\Constants\DocumentConstant;
use App\Models\CustomerDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDocumentStatusChangedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\CustomerDocument
     */
    protected CustomerDocument $customerDocument;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CustomerDocument $customerDocument)
    {
        $this->customerDocument = $customerDocument;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->customerDocument->getStatus() === DocumentConstant::STATUS_INIT) {
            $this->customerDocument->setAssignedTo(null);
            $this->customerDocument->save();
        }
    }
}
