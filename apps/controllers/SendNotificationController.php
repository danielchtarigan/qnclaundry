<?php
include_once 'controllers/EncryptUrlController.php';

class SendNotificationController {
    
    public function whatsapp_faktur($data)
    {
        $data = json_decode(json_encode($data));
        $phone = str_replace("0", "+62", substr($data->phone, 0,1)).substr($data->phone, 1);
        $priority = $data->priority;

        $enc = new EncryptUrlController;
        $key = "qwertyuioplkjhgfdsazxcvbnm";
        $struk = $enc->encrypt($data->faktur,$key);
        $urlf = "www.notalaundry.com/?id=".$struk;

        $headMessage = "QnCLaundry";
        $bodyMessage = "\\nNota Order Cucian Anda di QnC Laundry ".strip_tags($data->outlet)." telah kami terima dengan detail berikut:\\n";
        $bodyMessage .= "Nomor Faktur *".strip_tags($data->faktur)."*\\nNominal Transaksi Rp. ".strip_tags($data->amount)."\\n\\n";
        $bodyMessage .= "Update status cucian Anda secara real-time di ".strip_tags($urlf).". Anda juga bisa mengatur metode notifikasi melalui SMS, Whatsapp, atau e-mail\\n\\n";
        $footMessage = "*Penyimpanan kontak ini sangat disarankan supaya link di atas dapat diklik secara otomatis tanpa perlu disalin terlebih dahulu\\n";
        $footMessage = "Anda dapat juga membalas Whatsapp ini dan Customer Service kami siap melayani Anda.\\n";
        $footMessage .= "**Syarat dan ketentuan keluhan layanan QnC Laundry dapat dilihat di https://www.qnclaundry.net/complaint\\n";
        $footMessage .= "***Pesan ini dikirim secara otomatis";

        $message = strip_tags($headMessage).strip_tags($bodyMessage).strip_tags($footMessage);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassi.chat/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"phone":"'.$phone.'","message":"'.$message.'","priority":"'.$priority.'"}',
            CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "token: 1efd3adc842210cd487b0a328758f0509ece36cb8e1aa82b1909416ac4154a34bc4e86967d2e7126"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
}