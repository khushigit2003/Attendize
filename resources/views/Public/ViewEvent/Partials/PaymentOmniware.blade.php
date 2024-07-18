<!-- Other content -->
<form method="POST" action="{{ route('omniwareIntermediate', ['event_id' => $event->id]) }}">
    @csrf
    <input type="hidden" name="gateway" value="Omniware">
    <input type="hidden" name="order_id" value="{{ session('ticket_order_' . $event->id . '.order_id') }}">
    <input class="btn btn-lg btn-success card-submit" style="width:100%;" type="submit" value="@lang('Public_ViewEvent.complete_payment')">
</form>
