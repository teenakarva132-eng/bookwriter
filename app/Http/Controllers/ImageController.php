<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class ImageController extends Controller
{
    /**
     * Images Get Api
     */
    public function api_images(Request $request){
        $user_id = Auth::id();
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $data_types = $request->input('data_types');
        $data_keys = $request->input('data_keys');
        if(empty($data_keys)):
            $data_keys = 'books';
        endif;
        switch($data_types) {
            case 'Pixabay':
                /**
                 * Pixabay Api
                 */
                $pixabay_api = isset($settingsArray['pixabay_api_key']) ? $settingsArray['pixabay_api_key'] : '';
                $data_page = 30;
                $response = Http::withHeaders([
                    'Cookie' => '__cf_bm=t_ohWeKgkH4JjLxi9PbP_Y9c7TgDZ2cZQ7x72WTwgJk-1652880378-0-AYTXyVFddP/BL7+WvNr0xdFz8BEq6X6igjQmdUN41fHPQXwciAVBZ5iji+BL5ooxEQea0TjQ0J7BRE3XoK1eUOs=; anonymous_user_id=None; csrftoken=uzqhvnvqO6Icn30sibL3jiLz2atJJEAB3kgmZSt060mLQjmOC1xPGK0AvwVzH56X',
                ])->get('https://pixabay.com/api/', [
                        'key' => $pixabay_api,
                        'per_page' => 15,
                        'page' => $data_page,
                        'q' => $data_keys,
                        'image_type' => 'photo',
                        'pretty' => true,
                    ]);
                $pixabay = json_decode($response->body());
                if (!empty($pixabay)) {
                    foreach ($pixabay->hits as $pixabay_images) {
                        ?>
                        <div class="bb-thumb-box">
                            <img src="<?php echo $pixabay_images->previewURL; ?>" class="img-fluid">
                            <div class="bb-action">
                                <a href="javascript:;" data-url="<?php echo base64_encode($pixabay_images->largeImageURL); ?>" data-id="<?php echo $pixabay_images->id; ?>" class="bb-savemedia-image set_image">
                                    <?php echo 'Use'; ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
            break;
            case 'Unsplash':
                $unsplash_api = isset($settingsArray['unsplash_api_key']) ? $settingsArray['unsplash_api_key'] : '';
                $key = str_replace(" ", "-", $data_keys);
                $apiUrl = "https://api.unsplash.com/search/photos";
                $response = Http::get($apiUrl, [
                    'query' => $key,
                    'per_page' => 15,
                    'client_id' => $unsplash_api,
                ]);
                $images = json_decode($response->body());
                if (!empty($images)) {
                    foreach ($images->results as $image) {
                        $array = explode('?', $image->urls->regular);
                        ?>
                        <div class="bb-thumb-box" data-imgurl="<?php echo $image->urls->thumb; ?>">
                            <img src="<?php echo $image->urls->thumb; ?>" class="img-fluid">
                            <div class="bb-action">
                                <a href="javascript:void(0)" data-url="<?php echo base64_encode($image->urls->regular); ?>" data-id="<?php echo $image->id; ?>" class="bb-savemedia-image set_image">
                                <?php echo 'Use'; ?> 
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
            break;
            case 'Pexels':
                $pixabay_api = isset($settingsArray['pexels_api_key']) ? $settingsArray['pexels_api_key'] : '';
                
                $key = str_replace(" ", "%20", $data_keys);
                $apiUrl = 'https://api.pexels.com/v1/search?query=' . $key . '&per_page=15';
                
                $response = Http::withHeaders([
                    'Authorization' => $pixabay_api,
                ])->get($apiUrl);
                $pexels = json_decode($response->body());
                if (!empty($pexels)) {
                    foreach ($pexels->photos as $pexels_images) {
                        //$imageUrl = $pexels_images->src->medium;
                        $imageUrl = explode('?', $pexels_images->src->medium);
                        ?>
                        <div class="bb-thumb-box">
                            <img src="<?php echo $imageUrl[0]; ?>" class="img-fluid">
                            <div class="bb-action">
                                <a href="javascript:;" data-url="<?php echo base64_encode($imageUrl[0]); ?>" data-id="<?php echo $pexels_images->id; ?>" class="bb-savemedia-image set_image">
                                    <?php echo 'Use' ?> 
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
            break;
            case 'Leonardo':
		   
            break;	
            default:
          }
    }
    /**
     * Save Image 
     */
    public function saveImageUrl(Request $request)
    {
       // Get the image URL from the request
        $imageUrl = base64_decode($request->input('image_url'));
         // Extract the file name from the URL
        $filename = basename($imageUrl);
        // Check if the file already exists in the public folder
        if (File::exists(public_path('storage/' . $filename))) {
            return response()->json(['success' => false, 'message' => 'Image already exists']);
        }
        // Download the image from the URL
        $imageContents = file_get_contents($imageUrl);
        if ($imageContents !== false) {
            $filename = uniqid() . '_' . time() . '.jpg';
        }
        // Save the image to the public folder
        file_put_contents(public_path('storage/' . $filename), $imageContents);
        // Save the image URL to the database
        $user_id = Auth::id();
        $saveimage_url = asset('storage/' . $filename);
        Image::create(['user_id'=>$user_id,'url' => $saveimage_url]);
        return response()->json(['status' =>'true','url'=>$saveimage_url,'message' => 'Image saved successfully']);
    } 
    /**
     * Cover Images Save
     */
    public function CoverImageSave(Request $request)
    {
        $imagePath = '';
        if ($request->has('imgBase64')) {
            $imageData = $request->input('imgBase64');
            $img = str_replace('data:image/png;base64,', '', $imageData);
            $img = str_replace(' ', '+', $img);
            $decodedImage = base64_decode(str_replace('data:image/png;base64,', '', $img));

            if ($decodedImage !== false) {
                $filename = 'image_' . rand(1000, 9999) . '.png';

                // Define the path to save the image
                $uploadDir = public_path('storage'); // Change this to your desired directory
                $imagePath = $uploadDir . '/' . $filename;

                if (file_put_contents($imagePath, $decodedImage) === false) {
                    $dataOutput = ['status' => false, 'message' => 'Error saving the image.', 'url' => '#'];
                } else {
                    // Add logic for saving the image to the database if needed
                    $saveimage_url = asset('storage/' . $filename);
                    $dataOutput = ['status' => 'true', 'message' => 'Image saved successfully.', 'url' => $saveimage_url];
                }
            } else {
                $dataOutput = ['status' =>'false', 'message' => 'Error decoding image data.', 'url' => '#'];
            }
        } else {
            $dataOutput = ['status' =>'false', 'message' => 'Image data not received.', 'url' => '#'];
        }

        return response()->json($dataOutput);
    }
    /**
     * Upload Custom Images
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('storage'), $imageName);

        $imageUrl = asset('storage/' . $imageName);
        $user_id = Auth::id();
        Image::create(['user_id'=>$user_id,'url' => $imageUrl]);
        return response()->json(['url' => $imageUrl, 'message' => 'Image uploaded successfully']);
    }
    /**
     * Direact Get Image
     */
    public function booklyProLeonardoDirectUseImageId(Request $request)
    {
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $apiKey = isset($settingsArray['leonardo_api_key']) ? $settingsArray['leonardo_api_key'] : '';
        $searchImg = $request->input('search_query');
        if(empty($searchImg)):
            $searchImg = 'java book';
        endif;
        $apiTypes = $request->input('data_types');
        $endpoint = 'https://cloud.leonardo.ai/api/rest/v1/generations';
        $payload = [
            'modelId' => '6bef9f1b-29cb-40c7-b9df-32b51c1f67d3',
            'prompt' => $searchImg,
            'num_images' => 4,
            'height' => 512,
            'width' => 512,
        ];
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $apiKey,
            'content-type' => 'application/json',
        ])->post($endpoint, $payload);
        $leonardoData = $response->json();
        $leonardoId = $leonardoData['sdGenerationJob']['generationId'];
        return response()->json($leonardoData);
    }
    /**
     * Example method for using the generated image ID
     */
    public function booklyProLeonardoImage(Request $request)
    {  
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $leonardoApi = isset($settingsArray['leonardo_api_key']) ? $settingsArray['leonardo_api_key'] : '';

        $imageId = $request->input('images_id');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://cloud.leonardo.ai/api/rest/v1/generations/{$imageId}", [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer ' . $leonardoApi,
            ],
        ]);

        $leonImageData = json_decode($response->getBody(), true);

        if ($leonImageData['generations_by_pk']['status'] === 'PENDING') {
            // If the image is still pending, recursively call the method until it's ready
            $this->booklyProLeonardoImage($leonImageData['generations_by_pk']['id']);
        } else {
            $leoImagePath = $leonImageData['generations_by_pk']['generated_images'];
            foreach ($leoImagePath as $leoImg) {
                $leonardoImg = $leoImg['url'];
                echo '<div class="bb-thumb-box">
                    <img src="'.$leonardoImg.'" alt="Leonardo">
                    <div class="bb-action">
                        <a href="javascript:void(0)" data-url="'.base64_encode($leonardoImg).'" class="bb-savemedia-image">
                        Use
                        </a>
                    </div>
                </div>';
            }
        }
    }
}  