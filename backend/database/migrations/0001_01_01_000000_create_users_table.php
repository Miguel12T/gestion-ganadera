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
                  ->comment('(PK) Identificador único del usuario');
            $table->timestamp('email_verified_at')
                  ->nullable()
                  ->comment('Fecha de verificación del correo');
            $table->string('password')
                  ->comment('Contraseña del usuario');
            $table->rememberToken()
                  ->comment('Token de sesión para recordar');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Tabla que almacena las credenciales de acceso y su relación con la persona');
        });
      // Tabla para recuperación de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->foreignId('user_id')
                  ->primary()
                  ->constrained('users')
                  ->name('pas_res_tok_user_id')
                  ->onDelete('cascade')
                  ->comment('(FK) Usuario que solicita el cambio');
            $table->string('token')
                  ->comment('Token de recuperación');
            $table->timestamp('created_at')
                  ->nullable()
                  ->comment('Fecha de creación del token');
            $table->comment('Tabla que almacena la informacion de restablecimiento de credenciales');
        });
      // Tabla de sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')
                  ->primary()
                  ->comment('(PK) Identificador de la sesión');
            $table->foreignId('user_id')
                  ->nullable()
                  ->index()
                  ->name('ses_user_id')
                  ->comment('(FK) Identificador del usuario al que pertenece la sesion');
            $table->string('ip_address', 45)
                  ->nullable()
                  ->comment('Dirección IP');
            $table->text('user_agent')
                  ->nullable()
                  ->comment('Navegador/cliente');
            $table->longText('payload')
                  ->comment('Datos de la sesión');
            $table->integer('last_activity')
                  ->index()
                  ->comment('Ultima actividad de la sesión');
            $table->comment('Tabla que almacena la informacion de las sesiones de usuario');
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
