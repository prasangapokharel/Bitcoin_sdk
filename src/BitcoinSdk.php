<?php

namespace BitcoinSdk;

use BitcoinSdk\Address\AddressGenerator;
use BitcoinSdk\Wallet\WalletMonitor;
use BitcoinSdk\Crypto\KeyGenerator;
use BitcoinSdk\Network\BlockchainClient;
use BitcoinSdk\Util\Validator;

class BitcoinSdk
{
    private $addressGenerator;
    private $walletMonitor;
    private $keyGenerator;
    private $blockchainClient;
    private $validator;
    
    /**
     * Create a new Bitcoin SDK instance
     * 
     * @param string $apiUrl Base URL for the blockchain API
     * @param string $apiKey Optional API key for the blockchain service
     */
    public function __construct(string $apiUrl = 'https://api.blockchain.info', string $apiKey = null)
    {
        $this->validator = new Validator();
        $this->keyGenerator = new KeyGenerator();
        $this->blockchainClient = new BlockchainClient($apiUrl, $apiKey);
        $this->addressGenerator = new AddressGenerator($this->keyGenerator, $this->validator);
        $this->walletMonitor = new WalletMonitor($this->blockchainClient, $this->validator);
    }
    
    /**
     * Get the address generator component
     * 
     * @return AddressGenerator
     */
    public function address(): AddressGenerator
    {
        return $this->addressGenerator;
    }
    
    /**
     * Get the wallet monitor component
     * 
     * @return WalletMonitor
     */
    public function wallet(): WalletMonitor
    {
        return $this->walletMonitor;
    }
    
    /**
     * Get the key generator component
     * 
     * @return KeyGenerator
     */
    public function keys(): KeyGenerator
    {
        return $this->keyGenerator;
    }
    
    /**
     * Get the blockchain client component
     * 
     * @return BlockchainClient
     */
    public function network(): BlockchainClient
    {
        return $this->blockchainClient;
    }
}
