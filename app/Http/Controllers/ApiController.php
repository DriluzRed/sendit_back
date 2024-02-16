<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Person;
use App\Models\Address;
use App\Models\Geo;
use App\Models\Company;

class ApiController extends Controller
{
    public function saveFromExternalSource()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        if ($response->ok()) {
            $usersData = $response->json();
            foreach ($usersData as $userData) {
                $person = new Person();
                $person->name = $userData['name'];
                $person->username = $userData['username'];
                $person->email = $userData['email'];
                $person->phone = $userData['phone'];
                $person->website = $userData['website'];
                $person->save();

                // Guardar la dirección del usuario
                $addressData = $userData['address'];
                $address = new Address();
                $address->person_id = $person->id;
                $address->street = $addressData['street'];
                $address->suite = $addressData['suite'];
                $address->city = $addressData['city'];
                $address->zipcode = $addressData['zipcode'];
                $address->save();
                $geoData = $addressData['geo'];
                $geo = new Geo();
                $geo->address_id = $address->id;
                $geo->lat = $geoData['lat'];
                $geo->lng = $geoData['lng'];
                $geo->save();

                // Guardar la empresa del usuario
                $companyData = $userData['company'];
                $company = new Company();
                $company->person_id = $person->id;
                $company->name = $companyData['name'];
                $company->catchPhrase = $companyData['catchPhrase'];
                $company->bs = $companyData['bs'];
                $company->save();
            }

            return response()->json(['message' => 'Usuarios guardados exitosamente'], 200);
        }
        return response()->json(['error' => 'No se pudieron obtener los datos de la fuente externa'], $response->status());
    }
}
