<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if Dummy gateway exists
        $dummyGateway = DB::table('payment_gateways')->where('name', 'Dummy')->first();

        if (!$dummyGateway) {
            DB::table('payment_gateways')->insert([
                'provider_name' => 'Dummy/Test Gateway',
                'provider_url' => 'none',
                'is_on_site' => 1,
                'can_refund' => 1,
                'name' => 'Dummy',
                'default' => 0,
                'admin_blade_template' => '',
                'checkout_blade_template' => 'Public.ViewEvent.Partials.Dummy',
            ]);
        }

        // Check if Stripe gateway exists
        $stripeGateway = DB::table('payment_gateways')->where('name', 'Stripe')->first();

        if (!$stripeGateway) {
            DB::table('payment_gateways')->insert([
                'name' => 'Stripe',
                'provider_name' => 'Stripe',
                'provider_url' => 'https://www.stripe.com',
                'is_on_site' => 1,
                'can_refund' => 1,
                'default' => 0,
                'admin_blade_template' => 'ManageAccount.Partials.Stripe',
                'checkout_blade_template' => 'Public.ViewEvent.Partials.PaymentStripe',
            ]);
        }

        // Check if Stripe PaymentIntents gateway exists
        $stripePaymentIntents = DB::table('payment_gateways')->where('name', 'Stripe\PaymentIntents')->first();

        if (!$stripePaymentIntents) {
            DB::table('payment_gateways')->insert([
                'provider_name' => 'Stripe SCA',
                'provider_url' => 'https://www.stripe.com',
                'is_on_site' => 0,
                'can_refund' => 1,
                'name' => 'Stripe\PaymentIntents',
                'default' => 0,
                'admin_blade_template' => 'ManageAccount.Partials.StripeSCA',
                'checkout_blade_template' => 'Public.ViewEvent.Partials.PaymentStripeSCA',
            ]);
        }

        // Check if Omniware gateway exists
        $omniwareGateway = DB::table('payment_gateways')->where('name', 'Omniware')->first();

        if (!$omniwareGateway) {
            DB::table('payment_gateways')->insert([
                'name' => 'Omniware',
                'provider_name' => 'Omniware',
                'provider_url' => 'https://omniware.in/',
                'is_on_site' => 1,
                'can_refund' => 1,
                'default' => 0,
                'admin_blade_template' => '',
                'checkout_blade_template' => 'Public.ViewEvent.Partials.PaymentOmniware',
            ]);
        }
    }
}
