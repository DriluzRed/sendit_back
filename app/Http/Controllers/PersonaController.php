<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Address;
use App\Models\Company;
use App\Models\Geo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class PersonaController extends Controller
{
    public function index()
    {
        $personas =  Person::with(['addresses.geos', 'companies'])->get();
        return response()->json($personas);
    }
    public function store(Request $request)
    {
        // Log::info($request->all());
        $person = Person::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);

        // Crear la dirección
        $address = Address::create([
            'street' => $request->address['street'],
            'suite' => $request->address['suite'],
            'city' => $request->address['city'],
            'zipcode' => $request->address['zipcode'],
            'person_id' => $person->id, // Asegúrate de que la dirección está relacionada con la persona
        ]);

        // Crear la geolocalización
        $geo = Geo::create([
            'lat' => $request->address['geo']['lat'],
            'lng' => $request->address['geo']['lng'],
            'address_id' => $address->id, // Asegúrate de que la geolocalización está relacionada con la dirección
        ]);

        // Crear la empresa
        $company = Company::create([
            'name' => $request->company['name'],
            'catchPhrase' => $request->company['catchPhrase'],
            'bs' => $request->company['bs'],
            'person_id' => $person->id, // Asegúrate de que la empresa está relacionada con la persona
        ]);

        if ($person && $address && $geo && $company) {
            return response()->json(['message' => 'Created successfully'], 201);
        }
        return response()->json(['message' => 'Error'], 500);
    }
    public function destroy(Person $persona)
    {
        $persona->delete();
        return response()->json(['message' => 'Persona eliminada exitosamente'], 200);
    }
}
