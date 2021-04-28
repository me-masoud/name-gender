<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\Request;

class SexController extends Controller
{
    public function getName($name)
    {
        $result = $this->searchInDB($name);
        return $result->sex;
    }

    public function searchInDB($name)
    {
        $result = Name::where('name' ,$name)->first();
        return $result;
    }
    public function addNameView(){
        return view('addName');
    }

    public function addName(Request $request)
    {
        $validate = $this->validate($request , [
            'name' =>'required|unique:names|string|max:128',
            'enName' =>'required|string|max:128',
            'sex' =>'required',
        ]);

        $resualt = Name::where('name' , $request->name)->first();
        if (!$resualt){
            $new = Name::create([
                'firstChar' => utf8_encode(str_split($request->enName)[0]),
                'name' => $request->name,
                'enName' =>$request->enName,
                'sex' =>$request->sex
            ]);
            $new->save();
        }
        if ($new){

            return view('addName');
        }
    }
}
