<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionModel;
use App\Models\CardDetailModel;
use App\Models\BankAccountModel;
use App\Models\SafetyFeaturesModel;
use App\Models\antiTheftDevicesModel;
use Auth;

class SubscriptionController extends Controller
{
    //
    public function subscript(Request $request){

        $userId = Auth::user()->id;
        

        $valide = request()->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'phoneNumber' => 'required|numeric',
            'countryCode' => 'required|numeric',
            'email' => 'required|email',
            'personalAddress' => 'required',
            'vehicleMake' => 'required',
            'vehicleModel' => 'required',
            'vehicleIdentificationNumber' => 'required',
            'yearOfManuficature' => 'required',
            'plateNumber' => 'required|unique:subscriptions',
            'currentMileage' => 'required',
            'policyStartDate' => 'required',
            'coverageAmount' => 'required',
            'deductibleAmount' => 'required',
            'driverLicenseNumber' => 'required',
            'yearOfDrivingExperience' => 'required',
            'annualMileage' => 'required',
            'vehicleUsage' => 'required',
            'paymentMethod' => 'required'
         ]);
         if($valide){
            
            $subscripter = new SubscriptionModel;


            $subscripter->userId = $userId;
   
            $subscripter->firstName = trim($request->firstName);
            $subscripter->middleName = trim($request->middleName);
            $subscripter->lastName = trim($request->lastName);
   
            //the gender is stored as an integer. 1=male,2=female,3=other 
            //or it depended of which data will be coming from the frontend
            $subscripter->gender = trim($request->gender);
            $subscripter->phoneNumber = trim($request->phoneNumber);
            $subscripter->countryCode = trim($request->countryCode);
            $subscripter->email = trim($request->email);
            $subscripter->personalAddress = trim($request->personalAddress);
            $subscripter->vehicleMake = trim($request->vehicleMake);
            $subscripter->vehicleModel = trim($request->vehicleModel);
            $subscripter->vehicleIdentificationNumber = trim($request->vehicleIdentificationNumber);
            $subscripter->yearOfManuficature = trim($request->yearOfManuficature);
            $subscripter->plateNumber = trim($request->plateNumber);
            $subscripter->currentMileage = trim($request->currentMileage);
            $subscripter->policyStartDate = trim($request->policyStartDate);
            $subscripter->coverageAmount = trim($request->coverageAmount);
            $subscripter->deductibleAmount = trim($request->deductibleAmount);
            $subscripter->driverLicenseNumber = trim($request->driverLicenseNumber);
            $subscripter->yearOfDrivingExperience = trim($request->yearOfDrivingExperience);
            $subscripter->annualMileage = trim($request->annualMileage);
            $subscripter->vehicleUsage = trim($request->vehicleUsage);
            $subscripter->paymentMethod = trim($request->paymentMethod);

   
         }
         

        
        


            //inserting the  safety feature

            if(!empty($request->safetyFeatures)){
                    
                foreach($request->safetyFeatures as $safetyFeature){ 
    
                       $safetyD = new SafetyFeaturesModel;
    
                       $safetyD->userId = $userId;
    
                       $safetyD->deviceName = $safetyFeature['deviceName'];
                       $safetyD->deviceDetail = $safetyFeature['deviceDetail'];
                       $safetyD->save(); 
    
                    } 
    
                }//end of inserting the  safety feature
    
    
             //inserting the  anti-Theft details
             if(!empty($request->antiTheftDetails)){
                        
                foreach($request->antiTheftDetails as $antiTheftDetail){ 
                    
                        $antiTheftD = new antiTheftDevicesModel;
    
                        $antiTheftD->userId = $userId;
    
                        $antiTheftD->deviceName = $antiTheftDetail['deviceName'];
                        $antiTheftD->deviceDetail = $antiTheftDetail['deviceDetail'];
                        $antiTheftD->save();  
    
                    } 
                }//end of inserting the  safety feature


         //this is in case the subscriber selected payment by credit card

         if(trim($request->paymentMethod) === 'credit_card')
         {

            $valide = request()->validate([
               
                'creditCardNumber' => 'required',
                'expirationDate' => 'required',
                'CVC' => 'required',
                'billingAddress' => 'required',
                'paymentAmount' => 'required',
                'authorizationCode' => 'required'

             ]);

             if($valide){
                
                $card = new CardDetailModel;

                $card->userId = $userId;
   
                $card->creditCardNumber = trim($request->creditCardNumber);
                $card->expirationDate = trim($request->expirationDate);
                $card->CVC = trim($request->CVC);
                $card->billingAddress = trim($request->billingAddress);
                $card->paymentAmount = trim($request->paymentAmount);
                $card->authorizationCode = trim($request->authorizationCode);
   
                $card->save();
   
             }

            

         }//end of case the subscriber selected payment by credit card


         //this is in case the subscriber selected payment by bank account

         if(trim($request->paymentMethod) === 'bank_account'){

               $valide = request()->validate([

                    'bankName' => 'required',
                    'holderName' => 'required',
                    'accountNumber' => 'required',
                    'routingNumber' => 'required',
                    'paymentAmount' => 'required'
                    

                ]);
                if($valide){
                   
                    $bankAccount = new BankAccountModel;

                    $bankAccount->userId = $userId;

                    $bankAccount->bankName = trim($request->bankName);
                    $bankAccount->holderName = trim($request->holderName);
                    $bankAccount->accountNumber = trim($request->accountNumber);
                    $bankAccount->routingNumber = trim($request->routingNumber);
                    $bankAccount->paymentAmount = trim($request->paymentAmount);
                

                    $bankAccount->save();
                }


         }//end of case the subscriber selected payment by bank account

        //saving subscription
         $subscripter->save(); 

         return redirect('/welcome');




    }
}
