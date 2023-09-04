<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env(key: 'APP_ENV') !=='local') {
            URL::forceScheme(scheme:'https');
          }
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom validation rule to validate either one field or the other
        Validator::extend('either_id_or_passport_birthCert_policeNumber_registrationNumber', function ($attribute, $value, $parameters, $validator) {
            $idNumber = $validator->getData()['idNumber'];
            $passportNumber = $validator->getData()['passportNumber'];
            $birthCert = $validator->getData()['birthCert'];
            $policeNumber = $validator->getData()['policeNumber'];
            $registrationNumber = $validator->getData()['registrationNumber'];
        
            return !empty($idNumber) || !empty($passportNumber) || !empty($birthCert) || !empty($policeNumber) || !empty($registrationNumber);
        });

        Validator::extend('numeric_commas_stripped', function ($attribute, $value, $parameters, $validator) {
                $strippedValue = preg_replace('/[^\d]/', '', $value);
                return is_numeric($strippedValue);
        });
        

    }
}
