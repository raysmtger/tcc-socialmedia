<?php

use App\Enums\OrganizerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //cascade garante que, se um usuário for deletado, suas ideias também serão.

            $table->string('titulo', 150);
            $table->text('descricao')->nullable();

            $table->string('nome_cliente', 120)->nullable();
            $table->date('prazo')->nullable();

            $table->string('status', 20)->default(OrganizerStatus::EM_ANDAMENTO->value); // coluna status até 20 caracteres definindo o valor do enum, define tb o status inicial de uma ideia
            $table->timestamps(); //quando foi criado e atualizado

            $table->index(['user_id', 'status']);
            $table->index('prazo');
            //facilita as consultas no banco
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
