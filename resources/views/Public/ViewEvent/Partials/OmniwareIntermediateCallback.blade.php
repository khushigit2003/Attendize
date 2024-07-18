<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecting to Website</title>
</head>
<body onload="document.forms[0].submit();">
<h1>Re-directing Back to Website</h1>
<form id="omniwareCallbackForm" method="POST" action="{{ route('omniwarecallback', ['order_id' => $order_id]) }}">
    @csrf
    <input type="hidden" name="encrypted_data" value="{{ $encrypted_data }}">
    <input type="hidden" name="iv" value="{{ $iv }}">
</form>

</body>
</html>

