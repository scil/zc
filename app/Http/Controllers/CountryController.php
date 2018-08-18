<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class CountryController extends Controller
{

    function country($sub = null)
    {
        if (null === $sub) {
            $columnID = MENU_ITEMS['country']['id'];
            $title = MENU_ITEMS['country']['title'];
            return view('country.index', compact('title'));
        }
        $columnID = MENU_ITEMS["country/$sub"]['id'];
        $title = MENU_ITEMS["country/$sub"]['title'];
        $desc = MENU_ITEMS["country/$sub"]['desc'];
        $data = [];
        return view("country.$sub", compact('columnID', 'title', 'desc'));
    }

    function bay($sub = null)
    {

        $menu = MENU_ITEMS["bay"];

        if ($sub === null) {
            return view("country.bay", [
                'title' => $menu['title'],
                'desc' => $menu['desc'],
                'columnID' => $menu['id']
            ]);
        }
        return view("country.bay.$sub", [
            'columnID' => MENU_ITEMS["bay/$sub"]['id'],
            'title' => MENU_ITEMS["bay/$sub"]['title'],
            'desc' => MENU_ITEMS["bay/$sub"]['desc'],
        ]);

    }

    function hall()
    {

        $menu = MENU_ITEMS["hall"];

        return view("country.hall", [
            'title' => $menu['title'],
            'desc' => $menu['desc'],
            'columnID' => $menu['id']
        ]);
    }

    function pass($sub = null)
    {
        if (is_null($sub)) {
            $menu = MENU_ITEMS["pass"];
            return view('pass.index', [
                'title' => $menu['title'],
                'desc' => $menu['desc'],
                'columnID' => $menu['id']
            ]);
        }
        $data = [];
        return view('pass.' . $sub, $data);
    }

    function ferry()
    {
        $menu = MENU_ITEMS["ferry"];
        return view('pass.ferry', [
            'title' => $menu['title'],
            'desc' => $menu['desc'],
            'columnID' => $menu['id']
        ]);
    }
}