<?php

namespace App\Services;

use App\Constants\DocumentConstant;
use App\Models\CustomerDocument;
use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class DocumentService
{
    /**
     * @return Collection|array
     */
    public function getDocumentList(): Collection|array
    {
        return CustomerDocument::query()
            ->where('status', '=', DocumentConstant::STATUS_INIT)
            ->whereNull('assigned_to')
            ->get();
    }

    /**
     * @param CustomerDocument $customerDocument
     * @param int              $userId
     *
     * @return CustomerDocument
     */
    public function pick(CustomerDocument $customerDocument, int $userId): CustomerDocument
    {
        $customerDocument->setAssignedTo($userId);
        $customerDocument->save();

        return $customerDocument->refresh();
    }

    /**
     * @param array $parameters
     *
     * @return Document
     */
    public function store(array $parameters): Document
    {
        $document = new Document();

        $document->setName($parameters['name']);
        $document->setCreatedBy($parameters['user_id']);
        $document->setPriority($parameters['priority']);
        $document->save();

        return $document->refresh();
    }
}