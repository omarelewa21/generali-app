<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AvatarSelectionRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function saveButtonClick(Request $request)
    {
        $decision = $request->input('decision');
        
        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['PDPA'] = $decision;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);        
        
        return response()->json(['message' => 'Button click saved successfully']);
    }

    public function submit(Request $request)
    {
        // Fetch titles from the database
        $titles = DB::table('titles')->pluck('titles')->toArray();
    
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'title' => 'required|in:' . implode(',', $titles),
            'mobileNumber' => 'required|regex:/^[1-9]\d{8,9}$/',
            'housePhoneNumber' => 'nullable|regex:/^[1-9]\d{8,9}$/',
            'email' => 'required|email|max:255',
        ]);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['Title'] = $validatedData['title'];
        $arrayData['FirstName'] = $validatedData['firstName'];
        $arrayData['LastName'] = $validatedData['lastName'];
        $arrayData['MobileNumber'] = $validatedData['mobileNumber'];
        $arrayData['HousePhoneNumber'] = $validatedData['housePhoneNumber'];
        $arrayData['Email'] = $validatedData['email'];

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.welcome');
    }

    // public function identityData()
    // {
    //     $countries = [
    //         'AF' => 'Afghanistan',
    //         'AX' => 'Aland Islands',
    //         'AL' => 'Albania',
    //         'DZ' => 'Algeria',
    //         'AS' => 'American Samoa',
    //         'AD' => 'Andorra',
    //         'AO' => 'Angola',
    //         'AI' => 'Anguilla',
    //         'AQ' => 'Antarctica',
    //         'AG' => 'Antigua and Barbuda',
    //         'AR' => 'Argentina',
    //         'AM' => 'Armenia',
    //         'AW' => 'Aruba',
    //         'AU' => 'Australia',
    //         'AT' => 'Austria',
    //         'AZ' => 'Azerbaijan',
    //         'BS' => 'Bahamas',
    //         'BH' => 'Bahrain',
    //         'BD' => 'Bangladesh',
    //         'BB' => 'Barbados',
    //         'BY' => 'Belarus',
    //         'BE' => 'Belgium',
    //         'BZ' => 'Belize',
    //         'BJ' => 'Benin',
    //         'BM' => 'Bermuda',
    //         'BT' => 'Bhutan',
    //         'BO' => 'Bolivia',
    //         'BQ' => 'Bonaire, Sint Eustatius and Saba',
    //         'BA' => 'Bosnia and Herzegovina',
    //         'BW' => 'Botswana',
    //         'BV' => 'Bouvet Island',
    //         'BR' => 'Brazil',
    //         'IO' => 'British Indian Ocean Territory',
    //         'BN' => 'Brunei Darussalam',
    //         'BG' => 'Bulgaria',
    //         'BF' => 'Burkina Faso',
    //         'BI' => 'Burundi',
    //         'KH' => 'Cambodia',
    //         'CM' => 'Cameroon',
    //         'CA' => 'Canada',
    //         'CV' => 'Cape Verde',
    //         'KY' => 'Cayman Islands',
    //         'CF' => 'Central African Republic',
    //         'TD' => 'Chad',
    //         'CL' => 'Chile',
    //         'CN' => 'China',
    //         'CX' => 'Christmas Island',
    //         'CC' => 'Cocos (Keeling) Islands',
    //         'CO' => 'Colombia',
    //         'KM' => 'Comoros',
    //         'CG' => 'Congo',
    //         'CD' => 'Congo, Democratic Republic of the Congo',
    //         'CK' => 'Cook Islands',
    //         'CR' => 'Costa Rica',
    //         'CI' => 'Cote D\'Ivoire',
    //         'HR' => 'Croatia',
    //         'CU' => 'Cuba',
    //         'CW' => 'Curacao',
    //         'CY' => 'Cyprus',
    //         'CZ' => 'Czech Republic',
    //         'DK' => 'Denmark',
    //         'DJ' => 'Djibouti',
    //         'DM' => 'Dominica',
    //         'DO' => 'Dominican Republic',
    //         'EC' => 'Ecuador',
    //         'EG' => 'Egypt',
    //         'SV' => 'El Salvador',
    //         'GQ' => 'Equatorial Guinea',
    //         'ER' => 'Eritrea',
    //         'EE' => 'Estonia',
    //         'ET' => 'Ethiopia',
    //         'FK' => 'Falkland Islands (Malvinas)',
    //         'FO' => 'Faroe Islands',
    //         'FJ' => 'Fiji',
    //         'FI' => 'Finland',
    //         'FR' => 'France',
    //         'GF' => 'French Guiana',
    //         'PF' => 'French Polynesia',
    //         'TF' => 'French Southern Territories',
    //         'GA' => 'Gabon',
    //         'GM' => 'Gambia',
    //         'GE' => 'Georgia',
    //         'DE' => 'Germany',
    //         'GH' => 'Ghana',
    //         'GI' => 'Gibraltar',
    //         'GR' => 'Greece',
    //         'GL' => 'Greenland',
    //         'GD' => 'Grenada',
    //         'GP' => 'Guadeloupe',
    //         'GU' => 'Guam',
    //         'GT' => 'Guatemala',
    //         'GG' => 'Guernsey',
    //         'GN' => 'Guinea',
    //         'GW' => 'Guinea-Bissau',
    //         'GY' => 'Guyana',
    //         'HT' => 'Haiti',
    //         'HM' => 'Heard Island and Mcdonald Islands',
    //         'VA' => 'Holy See (Vatican City State)',
    //         'HN' => 'Honduras',
    //         'HK' => 'Hong Kong',
    //         'HU' => 'Hungary',
    //         'IS' => 'Iceland',
    //         'IN' => 'India',
    //         'ID' => 'Indonesia',
    //         'IR' => 'Iran, Islamic Republic of',
    //         'IQ' => 'Iraq',
    //         'IE' => 'Ireland',
    //         'IM' => 'Isle of Man',
    //         'IL' => 'Israel',
    //         'IT' => 'Italy',
    //         'JM' => 'Jamaica',
    //         'JP' => 'Japan',
    //         'JE' => 'Jersey',
    //         'JO' => 'Jordan',
    //         'KZ' => 'Kazakhstan',
    //         'KE' => 'Kenya',
    //         'KI' => 'Kiribati',
    //         'KP' => 'Korea, Democratic People\'s Republic of',
    //         'KR' => 'Korea, Republic of',
    //         'XK' => 'Kosovo',
    //         'KW' => 'Kuwait',
    //         'KG' => 'Kyrgyzstan',
    //         'LA' => 'Lao People\'s Democratic Republic',
    //         'LV' => 'Latvia',
    //         'LB' => 'Lebanon',
    //         'LS' => 'Lesotho',
    //         'LR' => 'Liberia',
    //         'LY' => 'Libyan Arab Jamahiriya',
    //         'LI' => 'Liechtenstein',
    //         'LT' => 'Lithuania',
    //         'LU' => 'Luxembourg',
    //         'MO' => 'Macao',
    //         'MK' => 'Macedonia, the Former Yugoslav Republic of',
    //         'MG' => 'Madagascar',
    //         'MW' => 'Malawi',
    //         'MY' => 'Malaysia',
    //         'MV' => 'Maldives',
    //         'ML' => 'Mali',
    //         'MT' => 'Malta',
    //         'MH' => 'Marshall Islands',
    //         'MQ' => 'Martinique',
    //         'MR' => 'Mauritania',
    //         'MU' => 'Mauritius',
    //         'YT' => 'Mayotte',
    //         'MX' => 'Mexico',
    //         'FM' => 'Micronesia, Federated States of',
    //         'MD' => 'Moldova, Republic of',
    //         'MC' => 'Monaco',
    //         'MN' => 'Mongolia',
    //         'ME' => 'Montenegro',
    //         'MS' => 'Montserrat',
    //         'MA' => 'Morocco',
    //         'MZ' => 'Mozambique',
    //         'MM' => 'Myanmar',
    //         'NA' => 'Namibia',
    //         'NR' => 'Nauru',
    //         'NP' => 'Nepal',
    //         'NL' => 'Netherlands',
    //         'AN' => 'Netherlands Antilles',
    //         'NC' => 'New Caledonia',
    //         'NZ' => 'New Zealand',
    //         'NI' => 'Nicaragua',
    //         'NE' => 'Niger',
    //         'NG' => 'Nigeria',
    //         'NU' => 'Niue',
    //         'NF' => 'Norfolk Island',
    //         'MP' => 'Northern Mariana Islands',
    //         'NO' => 'Norway',
    //         'OM' => 'Oman',
    //         'PK' => 'Pakistan',
    //         'PW' => 'Palau',
    //         'PS' => 'Palestinian Territory, Occupied',
    //         'PA' => 'Panama',
    //         'PG' => 'Papua New Guinea',
    //         'PY' => 'Paraguay',
    //         'PE' => 'Peru',
    //         'PH' => 'Philippines',
    //         'PN' => 'Pitcairn',
    //         'PL' => 'Poland',
    //         'PT' => 'Portugal',
    //         'PR' => 'Puerto Rico',
    //         'QA' => 'Qatar',
    //         'RE' => 'Reunion',
    //         'RO' => 'Romania',
    //         'RU' => 'Russian Federation',
    //         'RW' => 'Rwanda',
    //         'BL' => 'Saint Barthelemy',
    //         'SH' => 'Saint Helena',
    //         'KN' => 'Saint Kitts and Nevis',
    //         'LC' => 'Saint Lucia',
    //         'MF' => 'Saint Martin',
    //         'PM' => 'Saint Pierre and Miquelon',
    //         'VC' => 'Saint Vincent and the Grenadines',
    //         'WS' => 'Samoa',
    //         'SM' => 'San Marino',
    //         'ST' => 'Sao Tome and Principe',
    //         'SA' => 'Saudi Arabia',
    //         'SN' => 'Senegal',
    //         'RS' => 'Serbia',
    //         'CS' => 'Serbia and Montenegro',
    //         'SC' => 'Seychelles',
    //         'SL' => 'Sierra Leone',
    //         'SG' => 'Singapore',
    //         'SX' => 'Sint Maarten',
    //         'SK' => 'Slovakia',
    //         'SI' => 'Slovenia',
    //         'SB' => 'Solomon Islands',
    //         'SO' => 'Somalia',
    //         'ZA' => 'South Africa',
    //         'GS' => 'South Georgia and the South Sandwich Islands',
    //         'SS' => 'South Sudan',
    //         'ES' => 'Spain',
    //         'LK' => 'Sri Lanka',
    //         'SD' => 'Sudan',
    //         'SR' => 'Suriname',
    //         'SJ' => 'Svalbard and Jan Mayen',
    //         'SZ' => 'Swaziland',
    //         'SE' => 'Sweden',
    //         'CH' => 'Switzerland',
    //         'SY' => 'Syrian Arab Republic',
    //         'TW' => 'Taiwan, Province of China',
    //         'TJ' => 'Tajikistan',
    //         'TZ' => 'Tanzania, United Republic of',
    //         'TH' => 'Thailand',
    //         'TL' => 'Timor-Leste',
    //         'TG' => 'Togo',
    //         'TK' => 'Tokelau',
    //         'TO' => 'Tonga',
    //         'TT' => 'Trinidad and Tobago',
    //         'TN' => 'Tunisia',
    //         'TR' => 'Turkey',
    //         'TM' => 'Turkmenistan',
    //         'TC' => 'Turks and Caicos Islands',
    //         'TV' => 'Tuvalu',
    //         'UG' => 'Uganda',
    //         'UA' => 'Ukraine',
    //         'AE' => 'United Arab Emirates',
    //         'GB' => 'United Kingdom',
    //         'US' => 'United States',
    //         'UM' => 'United States Minor Outlying Islands',
    //         'UY' => 'Uruguay',
    //         'UZ' => 'Uzbekistan',
    //         'VU' => 'Vanuatu',
    //         'VE' => 'Venezuela',
    //         'VN' => 'Viet Nam',
    //         'VG' => 'Virgin Islands, British',
    //         'VI' => 'Virgin Islands, U.s.',
    //         'WF' => 'Wallis and Futuna',
    //         'EH' => 'Western Sahara',
    //         'YE' => 'Yemen',
    //         'ZM' => 'Zambia',
    //         'ZW' => 'Zimbabwe',
    //     ];  
        
    //     $xlsxFile = storage_path('app/occupation.xlsx');

    //     if (!file_exists($xlsxFile)) {
    //         abort(404, 'Excel file not found.');
    //     }

    //     $spreadsheet = IOFactory::load($xlsxFile);
    //     $worksheet = $spreadsheet->getActiveSheet();
    //     $rows = $worksheet->toArray();

    //     return view('pages/avatar/identity-details', compact('countries', 'rows'));
    // }

    public function submitIdentity(Request $request)
    {
        // Fetch titles from the database
        $countries = DB::table('countries')->pluck('countries')->toArray();

        $customMessages = [
            'idNumber.regex' => 'The id number field must match the format 123456-78-9012.',
            'passportNumber.max' => 'The passport number field must not exceed :max characters.',
            'birthCert.max' => 'The birth certificate field must not exceed :max characters.',
            'policeNumber.max' => 'The police number field must not exceed :max characters.',
            'registrationNumber.max' => 'The registration number field must not exceed :max characters.',
            'btnradio.required' => 'Please select your habits.',
        ];

        $validatedData = $request->validate([
            'country' => 'required|in:' . implode(',', $countries),
            'idType' => 'required|in:New IC,Passport,Birth Certificate,Police / Army,Registration',
            'idNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'regex:/^\d{6}-\d{2}-\d{4}$/',
            ],
            'passportNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'birthCert' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'policeNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'registrationNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber');
                }),
                'max:15',
            ],
            'btnradio' => 'required|in:smoker,nonSmoker',
        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['Country'] = $validatedData['country'];
        $arrayData['IdType'] = $validatedData['idType'];
        $arrayData['IdNumber'] = $validatedData['idNumber'];
        $arrayData['PassportNumber'] = $validatedData['passportNumber'];
        $arrayData['BirthCert'] = $validatedData['birthCert'];
        $arrayData['PoliceNumber'] = $validatedData['policeNumber'];
        $arrayData['RegistrationNumber'] = $validatedData['registrationNumber'];

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        Log::debug($arrayData);

        // // Process the form data and perform any necessary actions
        return redirect()->route('avatar.marital.status');
    }

    public function validateAvatar(Request $request)
    {
        $request->validate([
            'data-required' => 'required|in:selected',
        ]);

        return response()->json([
            'validationPassed' => true,
        ]);
    }
    public function handleAvatarSelection(Request $request)
    {
        // Get the selected avatar from the hidden input field
        $selectedMaritalStatus = $request->input('selectedAvatarInput');
        $dataUrl = $request->input('urlInput');
        $selectedFamilies = $request->input('selectedFamilies');
        Log::debug($request->all());
        Log::debug($selectedFamilies);

        // You can access the data for each entry like this:
        // foreach ($selectedFamilies as $family) {
        //     $key = $family['key'];
        //     $value = $family['value'];
        // }

        // Perform any additional actions based on the validation result.
        // For example, you can save the selection to the database.

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the value in the array
        if ($selectedMaritalStatus !== null) {
            // If not equal to null, then replace the data in $arrayData['maritalStatus']
            $arrayData['maritalStatus'] = $selectedMaritalStatus;
        }
        //$arrayData['families'] = $value;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Log the session data to the Laravel log file
        \Log::info('Session Data:', $arrayData);

        return redirect()->route($dataUrl);
    }
}
