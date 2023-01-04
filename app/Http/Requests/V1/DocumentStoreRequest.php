<?php

namespace App\Http\Requests\V1;

use App\Constants\DocumentConstant;
use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $documentPriority = implode(',', DocumentConstant::PRIORITIES);

        return [
            'name' => 'required|string',
            'priority' => 'required|in:' . $documentPriority,
            'customer_document_id' => 'required|exists:customer_documents,id',
        ];
    }
}
