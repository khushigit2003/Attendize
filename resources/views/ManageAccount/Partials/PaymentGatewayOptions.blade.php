<script>
    $(function () {
        // Initially hide all payment gateway options
        $('.payment_gateway_options').hide();

        // Show default payment gateway's options on page load (if needed)
        $('#gateway_{{ $default_payment_gateway_id }}').show();

        // Handle radio button change event
        $('input[type=radio][name=payment_gateway]').on('change', function () {
            // Hide all payment gateway options
            $('.payment_gateway_options').hide();

            // Show the selected payment gateway's options
            $('#gateway_' + $(this).val()).fadeIn();

            // Log the selected payment gateway ID to console (for demonstration)
            console.log('Selected Payment Gateway ID:', $(this).val());
        });
    });
</script>



{!! Form::model($account, array('url' => route('postEditAccountPayment'), 'class' => 'ajax ')) !!}
<div class="form-group">
    {!! Form::label('payment_gateway_id', trans("ManageAccount.default_payment_gateway"), array('class'=>'control-label
    ')) !!}<br/>

    @foreach ($payment_gateways as $id => $payment_gateway)
    {!! Form::radio('payment_gateway', $payment_gateway['id'], $payment_gateway['default'],
    array('id'=>'payment_gateway_' . $payment_gateway['id'])) !!}
    {!! Form::label($payment_gateway['provider_name'],$payment_gateway['provider_name'] , array('class'=>'control-label
    gateway_selector')) !!}<br/>
    @endforeach
</div>

@foreach ($payment_gateways as $id => $payment_gateway)
@if(View::exists($payment_gateway['admin_blade_template']))
    @include($payment_gateway['admin_blade_template'])
@endif

@endforeach
<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            {!! Form::submit(trans("ManageAccount.save_payment_details_submit"), ['class' => 'btn btn-success
            pull-right']) !!}
        </div>
    </div>
</div>


{!! Form::close() !!}
