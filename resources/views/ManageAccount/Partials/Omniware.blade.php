<section class="payment_gateway_options" id="gateway_{{ $payment_gateway['id'] }}">
    <h4>@lang("ManageAccount.omniware_settings")</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('omniware_api_key', trans("ManageAccount.omniware_api_key"), ['class' => 'control-label']) !!}
                {!! Form::text('omniware_api_key', $account->getGatewayConfigVal($payment_gateway['id'], 'apiKey'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('encryption_key', trans("ManageAccount.encryption_key"), ['class' => 'control-label']) !!}
                {!! Form::text('encryption_key', $account->getGatewayConfigVal($payment_gateway['id'], 'encryptionKey'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('decryption_key', trans("ManageAccount.decryption_key"), ['class' => 'control-label']) !!}
                {!! Form::text('decryption_key', $account->getGatewayConfigVal($payment_gateway['id'], 'decryptionKey'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('my_salt', trans("ManageAccount.my_salt"), ['class' => 'control-label']) !!}
                {!! Form::text('my_salt', $account->getGatewayConfigVal($payment_gateway['id'], 'mySalt'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</section>
