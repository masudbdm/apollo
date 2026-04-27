<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('website_settings', 'carousel_intro_title')) {
                $table->text('carousel_intro_title')->nullable()->after('slogan');
            }
            if (!Schema::hasColumn('website_settings', 'carousel_intro_text')) {
                $table->text('carousel_intro_text')->nullable()->after('carousel_intro_title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            if (Schema::hasColumn('website_settings', 'carousel_intro_text')) {
                $table->dropColumn('carousel_intro_text');
            }
            if (Schema::hasColumn('website_settings', 'carousel_intro_title')) {
                $table->dropColumn('carousel_intro_title');
            }
        });
    }
};
