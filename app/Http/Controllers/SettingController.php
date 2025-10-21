<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SettingController extends Controller
{
    
    /**
     * Setting Value Save and update
     */
    public function api_save_setting(Request $request){
       $api_type = $request->input('api_type');
       $user_id = Auth::id();
       switch ($api_type) {
            case 'pexels_api':
                $apiKey = $request->input('pexel_api');
                $dataCheck = Setting::where('key', 'pexels_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' => 'pexels_api_key', 'value' => $apiKey]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
            break;
            case 'unsplash_api':
                $apiKey = $request->input('unsplash_api');
                $dataCheck = Setting::where('key','unsplash_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' => 'unsplash_api_key', 'value' => $apiKey]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
            break;
            case 'pixabay_api':
                $apiKey = $request->input('pixabays_api');
                $dataCheck = Setting::where('key','pixabay_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' =>'pixabay_api_key', 'value' => $apiKey]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
            break;
            case 'google_bard_api':
                $apiKey = $request->input('google_bard_api');
                $dataCheck = Setting::where('key','google_bard_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' =>'google_bard_api_key', 'value' => $apiKey]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
            break;
            case 'leonardo_api':
                $apiKey = $request->input('leonardo_api');
                $dataCheck = Setting::where('key','leonardo_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' => 'leonardo_api_key', 'value' => $apiKey]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
            break;
            case 'aspose_api':
                $apiKey = $request->input('aspose_api');
                $client_secret = $request->input('client_secret');
                $dataCheck = Setting::where('key', 'aspose_api_key')->first();
                if ($dataCheck) {
                    // Update the existing record
                    $dataCheck->update(['value' => $apiKey]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' =>'aspose_api_key', 'value' => $apiKey]);
                }
                $dataCheck_client = Setting::where('key', 'aspose_client_secret')->first();
                if ($dataCheck_client) {
                    // Update the existing record
                    $dataCheck->update(['value' => $client_secret]);
                } else {
                    // Add a new record
                    Setting::create(['user_id'=>$user_id,'key' =>'aspose_client_secret', 'value' => $client_secret]);
                }
                return response()->json(['status'=>true,'message' => 'Saved successfully']);
             break;
        }
    }

    /**
     * Delete Api Setting
     */
    public function deleteSetting(Request $request)
    {
        $user_id = Auth::id();
        $apiType = $request->input('clear_api_type');
        $key = "{$apiType}_key";
        // Check if the setting exists
        if($key=='aspose_api_key'){
          $setting = Setting::where('user_id', $user_id)->where('key', $key)->first();
          if ($setting) {
            // Delete the setting
            $setting->delete();
            $settingclient_secret = Setting::where('user_id', $user_id)->where('key', 'aspose_client_secret')->first();
            $settingclient_secret->delete();
                return response()->json(['status' => true, 'message' => 'Setting deleted successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Setting not found']);
            }
        }else{
            $setting = Setting::where('user_id', $user_id)->where('key', $key)->first();
            if ($setting) {
                // Delete the setting
                $setting->delete();
                return response()->json(['status' => true, 'message' => 'Setting deleted successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Setting not found']);
            }
        }
        
    }
}