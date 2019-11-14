 <?php
    $method = 'aes-128-cbc';
    $encryption_key = openssl_random_pseudo_bytes(16);
    $ivlen = openssl_cipher_iv_length($method);
    $isCryptoStrong = false; // Will be set to true by the function if the algorithm used was cryptographically secure
    $iv = openssl_random_pseudo_bytes($ivlen, $isCryptoStrong);
    if(!$isCryptoStrong)
        throw new Exception("Non-cryptographically strong algorithm used for iv generation. This IV is not safe to use.");


    $key_and_iv = json_encode(array("key_hex"=>bin2hex($encryption_key),"iv_hex"=>bin2hex($iv)));



    ?>

<!DOCTYPE html>
<html>
<body>
<script src="qrcodejs-master/qrcode.js"></script>
<div id="qrcode">   </div>
<script type="text/javascript">


    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: <?php echo "'$key_and_iv'"; ?>,
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>




</body>
</html>


