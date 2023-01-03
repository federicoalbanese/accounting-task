<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\DocumentConstant;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function(Blueprint $table) {
            $table->id();

            $table->enum('priority', DocumentConstant::PRIORITIES);
            $table->enum('status', DocumentConstant::STATUSES)
                ->default(DocumentConstant::STATUS_INIT);

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('assinged_to')->nullable()->constrained('users');

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
        Schema::dropIfExists('documents');
    }
};
