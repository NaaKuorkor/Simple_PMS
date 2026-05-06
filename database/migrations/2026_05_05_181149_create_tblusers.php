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
        Schema::create('tblusers', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->unique();
            $table->string("first_name");
            $table->string("middle_names");
            $table->string("surname");
            $table->string("username")->unique();
            $table->string("password");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
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
        Schema::dropIfExists('tblusers');
    }
};
