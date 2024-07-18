<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmniwareOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('omniware_orders', function ($t) {
            $t->increments('id');
            $t->unsignedInteger('account_id')->index();
            $t->nullableTimestamps();
            $t->softDeletes();

            $t->string('first_name');
            $t->string('last_name');
            $t->string('email');

            $t->decimal('discount', 8, 2)->nullable();
            $t->decimal('booking_fee', 8, 2)->nullable();
            $t->decimal('organiser_booking_fee', 8, 2)->nullable();
            $t->date('order_date')->nullable();

            $t->text('notes')->nullable();
            $t->boolean('is_deleted')->default(0);
            $t->boolean('is_cancelled')->default(0);
            $t->boolean('is_partially_refunded')->default(0);
            $t->boolean('is_refunded')->default(0);

            $t->decimal('amount', 13, 2);

            $t->unsignedInteger('event_id')->index();
            $t->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $t->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');

            // Additional fields for business information
            $t->string('business_name');
            $t->string('business_tax_number');
            $t->string('business_address_line1');
            $t->string('business_address_line2')->nullable();
            $t->string('state');
            $t->string('city');
            $t->string('zip_code');

            // Field for order ID
            $t->string('order_id')->unique();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('omniware_orders');
    }
}
