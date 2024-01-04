<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\pelajar;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
         //validate the form data
         $this->validate($request, [
            'nisn'      => 'required',
            'password'  => 'required',
        ]);

        //cek nisn dan password
        $pelajar = pelajar::where([
            'nisn'      => $request->nisn,
            'password'  => $request->password
        ])->first();

        if(!$pelajar) {
            return redirect()->back()->with('error', 'NISN atau Password salah');
        }
        
        //login the user
        auth()->guard('pelajar')->login($pelajar);

        //redirect to dashboard
        return redirect()->route('pelajar.dashboard');
    }
}
