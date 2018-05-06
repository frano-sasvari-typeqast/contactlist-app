<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 40);
            $table->string('lastname', 60);
            $table->string('email', 100)->unique();
            $table->string('upload_avatar', 100)->nullable();
            $table->unsignedTinyInteger('is_favorite')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE contact ADD FULLTEXT INDEX contact_fulltext (firstname, lastname)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
