<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorModel;
use App\Http\Requests\VendorFormRequest;
use App\Events\VendorEvent;  

class VendorController extends Controller
{
    public function allVendors(){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to retriveed for return
        $registered = VendorModel::all();
        
        //cheking if any record in database
        if (count($registered) <= 0) {
            $gotten['message'] = "No Vendors record retrieval found.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        return response()->json($to_return_facts) ; 
    }

    protected function uniqueVendor($vendor_id){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to be retriveed for return
        $registered = VendorModel::where('id', '=', $vendor_id)->get();
        
        //cheking if any record in database
        if (count($registered) == 0) {
            $gotten['message'] = "No Vendor's record retrieved for: '$vendor_id'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        
        return response()->json($to_return_facts);  
    }

    public function removeVendor($vendor_id){
        $to_return_facts = []; // total response for return
        $finds = VendorModel::where('id', '=', $vendor_id)->first();
        if ($finds) {
            $finds->delete();
            $status = ['response'=> 'success'];
            $gotten['message'] = "Vendor's Records deleted successfully for: '$vendor_id'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $status = ['response'=> 'success'];
            $gotten['message'] = "Could not deleted record for specified Vendor 'Seems it doesn't exits'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }       
        return response()->json($to_return_facts);  
    }

    protected function newVendors(VendorFormRequest $vendor){
        //return $newAssetArr;
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
      
        $place_vendor = new VendorModel();
        if ($place_vendor::create($vendor->all())) {
            $groups['Success'] = "New Vendor with the name: '" . $vendor->name ."' added successfully";
           $response_back += $groups;
        }

    //event come here
        event(new VendorEvent($vendor->name));
        return response()->json($response_back);
    }

    protected function updateVendor(Request $data, $vendor_id){ 
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
        
        $place_vendor = VendorModel::where('id', '=', "$vendor_id")->first();
        if (count($data->all()) > 0) {
            if (strlen($place_vendor) > 0) {
                if ($place_vendor->update($data->all())) {
                   $response_back['Success'] = "Vendor with the ID: '" . $vendor_id . "' has been updated successfully";
                } else {
                   $response_back['Success'] = "Could not update the server for: '" . $data['name'] . "'";    
                } 
            } else {
                   $response_back['Success'] = "No Vendor with the ID: '" . $vendor_id . "' exist";
            }
        } else {
            $response_back['Success'] = "Empty Data sent for PUT actions, make sure data are sent as JSON content";
        }
        return response()->json($response_back);
    }
}
