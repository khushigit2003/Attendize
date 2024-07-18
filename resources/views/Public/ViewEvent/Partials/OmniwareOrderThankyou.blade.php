
    <div class="container">
        <h1>Thank You for Your Order!</h1>
        <p>Order ID: {{ $order->id }}</p>
        <p>Order Status: {{ $order->order_status_id }}</p>
        <p>Transaction ID: {{ $order->transaction_id }}</p>
        <p>Ticket Path: {{ $order->ticket_path_pdf }}</p>
        <p>Order Reference: {{ $order->order_reference }}</p>
    </div>
