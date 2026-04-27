<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('page_items', function (Blueprint $table) {
            $table->unsignedInteger('drag_id')->default(0)->after('page_id');
        });

        $pageIds = DB::table('page_items')->distinct()->orderBy('page_id')->pluck('page_id');

        foreach ($pageIds as $pageId) {
            $items = DB::table('page_items')->where('page_id', $pageId)->orderBy('id')->get();
            foreach ($items as $index => $item) {
                DB::table('page_items')->where('id', $item->id)->update(['drag_id' => $index + 1]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_items', function (Blueprint $table) {
            $table->dropColumn('drag_id');
        });
    }
};
