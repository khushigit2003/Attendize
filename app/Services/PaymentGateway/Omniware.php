<?php
namespace Services\PaymentGateway;

use App\Models\Order;
use Exception;
use Illuminate\Encryption\Encrypter;
use App\Helpers\hash_helper;
use Illuminate\Support\Facades\Log;

class Omniware
{
    CONST GATEWAY_NAME = 'Omniware';
    private $gateway;
    private $encryptionKey;
    private $decryptionKey;
    private $salt;
    private $transaction_data;
    private $transactionReference;
    private $status;
    private $message;

    private $omniwareConfig;

    public function __construct($gateway)
    {
        $this->gateway = $gateway;
        $this->api_key = config('services.omniware.api_key');
        $this->encryptionKey = config('services.omniware.encryption_key');
        $this->decryptionKey = config('services.omniware.decryption_key');
        $this->salt = config('services.omniware.salt');
    }

    public function startTransaction($order_total, $order_email, $event)
    {
        // Create transaction data
        $this->createTransactionData($order_total, $order_email, $event);
        $transaction = $this->gateway->purchase($this->transaction_data);
        $response = $transaction->send();
        return $response;
    }

    private function createTransactionData($order_total, $order_email, $event): array
    {
        $token = uniqid();
        $this->transaction_data = [
            'amount' => $order_total,
            'currency' => $event->currency->code,
            'description' => 'Order for customer: ' . $order_email,
            'name' => $event->organiser->name,
            'email' => $order_email,
            'phone' => $event->organiser->phone,
            'return_url' => '',
        ];
        return $this->transaction_data;
    }

    public function getTransactionData() {
        return $this->transaction_data;
    }

    function encryptData($plain_data, $encryption_key)
    {
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($plain_data, "AES-256-CBC", $encryption_key,
    OPENSSL_RAW_DATA, $iv);
return [
    'encrypted_data' => base64_encode($encrypted),
    'iv' => base64_encode($iv),
        ];
}
    function decryptData($encrypted_data,$iv, $decryption_key)
    {
        return openssl_decrypt(base64_decode($encrypted_data), 'AES-256-CBC',
            $decryption_key, OPENSSL_RAW_DATA, base64_decode($iv));
    }

    public function extractRequestParameters($requestData)
    {
        $this->parameters = [
            'api_key' => $this->gateway['api_key'],
            'order_id' => $requestData['order_id'] ?? null,
            'amount' => $requestData['amount'] ?? null,
            'currency' => $requestData['currency'] ?? null,
            'description' => $requestData['description'] ?? null,
            'name' => $requestData['name'] ?? null,
            'email' => $requestData['email'] ?? null,
            'phone' => $requestData['phone'] ?? null,
            'return_url' => $requestData['return_url'] ?? null,
        ];
        return $this;
    }

    public static function generateHashKey($parameters, $salt, $hashing_method = 'sha512')
    {
        $secure_hash = null;
        ksort($parameters);
        $hash_data = $salt;
        foreach ($parameters as $key => $value) {
            if (strlen($value) > 0) {
                $hash_data .= '|' . trim($value);
            }
        }
        if (strlen($hash_data) > 0) {
            $secure_hash = strtoupper(hash($hashing_method, $hash_data));
        }
        return $secure_hash;
    }


    public function responseHashCheck($salt, $response_array)
    {
        /* If hash field is null no need to check hash for such response */
        if (is_null($response_array['hash'])) {
            return true;
        }
        $response_hash = $response_array['hash'];
        unset($response_array['hash']);
        /* Now we have response json without the hash */
        $calculated_hash = $this->hashCalculate($salt, $response_array);
        return ($response_hash == $calculated_hash) ? true : false;
    }

    private function hashCalculate($salt, $input)
    {
        /* Columns used for hash calculation, Do not add or remove values from $hash_columns
        array */
        $hash_columns = array_keys($input);
        /*Sort the array before hashing*/
        sort($hash_columns);
        /*Create a | (pipe) separated string of all the $input values which are available
        in $hash_columns*/
        $hash_data = $salt;
        foreach ($hash_columns as $column) {
            if (isset($input[$column])) {
                if (strlen($input[$column]) > 0) {
                    $hash_data .= '|' . trim($input[$column]);
                }
            }
        }
        $hash = strtoupper(hash("sha512", $hash_data));
        return $hash;
    }
}
