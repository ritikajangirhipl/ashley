<?Php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('CategoryID'); // Auto-incrementing primary key
            $table->string('name')->unique(); // Unique name
            $table->text('description'); // Memo/Text field
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status field
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
