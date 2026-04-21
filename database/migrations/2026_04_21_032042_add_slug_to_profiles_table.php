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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('judul');
        });

        // Backfill slugs for existing records
        foreach (\App\Models\Profile::all() as $profile) {
            $slug = \Illuminate\Support\Str::slug($profile->judul);
            if ($slug === '') {
                $slug = 'profil';
            }
            $originalSlug = $slug;
            $counter = 1;
            while (\App\Models\Profile::where('slug', $slug)->where('id', '!=', $profile->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $profile->timestamps = false;
            $profile->update(['slug' => $slug]);
        }

        Schema::table('profiles', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
