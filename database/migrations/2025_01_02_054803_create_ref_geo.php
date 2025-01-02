<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'ref_province',
            function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('code')->nullable()->unique();
                $table->unsignedBigInteger('created_by')->index()->nullable();
                $table->unsignedBigInteger('updated_by')->index()->nullable();
                $table->timestampTz('created_at')->nullable();
                $table->timestampTz('updated_at')->nullable();

                $table->foreign('created_by')->references('id')->on('sys_users');
                $table->foreign('updated_by')->references('id')->on('sys_users');
            }
        );

        Schema::create(
            'ref_city',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('province_id')->index();
                $table->string('name');
                $table->string('code')->nullable();
                $table->unsignedBigInteger('created_by')->index()->nullable();
                $table->unsignedBigInteger('updated_by')->index()->nullable();
                $table->timestampTz('created_at')->nullable();
                $table->timestampTz('updated_at')->nullable();

                $table->foreign('province_id')->references('id')->on('ref_province');
                $table->foreign('created_by')->references('id')->on('sys_users');
                $table->foreign('updated_by')->references('id')->on('sys_users');
            }
        );

        Schema::create(
            'ref_district',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('city_id')->index();
                $table->string('name');
                $table->string('code')->nullable();
                $table->unsignedBigInteger('created_by')->index()->nullable();
                $table->unsignedBigInteger('updated_by')->index()->nullable();
                $table->timestampTz('created_at')->nullable();
                $table->timestampTz('updated_at')->nullable();

                $table->foreign('city_id')->references('id')->on('ref_city');
                $table->foreign('created_by')->references('id')->on('sys_users');
                $table->foreign('updated_by')->references('id')->on('sys_users');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('ref_district');
        Schema::drop('ref_city');
        Schema::drop('ref_province');
    }
};
