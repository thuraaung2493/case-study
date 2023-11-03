<?php

use App\Enums\ApprovalStatus;
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
        Schema::create('loan_fields', function (Blueprint $table) {
            $table->id();
            $table->json('loan_info');
            $table->json('client_info');
            $table->json('personal_detail');
            $table->json('household_detail');
            $table->json('business_profile');
            $table->enum('approval_status', ApprovalStatus::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_fields');
    }
};
