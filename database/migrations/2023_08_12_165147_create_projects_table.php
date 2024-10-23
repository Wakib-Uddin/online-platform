<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->boolean('is_approved')->default(0);
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('member_id')->unique()->nullable();
            $table->string('member_name');
            $table->boolean('is_approved')->default(0);
            $table->timestamps();
        
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('projects');
    }
}

