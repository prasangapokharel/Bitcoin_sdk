<?php

namespace BitcoinSdk\Util;

class Validator
{
    /**
     * Check if a Bitcoin address is valid
     * 
     * @param string $address The Bitcoin address to validate
     * @return bool Whether the address is valid
     */
    public function isValidAddress(string $address): bool
    {
        // Check for legacy address format (P2PKH)
        if (preg_match('/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/', $address)) {
            return $this->validateChecksum($address);
        }
        
        // Check for Bech32 address format (P2WPKH)
        if (preg_match('/^bc1[ac-hj-np-z02-9]{39,59}$/', $address)) {
            return $this->validateBech32($address);
        }
        
        return false;
    }
    
    /**
     * Validate the checksum of a base58-encoded Bitcoin address
     * 
     * @param string $address The Bitcoin address to validate
     * @return bool Whether the checksum is valid
     */
    private function validateChecksum(string $address): bool
    {
        // In a real implementation, this would decode base58 and verify the checksum
        // This is a simplified placeholder
        return true;
    }
    
    /**
     * Validate a Bech32 Bitcoin address
     * 
     * @param string $address The Bitcoin address to validate
     * @return bool Whether the address is valid
     */
    private function validateBech32(string $address): bool
    {
        // In a real implementation, this would decode bech32 and verify the checksum
        // This is a simplified placeholder
        return true;
    }
    
    /**
     * Check if a private key is valid
     * 
     * @param string $privateKey The private key to validate
     * @return bool Whether the private key is valid
     */
    public function isValidPrivateKey(string $privateKey): bool
    {
        // Check if the private key is a valid hex string of the correct length
        if (!preg_match('/^[0-9a-f]{64}$/i', $privateKey)) {
            return false;
        }
        
        // Check if the private key is within the valid range for Bitcoin
        // This is a simplified implementation
        return true;
    }
}