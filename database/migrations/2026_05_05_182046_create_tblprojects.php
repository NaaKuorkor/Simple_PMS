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
        Schema::create('tblprojects', function (Blueprint $table) {
            $table->id();
            $table->string("project_id")->unique();
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('tblusers');
            $table->string("project_title");
            $table->text("description");
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
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
        Schema::dropIfExists('tblprojects');
    }
};
