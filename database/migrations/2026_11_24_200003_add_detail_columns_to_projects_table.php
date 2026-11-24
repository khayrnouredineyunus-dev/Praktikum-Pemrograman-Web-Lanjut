<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('judul');
            $table->foreignId('category_id')->nullable()->after('slug')->constrained()->nullOnDelete();
            $table->string('short_description')->nullable()->after('stack');
            $table->string('status')->default('draft')->after('deskripsi');
            $table->date('project_date')->nullable()->after('status');
            $table->boolean('is_featured')->default(false)->after('project_date');
            $table->string('repository_url')->nullable()->after('link');
        });

        // Project yang sudah ada sebelum migration ini diberi slug dan langsung
        // berstatus published, supaya tetap tampil di halaman /projects.
        DB::table('projects')->orderBy('id')->get()->each(function ($project) {
            $dasar = Str::slug($project->judul) ?: 'project';
            $slug = $dasar;

            $dipakai = DB::table('projects')
                ->where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists();

            if ($dipakai) {
                $slug = $dasar.'-'.$project->id;
            }

            DB::table('projects')->where('id', $project->id)->update([
                'slug'   => $slug,
                'status' => 'published',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropUnique(['slug']);
            $table->dropColumn([
                'slug',
                'category_id',
                'short_description',
                'status',
                'project_date',
                'is_featured',
                'repository_url',
            ]);
        });
    }
};
