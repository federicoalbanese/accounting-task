<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\DocumentStoreRequest;
use App\Http\Resources\V1\CustomerDocumentResource;
use App\Http\Resources\V1\DocumentResource;
use App\Jobs\CheckDocumentStatusChangedJob;
use App\Models\CustomerDocument;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;

class DocumentController extends ApiController
{
    protected DocumentService $documentService;

    /**
     * @param \App\Services\DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * @return JsonResponse
     */
    public function customerDocumentIndexAction()
    {
        $documents = $this->documentService->getDocumentList();

        return $this->success(CustomerDocumentResource::collection($documents));
    }

    /**
     * @param CustomerDocument $customerDocument
     *
     * @return JsonResponse
     */
    public function pickCustomerDocumentAction(CustomerDocument $customerDocument)
    {
        $customerDocument = $this->documentService->pick($customerDocument, $this->getUser()->id);
        CheckDocumentStatusChangedJob::dispatch($customerDocument)->delay(300);

        return $this->success(
            [
                'message' => __('document pick successfully'),
                'data' => new CustomerDocumentResource($customerDocument),
            ]);
    }

    /**
     * @param DocumentStoreRequest $storeRequest
     *
     * @return JsonResponse
     */
    public function storeAction(DocumentStoreRequest $storeRequest)
    {
        $parameters = [
            'name' => $storeRequest->get('name'),
            'priority' => $storeRequest->get('priority'),
            'user_id' => $this->getUser()->id,

        ];

        $document = $this->documentService->store($parameters);

        return $this->success(new DocumentResource($document));
    }
}