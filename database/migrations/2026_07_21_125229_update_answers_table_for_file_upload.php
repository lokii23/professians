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
        Schema::table('answers', function (Blueprint $table) {

            $table->string('student_answer')->nullable()->change();

            $table->string('upload_path')->nullable()->after('student_answer');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {

            $table->dropColumn('upload_path');

            $table->string('student_answer')->nullable(false)->change();

        });
    }
};
