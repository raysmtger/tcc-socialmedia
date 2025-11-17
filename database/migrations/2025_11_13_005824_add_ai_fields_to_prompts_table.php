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
        Schema::table('prompts', function (Blueprint $table) {
            // Só adiciona se NÃO existir
            if (!Schema::hasColumn('prompts', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('prompts', 'type')) {
                $table->enum('type', ['legenda', 'paleta', 'ideias', 'hashtags', 'cta'])->after('user_id');
            }
            
            if (!Schema::hasColumn('prompts', 'input_data')) {
                $table->json('input_data')->after('type');
            }
            
            if (!Schema::hasColumn('prompts', 'result')) {
                $table->text('result')->after('input_data');
            }
            
            if (!Schema::hasColumn('prompts', 'favorited')) {
                $table->boolean('favorited')->default(false)->after('result');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            // Verifica se existe antes de dropar
            if (Schema::hasColumn('prompts', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            
            if (Schema::hasColumn('prompts', 'type')) {
                $table->dropColumn('type');
            }
            
            if (Schema::hasColumn('prompts', 'input_data')) {
                $table->dropColumn('input_data');
            }
            
            if (Schema::hasColumn('prompts', 'result')) {
                $table->dropColumn('result');
            }
            
            if (Schema::hasColumn('prompts', 'favorited')) {
                $table->dropColumn('favorited');
            }
        });
    }
};