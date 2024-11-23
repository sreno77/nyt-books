<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\RewardType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name', 100);
            $table->text('rules');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->enum('reward_type', RewardType::values())->default(RewardType::MONETARY);
            $table->integer('top_prize');
            $table->integer('num_winners');
            $table->integer('prize_step');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
