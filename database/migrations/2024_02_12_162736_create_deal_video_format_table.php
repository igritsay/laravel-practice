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
        Schema::create('deal_video_format', function (Blueprint $table) {
            $table->foreignIdFor(Deal::class);
            $table->foreignIdFor(VideoFormat::class);

//            $table->foreign('deal_id')->references('id')->on('new_deals');
//            $table->foreign('video_format_id')->references('id')->on('video_formats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_video_format');
    }
};
