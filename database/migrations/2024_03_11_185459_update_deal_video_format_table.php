<?php

use App\Models\Deal;
use App\Models\VideoFormat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('deal_video_format', function (Blueprint $table) {
            $table->foreign('deal_id')->references('id')->on('new_deals')->onDelete('cascade');
            $table->foreign('video_format_id')->references('id')->on('video_formats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deal_video_format', function (Blueprint $table) {
            $table->dropForeign('deal_id');
            $table->dropForeign('video_format_id');
        });
    }
};
