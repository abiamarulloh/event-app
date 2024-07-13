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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('description');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');
            $table->string('location');
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('quota');
            $table->string('poster_image')->nullable();
            $table->string('link_registration')->nullable();
            $table->string('slug');
            $table->text('terms_and_conditions')->nullable();
            $table->text('speaker')->nullable();
            $table->text('agenda')->nullable();

            // $table->string('sponsorship_name')->nullable();
            // $table->string('sponsorship_image')->nullable();
            // $table->string('sponsorship_link')->nullable();
            // $table->string('sponsorship_description')->nullable();
            // $table->string('sponsorship_price')->nullable();
            // $table->string('sponsorship_quota')->nullable();
            
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
