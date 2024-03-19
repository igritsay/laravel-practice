<?php

use App\Models\Deal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchid\Attachment\Models\Attachment;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deal_document', function (Blueprint $table) {
            $table->unsignedBigInteger('deal_id');
            $table->unsignedInteger('attachment_id');

            $table->foreign('deal_id')
                ->references('id')
                ->on('new_deals')
                ->onDelete('cascade');

            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->onDelete('cascade');
        });

        Schema::create('deal_image', function (Blueprint $table) {
            $table->unsignedBigInteger('deal_id');
            $table->unsignedInteger('attachment_id');

            $table->foreign('deal_id')
                ->references('id')
                ->on('new_deals')
                ->cascadeOnDelete();

            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->cascadeOnDelete();
        });

        Schema::table('new_deals', function (Blueprint $table) {
            $table->unsignedInteger('thumbnail_id')->nullable();

            $table
                ->foreign('thumbnail_id')
                ->references('id')
                ->on('attachments')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('deal_document');
        Schema::drop('deal_image');
    }
};
