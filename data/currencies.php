<?php
/**
*   data/currencies.php
*
*   Holds and returns an ISO_4217 list of currencies + Bitcoin
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
$currencies = array(
    'AED' => array( 'name' => 'United Arab Emirates dirham', 'units' => 2, 'symbol' => 'د.إ' ),
    'AFN' => array( 'name' => 'Afghan afghani', 'units' => 2, 'symbol' => '؋' ),
    'ALL' => array( 'name' => 'Albanian lek', 'units' => 2, 'symbol' => 'L' ),
    'AMD' => array( 'name' => 'Armenian dram', 'units' => 2, 'symbol' => '֏' ),
    'ANG' => array( 'name' => 'Netherlands Antillean guilder', 'units' => 2, 'symbol' => 'ƒ' ),
    'AOA' => array( 'name' => 'Angolan kwanza', 'units' => 2, 'symbol' => 'Kz' ),
    'ARS' => array( 'name' => 'Argentine peso', 'units' => 2, 'symbol' => '$' ),
    'AUD' => array( 'name' => 'Australian dollar', 'units' => 2, 'symbol' => '$' ),
    'AWG' => array( 'name' => 'Aruban florin', 'units' => 2, 'symbol' => 'ƒ' ),
    'AZN' => array( 'name' => 'Azerbaijani manat', 'units' => 2, 'symbol' => '₼' ),
    'BAM' => array( 'name' => 'Bosnia and Herzegovina convertible mark', 'units' => 2, 'symbol' => 'KM or КМ[H]' ),
    'BBD' => array( 'name' => 'Barbados dollar', 'units' => 2, 'symbol' => '$' ),
    'BDT' => array( 'name' => 'Bangladeshi taka', 'units' => 2, 'symbol' => '৳' ),
    'BGN' => array( 'name' => 'Bulgarian lev', 'units' => 2, 'symbol' => 'лв' ),
    'BHD' => array( 'name' => 'Bahraini dinar', 'units' => 3, 'symbol' => '.د.ب' ),
    'BIF' => array( 'name' => 'Burundian franc', 'units' => 0, 'symbol' => 'Fr' ),
    'BMD' => array( 'name' => 'Bermudian dollar', 'units' => 2, 'symbol' => '$' ),
    'BND' => array( 'name' => 'Brunei dollar', 'units' => 2, 'symbol' => '$' ),
    'BOB' => array( 'name' => 'Boliviano', 'units' => 2, 'symbol' => 'Bs.' ),
    'BRL' => array( 'name' => 'Brazilian real', 'units' => 2, 'symbol' => 'R$' ),
    'BSD' => array( 'name' => 'Bahamian dollar', 'units' => 2, 'symbol' => '$' ),
    'BTN' => array( 'name' => 'Bhutanese ngultrum', 'units' => 2, 'symbol' => 'Nu.' ),
    'BWP' => array( 'name' => 'Botswana pula', 'units' => 2, 'symbol' => 'P' ),
    'BYN' => array( 'name' => 'Belarusian ruble', 'units' => 2, 'symbol' => 'Br' ),
    'BZD' => array( 'name' => 'Belize dollar', 'units' => 2, 'symbol' => '$' ),
    'CAD' => array( 'name' => 'Canadian dollar', 'units' => 2, 'symbol' => '$' ),
    'CDF' => array( 'name' => 'Congolese franc', 'units' => 2, 'symbol' => 'Fr' ),
    'CHF' => array( 'name' => 'Swiss franc', 'units' => 2, 'symbol' => 'Fr' ),
    'CLP' => array( 'name' => 'Chilean peso', 'units' => 0, 'symbol' => '$' ),
    'CNY' => array( 'name' => 'Chinese yuan', 'units' => 2, 'symbol' => '¥' ),
    'COP' => array( 'name' => 'Colombian peso', 'units' => 2, 'symbol' => '$' ),
    'CRC' => array( 'name' => 'Costa Rican colon', 'units' => 2, 'symbol' => '₡' ),
    'CUC' => array( 'name' => 'Cuban convertible peso', 'units' => 2, 'symbol' => '$' ),
    'CUP' => array( 'name' => 'Cuban peso', 'units' => 2, 'symbol' => '$' ),
    'CVE' => array( 'name' => 'Cape Verde escudo', 'units' => 0, 'symbol' => 'Esc or $' ),
    'CZK' => array( 'name' => 'Czech koruna', 'units' => 2, 'symbol' => 'Kč' ),
    'DJF' => array( 'name' => 'Djiboutian franc', 'units' => 0, 'symbol' => 'Fr' ),
    'DKK' => array( 'name' => 'Danish krone', 'units' => 2, 'symbol' => 'kr' ),
    'DOP' => array( 'name' => 'Dominican peso', 'units' => 2, 'symbol' => '$' ),
    'DZD' => array( 'name' => 'Algerian dinar', 'units' => 2, 'symbol' => 'د.ج' ),
    'EGP' => array( 'name' => 'Egyptian pound', 'units' => 2, 'symbol' => '£ or ج.م' ),
    'ERN' => array( 'name' => 'Eritrean nakfa', 'units' => 2, 'symbol' => 'Nfk' ),
    'ETB' => array( 'name' => 'Ethiopian birr', 'units' => 2, 'symbol' => 'Br' ),
    'EUR' => array( 'name' => 'Euro', 'units' => 2, 'symbol' => '€' ),
    'FJD' => array( 'name' => 'Fiji dollar', 'units' => 2, 'symbol' => '$' ),
    'FKP' => array( 'name' => 'Falkland Islands pound', 'units' => 2, 'symbol' => '£' ),
    'GBP' => array( 'name' => 'Pound sterling', 'units' => 2, 'symbol' => '£' ),
    'GEL' => array( 'name' => 'Georgian lari', 'units' => 2, 'symbol' => '₾' ),
    'GHS' => array( 'name' => 'Ghanaian cedi', 'units' => 2, 'symbol' => '₵' ),
    'GIP' => array( 'name' => 'Gibraltar pound', 'units' => 2, 'symbol' => '£' ),
    'GMD' => array( 'name' => 'Gambian dalasi', 'units' => 2, 'symbol' => 'D' ),
    'GNF' => array( 'name' => 'Guinean franc', 'units' => 0, 'symbol' => 'Fr' ),
    'GTQ' => array( 'name' => 'Guatemalan quetzal', 'units' => 2, 'symbol' => 'Q' ),
    'GYD' => array( 'name' => 'Guyanese dollar', 'units' => 2, 'symbol' => '$' ),
    'HKD' => array( 'name' => 'Hong Kong dollar', 'units' => 2, 'symbol' => '$' ),
    'HNL' => array( 'name' => 'Honduran lempira', 'units' => 2, 'symbol' => 'L' ),
    'HRK' => array( 'name' => 'Croatian kuna', 'units' => 2, 'symbol' => 'kn' ),
    'HTG' => array( 'name' => 'Haitian gourde', 'units' => 2, 'symbol' => 'G' ),
    'HUF' => array( 'name' => 'Hungarian forint', 'units' => 2, 'symbol' => 'Ft' ),
    'IDR' => array( 'name' => 'Indonesian rupiah', 'units' => 2, 'symbol' => 'Rp' ),
    'ILS' => array( 'name' => 'Israeli new shekel', 'units' => 2, 'symbol' => '₪' ),
    'INR' => array( 'name' => 'Indian rupee', 'units' => 2, 'symbol' => '₹' ),
    'IQD' => array( 'name' => 'Iraqi dinar', 'units' => 3, 'symbol' => 'ع.د' ),
    'IRR' => array( 'name' => 'Iranian rial', 'units' => 2, 'symbol' => '﷼' ),
    'ISK' => array( 'name' => 'Icelandic króna', 'units' => 0, 'symbol' => 'kr' ),
    'JMD' => array( 'name' => 'Jamaican dollar', 'units' => 2, 'symbol' => '$' ),
    'JOD' => array( 'name' => 'Jordanian dinar', 'units' => 3, 'symbol' => 'د.ا' ),
    'JPY' => array( 'name' => 'Japanese yen', 'units' => 0, 'symbol' => '¥' ),
    'KES' => array( 'name' => 'Kenyan shilling', 'units' => 2, 'symbol' => 'Sh' ),
    'KGS' => array( 'name' => 'Kyrgyzstani som', 'units' => 2, 'symbol' => 'с' ),
    'KHR' => array( 'name' => 'Cambodian riel', 'units' => 2, 'symbol' => '៛' ),
    'KMF' => array( 'name' => 'Comoro franc', 'units' => 0, 'symbol' => 'Fr' ),
    'KPW' => array( 'name' => 'North Korean won', 'units' => 2, 'symbol' => '₩' ),
    'KRW' => array( 'name' => 'South Korean won', 'units' => 0, 'symbol' => '₩' ),
    'KWD' => array( 'name' => 'Kuwaiti dinar', 'units' => 3, 'symbol' => 'د.ك' ),
    'KYD' => array( 'name' => 'Cayman Islands dollar', 'units' => 2, 'symbol' => '$' ),
    'KZT' => array( 'name' => 'Kazakhstani tenge', 'units' => 2, 'symbol' => '₸' ),
    'LAK' => array( 'name' => 'Lao kip', 'units' => 2, 'symbol' => '₭' ),
    'LBP' => array( 'name' => 'Lebanese pound', 'units' => 2, 'symbol' => 'ل.ل' ),
    'LKR' => array( 'name' => 'Sri Lankan rupee', 'units' => 2, 'symbol' => 'Rs රු or ரூ' ),
    'LRD' => array( 'name' => 'Liberian dollar', 'units' => 2, 'symbol' => '$' ),
    'LSL' => array( 'name' => 'Lesotho loti', 'units' => 2, 'symbol' => 'L' ),
    'LYD' => array( 'name' => 'Libyan dinar', 'units' => 3, 'symbol' => 'ل.د' ),
    'MAD' => array( 'name' => 'Moroccan dirham', 'units' => 2, 'symbol' => 'د.م.' ),
    'MDL' => array( 'name' => 'Moldovan leu', 'units' => 2, 'symbol' => 'L' ),
    'MGA' => array( 'name' => 'Malagasy ariary', 'units' => 1, 'symbol' => 'Ar' ),
    'MKD' => array( 'name' => 'Macedonian denar', 'units' => 2, 'symbol' => 'ден' ),
    'MMK' => array( 'name' => 'Myanmar kyat', 'units' => 2, 'symbol' => 'Ks' ),
    'MNT' => array( 'name' => 'Mongolian tögrög', 'units' => 2, 'symbol' => '₮' ),
    'MOP' => array( 'name' => 'Macanese pataca', 'units' => 2, 'symbol' => 'P' ),
    'MRU' => array( 'name' => 'Mauritanian ouguiya', 'units' => 1 ),
    'MUR' => array( 'name' => 'Mauritian rupee', 'units' => 2, 'symbol' => '₨' ),
    'MVR' => array( 'name' => 'Maldivian rufiyaa', 'units' => 2, 'symbol' => '.ރ' ),
    'MWK' => array( 'name' => 'Malawian kwacha', 'units' => 2, 'symbol' => 'MK' ),
    'MXN' => array( 'name' => 'Mexican peso', 'units' => 2, 'symbol' => '$' ),
    'MYR' => array( 'name' => 'Malaysian ringgit', 'units' => 2, 'symbol' => 'RM' ),
    'MZN' => array( 'name' => 'Mozambican metical', 'units' => 2, 'symbol' => 'MT' ),
    'NAD' => array( 'name' => 'Namibian dollar', 'units' => 2, 'symbol' => '$' ),
    'NGN' => array( 'name' => 'Nigerian naira', 'units' => 2, 'symbol' => '₦' ),
    'NIO' => array( 'name' => 'Nicaraguan córdoba', 'units' => 2, 'symbol' => 'C$' ),
    'NOK' => array( 'name' => 'Norwegian krone', 'units' => 2, 'symbol' => 'kr' ),
    'NPR' => array( 'name' => 'Nepalese rupee', 'units' => 2, 'symbol' => '₨' ),
    'NZD' => array( 'name' => 'New Zealand dollar', 'units' => 2, 'symbol' => '$' ),
    'OMR' => array( 'name' => 'Omani rial', 'units' => 3, 'symbol' => 'ر.ع.' ),
    'PAB' => array( 'name' => 'Panamanian balboa', 'units' => 2, 'symbol' => 'B/.' ),
    'PEN' => array( 'name' => 'Peruvian Sol', 'units' => 2, 'symbol' => 'S/.' ),
    'PGK' => array( 'name' => 'Papua New Guinean kina', 'units' => 2, 'symbol' => 'K' ),
    'PHP' => array( 'name' => 'Philippine piso', 'units' => 2, 'symbol' => '₱' ),
    'PKR' => array( 'name' => 'Pakistani rupee', 'units' => 2, 'symbol' => '₨' ),
    'PLN' => array( 'name' => 'Polish złoty', 'units' => 2, 'symbol' => 'zł' ),
    'PYG' => array( 'name' => 'Paraguayan guaraní', 'units' => 0, 'symbol' => '₲' ),
    'QAR' => array( 'name' => 'Qatari riyal', 'units' => 2, 'symbol' => 'ر.ق' ),
    'RON' => array( 'name' => 'Romanian leu', 'units' => 2, 'symbol' => 'lei' ),
    'RSD' => array( 'name' => 'Serbian dinar', 'units' => 2, 'symbol' => 'дин. or din.' ),
    'RUB' => array( 'name' => 'Russian ruble', 'units' => 2, 'symbol' => '₽' ),
    'RWF' => array( 'name' => 'Rwandan franc', 'units' => 0, 'symbol' => 'Fr' ),
    'SAR' => array( 'name' => 'Saudi riyal', 'units' => 2, 'symbol' => 'ر.س' ),
    'SBD' => array( 'name' => 'Solomon Islands dollar', 'units' => 2, 'symbol' => '$' ),
    'SCR' => array( 'name' => 'Seychelles rupee', 'units' => 2, 'symbol' => '₨' ),
    'SDG' => array( 'name' => 'Sudanese pound', 'units' => 2, 'symbol' => 'ج.س.' ),
    'SEK' => array( 'name' => 'Swedish kronakronor', 'units' => 2, 'symbol' => 'kr' ),
    'SGD' => array( 'name' => 'Singapore dollar', 'units' => 2, 'symbol' => '$' ),
    'SHP' => array( 'name' => 'Saint Helena pound', 'units' => 2, 'symbol' => '£' ),
    'SLL' => array( 'name' => 'Sierra Leonean leone', 'units' => 2, 'symbol' => 'Le' ),
    'SOS' => array( 'name' => 'Somali shilling', 'units' => 2, 'symbol' => 'Sh' ),
    'SRD' => array( 'name' => 'Surinamese dollar', 'units' => 2, 'symbol' => '$' ),
    'SSP' => array( 'name' => 'South Sudanese pound', 'units' => 2, 'symbol' => '£' ),
    'STN' => array( 'name' => 'São Tomé and Príncipe dobra', 'units' => 2 ),
    'SVC' => array( 'name' => 'Salvadoran colón', 'units' => 2 ),
    'SYP' => array( 'name' => 'Syrian pound', 'units' => 2, 'symbol' => '£ or ل.س' ),
    'SZL' => array( 'name' => 'Swazi lilangeni', 'units' => 2, 'symbol' => 'L' ),
    'THB' => array( 'name' => 'Thai baht', 'units' => 2, 'symbol' => '฿' ),
    'TJS' => array( 'name' => 'Tajikistani somoni', 'units' => 2, 'symbol' => 'ЅМ' ),
    'TMT' => array( 'name' => 'Turkmenistan manat', 'units' => 2, 'symbol' => 'm' ),
    'TND' => array( 'name' => 'Tunisian dinar', 'units' => 3, 'symbol' => 'د.ت' ),
    'TOP' => array( 'name' => 'Tongan paʻanga', 'units' => 2, 'symbol' => 'T$' ),
    'TRY' => array( 'name' => 'Turkish lira', 'units' => 2, 'symbol' => '₺' ),
    'TTD' => array( 'name' => 'Trinidad and Tobago dollar', 'units' => 2, 'symbol' => '$' ),
    'TWD' => array( 'name' => 'New Taiwan dollar', 'units' => 2, 'symbol' => '$' ),
    'TZS' => array( 'name' => 'Tanzanian shilling', 'units' => 2, 'symbol' => 'Sh' ),
    'UAH' => array( 'name' => 'Ukrainian hryvnia', 'units' => 2, 'symbol' => '₴' ),
    'UGX' => array( 'name' => 'Ugandan shilling', 'units' => 0, 'symbol' => 'Sh' ),
    'USD' => array( 'name' => 'United States dollar', 'units' => 2, 'symbol' => '$' ),
    'UYU' => array( 'name' => 'Uruguayan peso', 'units' => 2, 'symbol' => '$' ),
    'UZS' => array( 'name' => 'Uzbekistan som', 'units' => 2, 'symbol' => '' ),
    'VEF' => array( 'name' => 'Venezuelan bolívar', 'units' => 2, 'symbol' => 'Bs' ),
    'VND' => array( 'name' => 'Vietnamese đồng', 'units' => 0, 'symbol' => '₫' ),
    'VUV' => array( 'name' => 'Vanuatu vatu', 'units' => 0, 'symbol' => 'Vt' ),
    'WST' => array( 'name' => 'Samoan tala', 'units' => 2, 'symbol' => 'T' ),
    'XAF' => array( 'name' => 'CFA franc BEAC', 'units' => 0, 'symbol' => 'Fr' ),
    'XBT' => array( 'name' => 'Bitcoin', 'units' => 8, 'symbol' => '₿' ),
    'XCD' => array( 'name' => 'East Caribbean dollar', 'units' => 2, 'symbol' => '$' ),
    'XOF' => array( 'name' => 'CFA franc BCEAO', 'units' => 0, 'symbol' => 'Fr' ),
    'XPF' => array( 'name' => 'CFP franc(franc Pacifique)', 'units' => 0, 'symbol' => 'Fr' ),
    'YER' => array( 'name' => 'Yemeni rial', 'units' => 2, 'symbol' => '﷼' ),
    'ZAR' => array( 'name' => 'South African rand', 'units' => 2, 'symbol' => 'R' ),
    'ZMW' => array( 'name' => 'Zambian kwacha', 'units' => 2, 'symbol' => 'ZK' ),
    'ZWL' => array( 'name' => 'Zimbabwean dollar A/10', 'units' => 2 ),
);