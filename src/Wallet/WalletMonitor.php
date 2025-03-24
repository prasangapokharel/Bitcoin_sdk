<?php

namespace BitcoinSdk\Wallet;

use BitcoinSdk\Network\BlockchainClient;
use BitcoinSdk\Util\Validator;

class WalletMonitor
{
    private $blockchainClient;
    private $validator;

    public function __construct(BlockchainClient $blockchainClient, Validator $validator)
    {
        $this->blockchainClient = $blockchainClient;
        $this->validator = $validator;
    }

    /**
     * Get the current balance of a Bitcoin address
     * 
     * @param string $address The Bitcoin address to check
     * @return array Balance information including confirmed and unconfirmed balances
     * @throws \InvalidArgumentException If the address is invalid
     */
    public function getBalance(string $address): array
    {
        if (!$this->validator->isValidAddress($address)) {
            throw new \InvalidArgumentException("Invalid Bitcoin address: {$address}");
        }
        
        return $this->blockchainClient->fetchAddressBalance($address);
    }
    
    /**
     * Get transaction history for a Bitcoin address
     * 
     * @param string $address The Bitcoin address to check
     * @param int $limit Maximum number of transactions to return
     * @param int $offset Pagination offset
     * @return array Transaction history
     * @throws \InvalidArgumentException If the address is invalid
     */
    public function getTransactionHistory(string $address, int $limit = 10, int $offset = 0): array
    {
        if (!$this->validator->isValidAddress($address)) {
            throw new \InvalidArgumentException("Invalid Bitcoin address: {$address}");
        }
        
        return $this->blockchainClient->fetchAddressTransactions($address, $limit, $offset);
    }
    
    /**
     * Set up a webhook to monitor address activity
     * 
     * @param string $address The Bitcoin address to monitor
     * @param string $callbackUrl The URL to call when activity is detected
     * @return bool Success status
     */
    public function setupAddressMonitoring(string $address, string $callbackUrl): bool
    {
        if (!$this->validator->isValidAddress($address)) {
            throw new \InvalidArgumentException("Invalid Bitcoin address: {$address}");
        }
        
        return $this->blockchainClient->registerAddressWebhook($address, $callbackUrl);
    }
}