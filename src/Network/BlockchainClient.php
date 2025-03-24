<?php

namespace BitcoinSdk\Network;

class BlockchainClient
{
    private $apiUrl;
    private $apiKey;
    
    /**
     * Create a new blockchain client
     * 
     * @param string $apiUrl Base URL for the blockchain API
     * @param string $apiKey Optional API key for the blockchain service
     */
    public function __construct(string $apiUrl, string $apiKey = null)
    {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->apiKey = $apiKey;
    }
    
    /**
     * Fetch the balance for a Bitcoin address
     * 
     * @param string $address The Bitcoin address
     * @return array Balance information
     */
    public function fetchAddressBalance(string $address): array
    {
        $endpoint = "/address/{$address}/balance";
        $response = $this->makeRequest('GET', $endpoint);
        
        return [
            'address' => $address,
            'confirmed' => $response['confirmed'] ?? 0,
            'unconfirmed' => $response['unconfirmed'] ?? 0,
            'total' => $response['total'] ?? 0,
            'timestamp' => time()
        ];
    }
    
    /**
     * Fetch transactions for a Bitcoin address
     * 
     * @param string $address The Bitcoin address
     * @param int $limit Maximum number of transactions
     * @param int $offset Pagination offset
     * @return array Transaction data
     */
    public function fetchAddressTransactions(string $address, int $limit = 10, int $offset = 0): array
    {
        $endpoint = "/address/{$address}/transactions?limit={$limit}&offset={$offset}";
        return $this->makeRequest('GET', $endpoint);
    }
    
    /**
     * Register a webhook for address monitoring
     * 
     * @param string $address The Bitcoin address to monitor
     * @param string $callbackUrl The URL to call when activity is detected
     * @return bool Success status
     */
    public function registerAddressWebhook(string $address, string $callbackUrl): bool
    {
        $endpoint = "/webhooks/address";
        $data = [
            'address' => $address,
            'url' => $callbackUrl
        ];
        
        $response = $this->makeRequest('POST', $endpoint, $data);
        return isset($response['id']);
    }
    
    /**
     * Make an HTTP request to the blockchain API
     * 
     * @param string $method HTTP method
     * @param string $endpoint API endpoint
     * @param array $data Optional data for POST requests
     * @return array Response data
     */
    private function makeRequest(string $method, string $endpoint, array $data = null): array
    {
        // In a real implementation, this would use cURL or Guzzle to make HTTP requests
        // This is a simplified placeholder that returns mock data
        
        if ($endpoint === '/address/bc1test/balance') {
            return [
                'confirmed' => 1250000,
                'unconfirmed' => 0,
                'total' => 1250000
            ];
        }
        
        return ['status' => 'success', 'id' => 'webhook_123'];
    }
}