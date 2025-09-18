<?php

namespace App\Enums;

enum Config
{
    case DEFAULT_PASSWORD;
    case PAGE_SIZE;
    case APP_NAME;
    case INSTITUTION_NAME;
    case INSTITUTION_ADDRESS;
    case INSTITUTION_PHONE;
    case INSTITUTION_EMAIL;
    case LANGUAGE;
    case PIC;
    case LETTER_HEAD;

    public function value(): string
    {
        return match ($this) {
            self::DEFAULT_PASSWORD => 'default_password',
            self::PAGE_SIZE => 'page_size',
            self::APP_NAME => 'app_name',
            self::INSTITUTION_NAME => 'institution_name',
            self::INSTITUTION_ADDRESS => 'institution_address',
            self::INSTITUTION_PHONE => 'institution_phone',
            self::INSTITUTION_EMAIL => 'institution_email',
            self::LANGUAGE => 'language',
            self::PIC => 'pic',
            self::LETTER_HEAD => '
                <meta charset="UTF-8">
                <meta name="viewport"
                    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        text-align: center;
                    }

                    h1 {
                        margin-bottom: 5px;
                    }

                    h4 {
                        margin-top: 0;
                        font-weight: normal;
                    }

                    table {
                        width: 100%;
                    }

                    table,
                    th,
                    td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }

                    th,
                    td {
                        padding: 10px;
                    }

                    #filter-section {
                        margin: 30px 0;
                        text-align: start;
                    }
                </style>
            ',
        };
    }
}
