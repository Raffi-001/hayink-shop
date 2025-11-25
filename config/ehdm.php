<?php

return [
    'base_url' => env('EHDM_BASE_URL', 'https://store.payx.am/api/'),

    'username' => env('EHDM_USERNAME'),
    'password' => env('EHDM_PASSWORD'),

    'endpoints' => [
        'login'               => 'Login/LoginUser',
        'print'               => 'Hdm/Print',
        'reverse'             => 'Hdm/Reverse',
        'reverse_by_receipt'  => 'Hdm/ReverseByReceiptId',
        'history_by_receipt'  => 'History/GetHistoryByReceiptId',
        'get_old_pdf'         => 'Hdm/GetOldReceiptPDF',
        'copy_by_unique'      => 'Hdm/PrintCopyByUniqueCode',
        'send_sms'            => 'Hdm/SendSms',
        'send_email'          => 'Hdm/SendEmail',
        'printed_history'     => 'History/GetPrintedReceiptsByPage',
        'returned_history'    => 'History/GetReturnedReceiptsByPage',
    ],
];
