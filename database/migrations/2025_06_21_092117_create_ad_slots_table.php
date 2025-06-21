<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ad_slots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('min_bid_price', 10, 2);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->enum('status', ['upcoming', 'open', 'closed', 'awarded'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad_slots');
    }
};
