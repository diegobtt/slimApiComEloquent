<?php

namespace app\migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class TimeMigrations {

    public function up (){
        Capsule::schema()->create('times', function($table) {
            $table->increments("id"); // unsigned integer automaticamente
            $table->string("nome");
            $table->string("estado");
            $table->timestamps();
        });
    }

    public function down (){
        Capsule::schema()->drop("times");
    }
}