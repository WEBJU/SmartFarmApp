<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variation;


class VariationController extends Controller
{
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        $data=Variation::where('id',$request->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }
}
