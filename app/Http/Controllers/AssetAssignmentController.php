<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetAssignmentModel;
use App\Http\Requests\AssetAssignmentFormRequest;
use App\Events\AssetAssignmentEvent;
use App\Notifications\AssetAssignmentNotification;
use App\Models\User;

class AssetAssignmentController extends Controller
{
   public function allAssetsAssignments(){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to retriveed for return
        $registered = AssetAssignmentModel::all();
        
        //cheking if any record in database
        if (count($registered) <= 0) {
            $gotten['message'] = "No Asset Assignment record retrieval found.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        return response()->json($to_return_facts) ; 
    }

    protected function uniqueAssetsAssignment($assetassignment_id){
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'Success'];
        $gotten = []; //message to be retriveed for return
        $registered = AssetAssignmentModel::where('id', '=', $assetassignment_id)->get();
        
        //cheking if any record in database
        if (count($registered) == 0) {
            $gotten['message'] = "No Asset Assignment record retrieved for: '$assetassignment_id'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        
        return response()->json($to_return_facts);  
    }

    public function removeAssetsAssignment($assetassignment_id){
        $to_return_facts = []; // total response for return
        $finds = AssetAssignmentModel::where('id', '=', $assetassignment_id)->first();
        if ($finds) {
            $finds->delete();
            $status = ['response'=> 'success'];
            $gotten['message'] = "Asset Assignment Records deleted successfully for the ID: '$assetassignment_id'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $status = ['response'=> 'success'];
            $gotten['message'] = "Could not deleted record for specified Asset Assignment ID, 'Seems it doesn't exits'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }       
        return response()->json($to_return_facts);  
    }

    protected function newAssetsAssignment(AssetAssignmentFormRequest $newAssetsAssignment){
        //return $newAssetArr;
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
      
        $place = new AssetAssignmentModel();
        if ($place::create($newAssetsAssignment->all())) {
            $groups['Success'] = "New Asset Assignment added successfully";
           $response_back += $groups;
    
        //event come here
            event(new AssetAssignmentEvent($newAssetsAssignment->name));

        //notification could come here though
            $userAssigned = User::where('id', '=', $newAssetsAssignment->assignedUserId)->first();
            $data_passed = [
                'success' => 'Assest assignment was successful',
                'email' => $userAssigned->email,
                'action' => 'An Asset was assigned to you!',
                'url' => url('/')
            ];
            $userAssigned->notify(new AssetAssignmentNotification($data_passed));
        }
        return response()->json($response_back);
    }

    protected function updateAssetsAssignment(Request $data, $updateAssetsAssignment){ 
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
        
        $place = AssetAssignmentModel::where('id', '=', "$updateAssetsAssignment")->first();
        if (count($data->all()) > 0) {
            if (strlen($place) > 0) {
                if ($place->update($data->all())) {
                   $response_back['Success'] = "Asset Assignment with the ID: '" . $updateAssetsAssignment . "' has been updated successfully";
                } else {
                   $response_back['Success'] = "Could not update the server for Asset ID: '" . $updateAssetsAssignment . "'";    
                } 
            } else {
                   $response_back['Success'] = "No Assets Assignment with the ID: '" . $updateAssetsAssignment . "' exist";
            }
        } else {
            $response_back['Success'] = "Empty Data sent for PUT actions, make sure data are sent as JSON content";
        }
        return response()->json($response_back);
    }
}
