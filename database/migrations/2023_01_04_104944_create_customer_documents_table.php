<?php

use App\Constants\DocumentConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_documents', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('assigned_to')->nullable();
            $table->enum('status', DocumentConstant::STATUSES)
                ->default(DocumentConstant::STATUS_INIT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_documents');
    }
};
