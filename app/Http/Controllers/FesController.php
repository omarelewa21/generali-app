<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\SessionStorage;

class FesController extends Controller
{
    public function sendFes(Request $request)
    {
       $fesId = $request->input('transaction_id');
       $fesData = SessionStorage::where('transaction_id',$fesId)->first();

        try {
            $client = new Client([
                'base_uri' => 'https://u1.gmlfes.com.my',
                'timeout' => 10.0,
                'debug'=> true
            ]);

            // $clientData = self::testSendingData;

            // Log::debug($this->testSendingData()[0]);

            $decodedData = json_decode($fesData, true);

            $parsingData = self::fesDataParsing($decodedData);

            Log::debug($fesId);
            Log::debug($fesData);

            // dd($this->testSendingData());

            // Send a request to https://u1.gmlfes.com.my/fna/customerDetails/1
            $response = $client->post('/fna/customerDetails/1', [
                'headers' => [
                    'X-FES-AUTH' => '10cc334a41b74b9a8a92f8c24b361d64d938cec7c3af4dae9530434d0493624c841f44eafdc740d99553291c7bc0d5a8',
                    'Content-Type' => 'application/json'
                ],
                'json' => $decodedData,
                'debug' => fopen('php://stderr','w')
            ]);

            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            $responseHeaders = $response->getHeaders();
        
            return $response->getBody()->getContents();
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            Log::error('Exception: ' . $e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }


    public function fesDataParsing($decodedData)
    {

        // convert data from cff format to fes format 



        $data = '{"customers": {
            "customerDetails": {
              "lastModifiedTime": "2023-12-27T11:18:43+05:30",
              "createdTime": "2023-12-27T11:18:43+05:30",
              "title": "Justice",
              "othersValue": "",
              "firstName": "Dr new",
              "lastName": "through API",
              "identityType": "New IC",
              "identityNo": "981023-32-2323",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "1998-10-23",
              "maritalStatus": "Single",
              "noOfKids": 0,
              "smokingStatus": "Non-Smoker",
              "relationship": "",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "Accounts Clerk",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "8787944400",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "1177888787",
              "educationLvl": "Diploma",
              "emailID": "DRD@gmail.com"
            }
          },
          "agentId": "T012",
          "spouseDetails": {
              "lastModifiedTime": "2023-11-30T14:18:15+08:00",
              "createdTime": "2023-11-30T14:18:15+08:00",
              "title": "Mrs",
              "othersValue": "",
              "firstName": "Wife",
              "lastName": "Partner",
              "identityType": "Passport",
              "identityNo": "X123245",
              "nationality": "Australian",
              "gender": "Female",
              "dateOfBirth": "1985-01-01",
              "maritalStatus": "",
              "noOfKids": 0,
              "smokingStatus": "Smoker",
              "relationship": "",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "Housewife",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": ""
            },
            "dependentDetails": [ {
              "lastModifiedTime": "2023-11-30T14:18:15+08:00",
              "createdTime": "2023-11-30T14:18:15+08:00",
              "title": "",
              "othersValue": "",
              "firstName": "Son aaa",
              "lastName": "One",
              "identityType": "New IC",
              "identityNo": "",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "2012-01-01",
              "maritalStatus": "Single",
              "noOfKids": 0,
              "smokingStatus": "",
              "relationship": "Parent",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "",
              "yearsToSupport": "10",
              "parentId": "<customerid>"
            },
            {
              "lastModifiedTime": "2023-11-30T14:18:15+08:00",
              "createdTime": "2023-11-30T14:18:15+08:00",
              "title": "",
              "othersValue": "",
              "firstName": "Son bbb",
              "lastName": "two",
              "identityType": "New IC",
              "identityNo": "",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "2012-01-01",
              "maritalStatus": "Single",
              "noOfKids": 0,
              "smokingStatus": "",
              "relationship": "Child",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "",
              "yearsToSupport": "10",
              "parentId": "<customerid>"
            },{
              "lastModifiedTime": "2023-11-30T14:18:15+08:00",
              "createdTime": "2023-11-30T14:18:15+08:00",
              "title": "",
              "othersValue": "",
              "firstName": "Son ccc",
              "lastName": "One",
              "identityType": "New IC",
              "identityNo": "",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "2012-01-01",
              "maritalStatus": "Single",
              "noOfKids": 0,
              "smokingStatus": "",
              "relationship": "Child",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "",
              "yearsToSupport": "10",
              "parentId": "<customerid>"
            },
             {
              "lastModifiedTime": "2023-11-30T16:33:25+08:00",
              "createdTime": "2023-11-30T16:33:25+08:00",
              "title": "",
              "othersValue": "",
              "firstName": "Son ddd",
              "lastName": "Dad aaaa",
              "identityType": "New IC",
              "identityNo": "",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "1960-04-03",
              "maritalStatus": "Divorced",
              "noOfKids": 0,
              "smokingStatus": "",
              "relationship": "Child",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "",
              "yearsToSupport": "6",
              "parentId": "<customerid>"
            },
             {
              "lastModifiedTime": "2023-11-30T16:33:25+08:00",
              "createdTime": "2023-11-30T16:33:25+08:00",
              "title": "",
              "othersValue": "",
              "firstName": "Grand bbbb",
              "lastName": "Dad bbbb",
              "identityType": "New IC",
              "identityNo": "",
              "nationality": "Malaysian",
              "gender": "Male",
              "dateOfBirth": "1960-04-03",
              "maritalStatus": "Divorced",
              "noOfKids": 0,
              "smokingStatus": "",
              "relationship": "Parent",
              "parentCustomerId": "",
              "monthlyIncome": "",
              "occupation": "",
              "agentId": "",
              "files": [],
              "email": "",
              "countryCode": "+60",
              "phoneNumber": "",
              "homeNumberCountryCode": "+60",
              "homePhoneNumber": "",
              "yearsToSupport": "6",
              "parentId": "<customerid>"
            }
             ],
           "riskProfile": {
            "riskProfileResult": "",
            "riskProfileScore": "",
            "riskProfilingQuestions": [],
            "selectedRiskProfile": "Medium Risk",
            "selectedReturnExpectation": "High Potential Return",
        "selectedNeeds": [
              {
                 "value": "N1",
                "priority": "1",
                "cover": "No",
                "discuss": "Yes",
                "advanceDetails": {
                  "coverFor": "Child",
                  "selectedInsuredName": "Son ddd Dad aaaa",
                  "othersCoverForName": "",
                  "othersCoverForDob": "",
                  "selectedCoverForDob": "2012-01-01",
                  "eventOfDeath": 10000,
                  "incomeProtected": "3",
                  "lifeInsurance": 120000,
                  "insuranceAmount": -90000,
                  "customerId": "<customerid>"
                }
              },
              {
                "value": "N2",
                "priority": "1",
                "cover": "",
                "discuss": "Yes",
                "advanceDetails": {
                  "coverFor": "Spouse",
                  "selectedInsuredName": "",
                  "othersCoverForName": "Wife Partner",
                  "othersCoverForDob": "1985-01-01",
                  "selectedCoverForDob": "",
                  "yearsOfRetirement": "5",
                  "annualAmountRetirement": 120000,
                  "yearsOfSupport": "7",
                  "existingIncome": 93000,
                  "otherSourceDuringRetirment": "Sales",
                  "oldAgeamountRetirement": 747000
                }
              },
              {
                "value": "N3",
                "priority": "2",
                "cover": "Yes",
                "discuss": "Yes",
                "advanceDetails": [
                  {
                    "coverFor": "Child",
                    "selectedInsuredName": "Son bbb two",
                    "othersCoverForName": "",
                    "othersCoverForDob": "",
                    "selectedCoverForDob": "2012-01-01",
                    "YearsOfEducation": "6",
                    "needForTertiaryAmount": 500000,
                    "existingEducationFund": 1000,
                    "shortfallTertiaryEducation": 499000,
                    "customerId": "<childid>"
                  },{
                    "coverFor": "Child",
                    "selectedInsuredName": "Son ddd Dad aaaa",
                    "othersCoverForName": "",
                    "othersCoverForDob": "",
                    "selectedCoverForDob": "2012-01-01",
                    "YearsOfEducation": "6",
                    "needForTertiaryAmount": 500000,
                    "existingEducationFund": 1000,
                    "shortfallTertiaryEducation": 499000,
                    "customerId": "<childid>"
                  }
                ]
              },
              {
                "value": "N4",
                "priority": "4",
                "cover": "Yes",
                "discuss": "No",
                "advanceDetails": {
                    "coverFor": "Spouse",
                  "selectedInsuredName": "",
                  "othersCoverForName": "Wife Partner",
                  "othersCoverForDob": "1985-01-01",
                  "selectedCoverForDob": "",
                  "investmentTimeInYears": "",
                  "expectedAnnualReturns": "",
                  "amountAllocatedPerMonth": "",
                  "customerId": ""
                }
              },
              {
                "value": "N5",
                "priority": "5",
                "cover": "",
                "discuss": "Yes",
                "advanceDetails": {
                  "coverFor": "Child",
                  "selectedInsuredName": "Son One",
                  "othersCoverForName": "",
                  "othersCoverForDob": "",
                  "selectedCoverForDob": "2012-01-01",
                  "investmentTimeInYears": "17",
                  "expectedAnnualReturns": "11",
                  "amountAllocatedPerMonth": 500,
                  "customerId": "<childid>"
                }
              },
              {
                "value": "N6",
                "priority": "6",
                "cover": "",
                "discuss": "Yes",
                "advanceDetails": {
                  "illness": {
                    "critical": "Critical Illness",
                    "coverFor": "Spouse",
                    "selectedInsuredName": "",
                    "othersCoverForName": "Wife Partner",
                    "othersCoverForDob": "1985-01-01",
                    "selectedCoverForDob": "",
                    "criticalTreatmentAmount": 66000,
                    "existingCiticalProtection": 40000,
                    "amountNeededCriticlRetirement": 26000,
                    "customerId": "<spouseid>"
                  },
                  "healthCare": {
                    "planning": "Health Planning",
                    "coverFor": "Myself",
                    "selectedInsuredName": "",
                    "othersCoverForName": "",
                    "othersCoverForDob": "",
                    "selectedCoverForDob": "",
                    "medicalTreatmentAmount": 80000,
                    "existingMedicalProtection": 17000,
                    "amountNeededMedicalRetirement": 63000,
                    "customerId": "<customerid>"
                  }
                }
              },
              {
                "value": "N7",
                "priority": "7",
                "cover": "",
                "discuss": "Yes",
                "advanceDetails": {
                  "coverFor": "Spouse",
                  "selectedInsuredName": "Wife",
                  "othersCoverForName": "Wife",
                  "othersCoverForDob": "1985-01-01",
                  "selectedCoverForDob": "",
                  "outstandingLoan": 3000,
                  "yearsLeftSettelement": "5",
                  "existingDebtCancellation": 1000,
                  "criticalIllnessProtection": "Yes",
                  "amountIllnessProtection": 3900,
                  "summaryDebtCancelation": 2000,
                  "customerId": "<spouseid>"
                }
              },
              {
                "value": "N8",
                "priority": "8",
                "cover": "",
                "discuss": "No",
                "advanceDetails": {}
              }
            ]
          },
            "existingPolicies": [
            {
              "ownerFirstName": "",
              "ownerLastName": "",
              "assuredFirstName": "",
              "firstName": "through new cff",
              "lastName": "UI",
              "assuredLastName": "",
              "policyDetails": {
                 "lifeInsuredFirstName": "insured name",
                "lifeInsuredLastName": "hhh",
                "companyName": "AIA Berhad",
                "inceptionDate": "2001",
                "typeOfplan": "Endowment",
                "planOthersValue": "",
                "companyOthersValue": "",
                "maturityDate": 2025,
                "premiumMode": "Annually",
                "additionalBenefit": [
                  {
                    "benefitName": "T012",
                    "benefitValue": "200.00"
                  },
                  {
                    "benefitName": "T012",
                    "benefitValue": "20000.00"
                  }
                ],
                "premiumContribution": "85000.00",
                "lifeCoverage": "200.00",
                "criticalIllnessBenefit": "20000.00"
              },
              "isNew": false,
              "role": "0"
            },
            {
              "ownerFirstName": "",
              "ownerLastName": "",
              "assuredFirstName": "",
              "firstName": "through new cff",
              "lastName": "UI",
              "assuredLastName": "",
              "policyDetails": {
                "lifeInsuredFirstName": "",
                "lifeInsuredLastName": "",
                "companyName": "Allianz Life",
                "inceptionDate": "2000",
                "typeOfplan": "Endowment",
                "planOthersValue": "",
                "companyOthersValue": "",
                "maturityDate": 2027,
                "premiumMode": "Annually",
                "additionalBenefit": [],
                "premiumContribution": "555.00",
                "criticalIllnessBenefit": "30000.00",
                "lifeCoverage": "200.00"
              },
              "isNew": false,
              "role": "1"
            },
            {
              "ownerFirstName": "",
              "ownerLastName": "",
              "assuredFirstName": "",
              "firstName": "Dr new",
              "lastName": "aa",
              "assuredLastName": "",
              "policyDetails": {
                "lifeInsuredFirstName": "",
                "lifeInsuredLastName": "",
                "companyName": "Generali Life (previously AXA AFFIN Life)",
                "inceptionDate": "2002",
                "typeOfplan": "Endowment",
                "planOthersValue": "",
                "companyOthersValue": "",
                "maturityDate": 2028,
                "premiumMode": "Semi-Annually",
                "additionalBenefit": [],
                "premiumContribution": "85000.00",
                "lifeCoverage": "2000.00",
                "criticalIllnessBenefit": "5550.00"
              },
              "isNew": true,
              "role": "2"
            }],
            "financialStatement": {
            "isChangeinAmount": "Yes",
            "amountAvailable": 30000,
            "changeinAmount": 2000
          }
          }';

        return $data = json_decode($data, true);
    }
}
