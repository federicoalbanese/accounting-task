<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\DocumentConstant;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\V1\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;

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

    /**
     * @param Document $document
     *
     * @return JsonResponse
     */
    public function makeConfirmDocument(Document $document)
    {
        $user = $this->getUser();
        if ($this->documentNotConfirmed($document, $user->id)) {
            $this->documentService->confirmDocument($document, $user->id);

            return $this->success(
                [
                    'message' => __('document confirm successfully.'),
                ]
            );
        }

        return $this->error(
            [
                'message' => __('document already confirmed.'),
            ]
        );
    }

    private function documentNotConfirmed(Document $document, int $userId): bool
    {
        if (is_null($document->getAssignedTo()) && $document->getStatus() === DocumentConstant::STATUS_INIT) {
            return true;
        }

        return false;
    }
}