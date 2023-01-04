<?php

namespace App\Services;

use App\Constants\DocumentConstant;
use App\Models\CustomerDocument;
use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class DocumentService
{
    /**
     * @return Collection|array
     */
    public function getCustomerDocumentList(): Collection|array
    {
        return CustomerDocument::query()
            ->where('status', '=', DocumentConstant::STATUS_INIT)
            ->whereNull('assigned_to')
            ->get();
    }

    /**
     * @param int $userId
     *
     * @return Collection|array
     */
    public function getDocumentList(int $userId): Collection|array
    {
        return Document::query()
            ->where('created_by', '!=', $userId)
            ->where('status', '=', DocumentConstant::STATUS_INIT)
            ->orderByRaw('FIELD(priority, \'' . implode("', '", DocumentConstant::PRIORITIES) . '\') asc')
            ->orderBy('created_at', 'DESC')
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

    /**
     * @param int $customerDocument
     *
     * @return void
     */
    public function makeConfirmedCustomerDocument(int $customerDocument): void
    {
        /** @var CustomerDocument $customerDocument */
        $customerDocument = CustomerDocument::query()
            ->where('id', '=', $customerDocument)
            ->first();

        $customerDocument->setStatus(DocumentConstant::STATUS_CONFIRMED);
        $customerDocument->save();
    }

    /**
     * @param Document $document
     * @param int      $userId
     *
     * @return void
     */
    public function confirmDocument(Document $document, int $userId): void
    {
        $document->setStatus(DocumentConstant::STATUS_CONFIRMED);
        $document->setAssignedTo($userId);
        $document->save();
    }
}