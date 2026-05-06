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
        Schema::create('tbltasks', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->foreign('project_id')->references('project_id')->on('tblprojects');
            $table->string('task_desc');
            $table->enum('status', ['pending', 'completed', 'overdue']);
            $table->boolean('deleted')->default(0);
            $table->string('createuser');
            $table->timestamp('createdate')->useCurrent();
            $table->string('modifyuser');
            $table->timestamp('modifydate')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbltasks');
    }
};
