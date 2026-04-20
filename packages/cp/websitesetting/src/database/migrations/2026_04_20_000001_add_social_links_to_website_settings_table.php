<?php

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
        Schema::table('website_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('website_settings', 'website_url')) {
                $table->string('website_url')->nullable()->after('footer_copyright');
            }

            if (!Schema::hasColumn('website_settings', 'instagram_url')) {
                $table->string('instagram_url')->nullable()->after('fb_url');
            }

            if (!Schema::hasColumn('website_settings', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable()->after('instagram_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            if (Schema::hasColumn('website_settings', 'linkedin_url')) {
                $table->dropColumn('linkedin_url');
            }
            if (Schema::hasColumn('website_settings', 'instagram_url')) {
                $table->dropColumn('instagram_url');
            }
            if (Schema::hasColumn('website_settings', 'website_url')) {
                $table->dropColumn('website_url');
            }
        });
    }
};

