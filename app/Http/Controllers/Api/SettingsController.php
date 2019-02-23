<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;

class SettingsController extends Controller
{
    public function indexAction(){
        $data = Settings::get();

        return $data;
    }

    public function updateAction(Request $request){
        
        foreach ($request->data as $key => $data) {
            $query = Settings::where('id', $data['id'])->update($data);
        }

        return ['success' => true, 'message' => __('notifications.edit_success') ];
    }
}
