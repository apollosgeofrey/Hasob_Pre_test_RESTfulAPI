<?php
namespace App\Http\Controllers;
 
use App\Http\Requests\UserFormRequest;
use App\Events\UserEvent;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
 
class UserController extends Controller
{
     public function register(UserFormRequest $data)  {
        // Takes raw data from the request
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
        
        $place_user = new User();
        $place_user->firstName = $data->firstName;
        $place_user->middleName = $data->middleName;
        $place_user->lastName = $data->lastName;
        $place_user->email = $data->email;
        $place_user->phoneNumber = $data->phoneNumber;
        $place_user->pictureURL = $data->pictureURL;
        $place_user->password = bcrypt($data->password); // this can be futher hased to enhance security
        $place_user->isDisabled = 0;

        if ($place_user->save()) {
            $token = JWTAuth::fromUser($place_user);
            $groups['Success'] = "New user with the email: '" . $data['email'] . "' registered success";
            $groups['token'] = $token;
            $response_back += $groups;
        //event come here
            event(new UserEvent($data->email));
        //notification could come here though
            $user = User::where('email', '=', $data->email)->first();
            $data_passed = [
                'success' => 'Registration was successful',
                'email' => $data->email,
                'action' => 'Verify your email address',
                'url' => url('/')
            ];
            $user->notify(new UserNotification($data_passed));
        }
    //return view('/pages/registers')->with('status', $response_back);
     return response()->json([$response_back]);
    }


    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        return response()->json([
            'success' => 'Login successful, see TOKEN attached',
            'token' => $jwt_token,
        ]);
    }
 

    public function logout(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
 

    public function getAuthUser(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user]);
    }


    public function allUsers(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);
        $to_return_facts = []; // total response for return
        $status = ['response'=> 'success'];
        $gotten = []; //message to retriveed for return

        $registered_users = User::all();
        //cheking if any record in database
        if (count($registered_users) <= 0) {
            $gotten['message'] = "No record retrieved for all users.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered_users;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        return response()->json($to_return_facts) ; 
    }

    protected function uniqueUser(Request $request, $email){
        $this->validate($request, [
            'token' => 'required'
        ]);

        $to_return_facts = []; // total response for return
        $status = ['response'=> 'success'];
        $gotten = []; //message to retriveed for return
        $registered_users = User::where('email', '=', $email)->get();
        
        //cheking if any record in database
        if (count($registered_users) == 0) {
            $gotten['message'] = "No record retrieved for: '$email'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $gotten['message'] = $registered_users;
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }
        return response()->json($to_return_facts);
    }


    protected function updateUser(UserFormRequest $data){ 
    //empty initialized variables
        $response_back = [];
        $response_back["Message"] = "Server response to client success";
    //poping out email field
        $send_array = [];
        foreach ($data->all() as $key => $value) {
            if ($key == "email") {
                continue;
            } else {
                $send_array[$key] = $value;
            }
        }
        $active_user = JWTAuth::authenticate($data->token);
        $place_user = User::where('email', '=', $active_user->email)->first();
        if (count($data->all()) > 0) {
            if (strlen($place_user) > 0) {
                // this can be futher hased to enhance security
                if ($place_user->update($send_array)) {
                    $groups['Success'] = "User with the email: '" . $active_user->email . "' has gotten data updated success";
                   $response_back += $groups;
                } else {
                    $groups['Success'] = "Could not update the server for: '" . $active_user->email . "'";
                   $response_back += $groups;    
                } 
            } else {
                $groups['Success'] = "No user with the email: '" . $active_user->email . "' exist";
                   $response_back += $groups;
            }
        } else {
            $response_back['Success'] = "Empty Data sent for PUT actions, make sure data are sent as JSON content";
        }
        return response()->json($response_back);
    }


    protected function removeUser(Request $data){
        $this->validate($data, [
            'token' => 'required'
        ]);

        $active_user = JWTAuth::authenticate($data->token);
        $user_email = $active_user->email;
        $to_return_facts = []; // total response for return
        $finds = User::where('email', '=', $user_email)->first();
        if ($finds) {
            $finds->delete();
            $status = ['response'=> 'success'];
            $gotten['message'] = "Record deleted successfully for: '$user_email'.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        } else {
            $status = ['response'=> 'success'];
            $gotten['message'] = "Could not deleted record.";
            $to_return_facts += $status;
            $to_return_facts += $gotten;
        }       
        return response()->json($to_return_facts);  
    }
}
