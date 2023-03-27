<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->unique();
            $table->string('icon')->nullable();
            $table->string('name');
            $table->text('description');
            $table->enum('service_type', ['static', 'dynamic']);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
         // Generate a unique service_id for each existing row in the subservices table
    $services = \App\Models\Service::all();
    foreach ($services as $service) {
        $service->service_id = str_replace('-', '', Str::uuid());
        $service->save();
    }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
