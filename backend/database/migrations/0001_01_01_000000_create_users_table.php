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
      // Tabla de usuarios
         Schema::create('users', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier for the user');
            $table->timestamp('email_verified_at')
                  ->nullable()
                  ->comment('Email verification date');
            $table->string('password')
                  ->comment('User password');
            $table->rememberToken()
                  ->comment('Session token for remember me');
            $table->timestamps();
            $table->comment('Stores access credentials and their relation to the person');
        });
      // Tabla para recuperación de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->foreignId('user_id')
                  ->primary()
                  ->constrained('users')
                  ->name('pas_res_tok_user_id')
                  ->onDelete('cascade')
                  ->comment('(FK) User requesting password reset');
            $table->string('token')
                  ->comment('Password reset token');
            $table->timestamp('created_at')
                  ->nullable()
                  ->comment('Token creation date');
            $table->comment('Table that stores credential reset information');
        });
      // Tabla de sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')
                  ->primary()
                  ->comment('(PK) Session identifier');
            $table->foreignId('user_id')
                  ->nullable()
                  ->index()
                  ->name('ses_user_id')
                  ->comment('(FK) Identifier of the user to whom the session belongs');
            $table->string('ip_address', 45)
                  ->nullable()
                  ->comment('IP Address');
            $table->text('user_agent')
                  ->nullable()
                  ->comment('Browser/Client');
            $table->longText('payload')
                  ->comment('Session data');
            $table->integer('last_activity')
                  ->index()
                  ->comment('Last session activity');
            $table->comment('Table that stores user session information');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
