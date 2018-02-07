<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
               'name' => '分享',
                'description' => '保持分享态度，是良好的学习过程.',
            ],
            [
                'name' => '教程',
                'description' => '关于某某的教程',
            ],
            [
                'name' => '问答',
                'description' => '不懂的小伙伴可以到这里来提问',
            ],
            [
                'name' => '公告',
                'description' => '本站的所有公告信息由此发出',
            ]
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
