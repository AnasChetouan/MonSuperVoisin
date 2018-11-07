<?php
class Security {
    
    private static $seed = '4id5234p1y';

    static public function getSeed() {
        return self::$seed;
    }
    
    public static function chiffrer($texte_en_clair) {
        
        $texte_chiffre = hash('sha256', $texte_en_clair.static::$seed);
        return $texte_chiffre;
    }
    
   static function generateRandomHex() {
      // Generate a 32 digits hexadecimal number
      $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
      $bytes = openssl_random_pseudo_bytes($numbytes); 
      $hex   = bin2hex($bytes);
      return $hex;
    }
}
