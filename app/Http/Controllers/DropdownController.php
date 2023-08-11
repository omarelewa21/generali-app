<?php 

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Country;
use App\Models\Title;

class DropdownController extends Controller
{
    public function index()
    {
        $occupations = Occupation::all();
        return view('pages/main/basic-details', compact('occupations'));
    }

    public function titles()
    {
        $titles = Title::all();
        return view('pages/main/basic-details', compact('titles'));
    }

    public function countries()
    {
        $countries = Country::all();
        return view('pages/avatar/identity-details', compact('countries'));
    }

}
