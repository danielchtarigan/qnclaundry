<?php
class SecuringData{
    
    function enkripsi($_unsecureData)
    {
        if(!$_unsecureData)
            return false;
        $_encryptData = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 'SECURE_STRING_1', $_unsecureData, MCRYPT_MODE_ECB, 'SECURE_STRING_2');
        return trim(base64_encode($_encryptData));
    }
    
    function dekripsi($_secureData)
    {
        if(!$_secureData) 
            return false; 
        $_encryptData = base64_decode($_secureData);
        $_decryptData = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 'SECURE_STRING_1', $_encryptData, MCRYPT_MODE_ECB, 'SECURE_STRING_2');
        return trim($_decryptData);
    }
}
