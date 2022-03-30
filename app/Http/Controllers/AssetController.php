<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetModel;
use App\Http\Requests\AssetFormRequest;
use App\Events\AssetEvent;  

class AssetController extends Controller
{
    public function allAssets(){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to retriveed for return
        $registered_users = AssetModel::all();
        
        //cheking if any record in database
        if (count($registered_users) <= 0) {
            $gotten['message'] = "No Assets record retrieved found.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered_users;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        return response()->json($to_return_facts) ; 
    }

    protected function uniqueAsset($asset_serialNumber){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to be retriveed for return
        $registered_users = AssetModel::where('serialNumber', '=', $asset_serialNumber)->get();
        
        //cheking if any record in database
        if (count($registered_users) == 0) {
            $gotten['message'] = "No record retrieved for: '$asset_serialNumber'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered_users;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        
        return response()->json($to_return_facts);  
    }

    public function removeAsset($asset_serialNumber){
        $to_return_facts = []; // total response for return
        $finds = AssetModel::where('serialNumber', '=', $asset_serialNumber)->first();
        if ($finds) {
            $finds->delete();
            $status = ['response'=> 'success'];
            $gotten['message'] = "Asset Records deleted successfully for: '$asset_serialNumber'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $status = ['response'=> 'success'];
            $gotten['message'] = "Could not deleted record for specified Asset 'Seems it doesn't exits'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }       
        return response()->json($to_return_facts);  
    }

    protected function newAsset(AssetFormRequest $newAsset){
        //return $newAssetArr;
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
      
        $place_asset = new AssetModel();
        if ($place_asset::create($newAsset->all())) {
            $groups['Success'] = "New Asset with the Serial Number: '" . $newAsset['serialNumber'] . "' added successfully";
           $response_back += $groups;
        }

    //event come here
        event(new AssetEvent($newAsset->email));
        return response()->json($response_back);
    }

    protected function updateAsset(Request $data, $asset_serialNumber){
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
        
        $place_asset = AssetModel::where('serialNumber', '=', "$asset_serialNumber")->first();
        $array_to_set = [];
        foreach ($data->all() as $key => $value) {
            if ($key == "serialNumber") {
                continue;
            } else {
                $array_to_set[$key] = $value;
            }
        }
        if (count($data->all()) > 0) {
            if (strlen($place_asset) > 0) {
                if ($place_asset->update($array_to_set)) {
                   $response_back['Success'] = "Asset with the Serial Number: '" . $asset_serialNumber . "' has been updated successfully";
                } else {
                   $response_back['Success'] = "Could not update the server for: '" . $asset_serialNumber . "'";    
                } 
            } else {
                   $response_back['Success'] = "No Assets with the Serial Number: '" . $asset_serialNumber . "' exist";
            }
        } else {
            $response_back['Success'] = "Empty Data sent for PUT actions, make sure data are sent as JSON content";
        }
        return response()->json($response_back);
    }
}