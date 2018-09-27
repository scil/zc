<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class CountryController extends Controller
{

    function country($sub = null)
    {
        if (null === $sub) {
            $columnID = MENU_MAP['country']['id'];
            return view('country.index', compact('columnID'));
        }

        $columnID = MENU_MAP["country/$sub"]['id'];

        $data = [];
        return view("country.$sub", compact('columnID'));
    }

    function bay($sub = null)
    {
        if ($sub === null) {
            return view("country.bay", [
                'columnID' =>  MENU_MAP["bay"]['id']
            ]);
        }
        return view("country.bay.$sub", [
            'columnID' => MENU_MAP["bay/$sub"]['id'],
            'sub' => $sub,
        ]);

    }

    function hall()
    {
        return view("country.hall", [
            'columnID' =>  MENU_MAP["hall"]['id']
        ]);
    }

    function pass($sub = null)
    {
        if ($sub === null) {
            return view('pass.index', [
                'columnID' =>  MENU_MAP["pass"]['id']
            ]);
        }
        $data = [];
        return view('pass.' . $sub, $data);
    }

    function ferry()
    {
        return view('pass.ferry', [
            'columnID' =>  MENU_MAP["ferry"]['id']
        ]);
    }
}