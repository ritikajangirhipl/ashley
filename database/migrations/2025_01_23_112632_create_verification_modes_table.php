<?Php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('verification_modes', function (Blueprint $table) {
            $table->id('ModeID'); // Primary key
            $table->string('name')->unique(); // Unique name
            $table->text('description'); // Description
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->timestamps(); // Created at and Updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('verification_modes');
    }
};
