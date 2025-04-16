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
        Schema::table('posts', function (Blueprint $table) {
            // Thêm cột mới
            // $table->string('status')->default('draft'); // draft, published
            // $table->string('image')->nullable(); // Đường dẫn ảnh
            $table->unsignedBigInteger('author_id')->nullable(); // Tác giả
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');

            // Sửa khóa ngoại category_id
            $table->dropForeign(['category_id']); // Xóa khóa ngoại cũ
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Thêm khóa ngoại mới

            // Đảm bảo summary nullable
            $table->text('summary')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Khôi phục thay đổi
            $table->dropColumn(['status', 'author_id']);
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->text('summary')->change();
        });
    }
};
