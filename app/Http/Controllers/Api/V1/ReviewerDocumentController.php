<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\V1\DocumentResource;
use App\Services\DocumentService;

class ReviewerDocumentController extends ApiController
{
    protected DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function indexAction()
    {
        $documents = $this->documentService->getDocumentList($this->getUser()->id);

        return $this->success(DocumentResource::collection($documents));
    }
}