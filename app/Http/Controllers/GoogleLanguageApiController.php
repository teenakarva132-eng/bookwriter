<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
class GoogleLanguageApiController extends Controller
{
    public function generateText(Request $request)
    {
          
        $user_id = Auth::id();
    $settings = Setting::all();
    $settingsArray = $settings->pluck('value', 'key')->toArray();
    // Prefer the value from settings, otherwise fall back to env var (recommended)
    $googleBardApi = isset($settingsArray['google_bard_api_key']) ? $settingsArray['google_bard_api_key'] : env('GOOGLE_GENERATIVE_API_KEY', '');

        $userPromat = $request->input('title', '');
        // Use the newer Gemini/generative endpoint for content generation
        $apiKey = trim($googleBardApi);
        $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent';

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $userPromat]
                    ]
                ]
            ],
            // If you need sampling or multiple variants, configure model-specific fields according to
            // the Generative Language API documentation. Removing unsupported top-level fields.
        ];

        $response = Http::timeout(60)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url . ($apiKey ? '?key=' . $apiKey : ''), $payload);

        $data_respons = $response->json();

        // Robust parsing: gemini returns 'candidates' array inside 'candidates' at top-level or inside 'output'
        if (isset($data_respons['error'])) {
            $message = $data_respons['error']['message'];
            $output_result = ['status' => 'false', 'content' => null, 'response' => $message];
        } else {
            // Try to extract text from known shapes
            $texts = [];
            if (isset($data_respons['candidates']) && is_array($data_respons['candidates'])) {
                foreach ($data_respons['candidates'] as $cand) {
                    if (isset($cand['content'])) {
                        // new shape: candidate with content.parts
                        if (is_array($cand['content'])) {
                            foreach ($cand['content'] as $contentBlock) {
                                if (isset($contentBlock['parts'])) {
                                    foreach ($contentBlock['parts'] as $part) {
                                        if (isset($part['text'])) $texts[] = $part['text'];
                                    }
                                }
                            }
                        }
                    } elseif (isset($cand['output'])) {
                        // older text-bison shape
                        $texts[] = $cand['output'];
                    }
                }
            }

            // Fallback: if top-level 'output' exists
            if (empty($texts) && isset($data_respons['output'])) {
                $texts[] = is_string($data_respons['output']) ? $data_respons['output'] : json_encode($data_respons['output']);
            }

            // Final fallback: return the whole response as string
            if (empty($texts)) {
                $texts[] = json_encode($data_respons);
            }

            $output_result = ['status' => 'true', 'content' => $texts, 'raw' => $data_respons];
        }
        return response()->json($output_result);
    } 
    /**
     * Google Set custom Promat 
     */
    public function bookblazeContentGenerator(Request $request)
    {
        $userPromat = $request->input('title', '');
        $cbcLanguage = $request->input('cbc_language', 'English');
        $featureName = $request->input('feature_name', '');
        $promat = '';
        switch ($featureName) {
            case 'storycreator':
                $promat = 'Story of ' . $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'booksmaker':
                $promat = $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'novelcreator':
                $promat = $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'poemcreator':
                $promat = 'Write a poem on ' . $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'formalletter':
                $promat = 'Write a formal letter on ' . $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'preports':
                $promat = 'Write a report on ' . $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'presentations':
                $promat = 'Write a project report on ' . $userPromat . ' in ' . $cbcLanguage;
                break;
            case 'customcontent':
                $promat = $userPromat;
                break;
        }

        // Assuming eBGeniusGoogleBardAi is another method in the same controller
        $output = $this->bookblazeGoogleBardAi($promat, $featureName);

        return response()->json($output);
    }
    /**
     * This is function google bard AI
     */
    public function bookblazeGoogleBardAi($user_promat = false, $feature_name = false)
    {
        /**
         * Api key Get Code
         */
        $user_id = Auth::id();
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $googleBardApi = isset($settingsArray['google_bard_api_key']) ? $settingsArray['google_bard_api_key'] : '';

        if ($feature_name === 'booksmaker' || $feature_name === 'novelcreator') {
                try {
                    $outputResult = retry(3, function () use ($user_promat, $feature_name) {
                        $request = new Request(['user_promat' => $user_promat, 'feature_name' => $feature_name]);
                        return $this->bookblazeGooglebardGenerate($request, $user_promat, $feature_name);
                    }, 100); // Retry 3 times with a delay of 100 milliseconds between retries

                    return response()->json($outputResult);
                } catch (ConnectionException $e) {
                    $message = $e->getMessage();
                    $outputResult = ['status' => 'false', 'content' => null, 'response' => $message];
                    return response()->json($outputResult);
                }
        } else {
                try {
                    $apiKey = trim($googleBardApi);
                    $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent';
                    $payload = [
                        'contents' => [[ 'parts' => [[ 'text' => $user_promat ]]]],
                    ];

                    $response = Http::timeout(60)
                        ->withHeaders(['Content-Type' => 'application/json'])
                        ->post($url . ($apiKey ? '?key=' . $apiKey : ''), $payload);

                    $responseData = $response->json();
                    if (isset($responseData['error'])) {
                        $message = $responseData['error']['message'];
                        $outputResult = ['status' => 'false', 'content' => $responseData, 'response' => $message];
                    } else {
                        // Try to extract textual parts
                        $texts = [];
                        if (isset($responseData['candidates']) && is_array($responseData['candidates'])) {
                            foreach ($responseData['candidates'] as $cand) {
                                if (isset($cand['content']) && is_array($cand['content'])) {
                                    foreach ($cand['content'] as $contentBlock) {
                                        if (isset($contentBlock['parts']) && is_array($contentBlock['parts'])) {
                                            foreach ($contentBlock['parts'] as $part) {
                                                if (isset($part['text'])) $texts[] = $part['text'];
                                            }
                                        }
                                    }
                                } elseif (isset($cand['output'])) {
                                    $texts[] = $cand['output'];
                                }
                            }
                        }
                        if (empty($texts) && isset($responseData['output'])) {
                            $texts[] = is_string($responseData['output']) ? $responseData['output'] : json_encode($responseData['output']);
                        }
                        $outputResult = ['status' => 'true', 'content' => $texts, 'raw' => $responseData];
                    }
                    return response()->json($outputResult);
                } catch (ConnectionException $e) {
                    $message = $e->getMessage();
                    $outputResult = ['status' => 'false', 'content' => null, 'response' => $message];
                    return response()->json($outputResult);
                }
        }
    }
    /** 
     * Larag content Process
     */
    public function bookblazeGooglebardGenerate(Request $request,$userPromat=false, $featureName=false)
    {
        try {
            if ($request->input('content_type') == 'content_type') {
                $inputValues = $request->input('ab');
                $valuesArray = explode('@@', $inputValues);
                $bookData = [];
                foreach ($valuesArray as $value) {
                    if ($value != 'undefined') {
                        $newPromat = ($featureName == 'novelcreator') ? $value . ' novel' . $userPromat : $value . ' Book' . $userPromat;
                        $contentData = $this->bookblazeLarageContentGenerator($newPromat);
                        $dataCheck = json_decode($contentData, true);
                        if ($dataCheck['status'] == 'false') {
                            $bookCallotion = ['status' => 'false', 'heading' => $value, 'description' => $dataCheck['response']];
                            array_push($bookData, $bookCallotion);
                        } else {
                            $textData = $dataCheck['content'];
                            $bookCallotion = ['heading' => $value, 'description' => $textData];
                            array_push($bookData, $bookCallotion);
                        }
                    }
                }
                return json_encode($bookData);

            } else {
                $promatChanges = ($featureName == 'novelcreator') ? 'Write novel of' . $userPromat : 'Write Book of' . $userPromat;
                $dataRespons = $this->bookblazeHeadingComman($promatChanges);
                $dataArr = json_decode($dataRespons, true);
                $output = $dataArr['content']['candidates'][0]['output'];
                preg_match_all('/\*\*(.*?)\*\*/', $output, $matches);
                $headings = array_map('trim', $matches[1]);
                if ($dataArr['status'] == 'true') {
                    $customArr = ['status' => 'true', 'headings' => json_encode($headings)];
                    return json_encode($customArr);
                } else {
                    return $dataRespons;
                }
            }
        } catch (ConnectionException $e) {
            $message = $e->getMessage();
            $outputResult = ['status' => 'false', 'content' => null, 'response' => $message];
            return response()->json($outputResult);
        }
    }
    /**
     * Bookblaze Larage Single Content
     */
    public function bookblazeLarageContentGenerator($userPromat = false)
    {
        /**
         * Api key Get Code
         */
        $user_id = Auth::id();
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $googleBardApi = isset($settingsArray['google_bard_api_key']) ? $settingsArray['google_bard_api_key'] : env('GOOGLE_GENERATIVE_API_KEY', '');

        $apiKey = trim($googleBardApi);
        $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent';
        $payload = [
            'contents' => [[ 'parts' => [[ 'text' => $userPromat ]]]],
        ];

        $response = Http::timeout(60)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url . ($apiKey ? '?key=' . $apiKey : ''), $payload);
        $dataRespons = $response->json();

        $texts = [];
        if (isset($dataRespons['candidates']) && is_array($dataRespons['candidates'])) {
            foreach ($dataRespons['candidates'] as $cand) {
                if (isset($cand['content']) && is_array($cand['content'])) {
                    foreach ($cand['content'] as $contentBlock) {
                        if (isset($contentBlock['parts']) && is_array($contentBlock['parts'])) {
                            foreach ($contentBlock['parts'] as $part) {
                                if (isset($part['text'])) $texts[] = $part['text'];
                            }
                        }
                    }
                } elseif (isset($cand['output'])) {
                    $texts[] = $cand['output'];
                }
            }
        }

        if (!empty($dataRespons['error'])) {
            $message = $dataRespons['error']['message'];
            $outputResult = ['status' => 'false', 'content' => null, 'response' => $message];
        } else {
            if (empty($texts) && isset($dataRespons['output'])) {
                $texts[] = is_string($dataRespons['output']) ? $dataRespons['output'] : json_encode($dataRespons['output']);
            }
            $outputResult = ['status' => 'true', 'content' => $texts, 'raw' => $dataRespons];
        }

        return json_encode($outputResult);
    }
    /**
     * BookBlaze Heading Creater
     */
    public function bookblazeHeadingComman($prompt = false)
    {
        /**
         * Api key Get Code
         */
        $user_id = Auth::id();
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $googleBardApi = isset($settingsArray['google_bard_api_key']) ? $settingsArray['google_bard_api_key'] : env('GOOGLE_GENERATIVE_API_KEY', '');

        $apiKey = trim($googleBardApi);
        $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent';
        $payload = [
            'contents' => [[ 'parts' => [[ 'text' => $prompt ]]]],
        ];

        $response = Http::timeout(60)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url . ($apiKey ? '?key=' . $apiKey : ''), $payload);
        $dataRespons = $response->json();

        if (!empty($dataRespons['error'])) {
            $message = $dataRespons['error']['message'];
            $result = '';
            $outputResult = ['status' => 'false', 'content' => $result, 'response' => $message];
        } else {
            $texts = [];
            if (isset($dataRespons['candidates']) && is_array($dataRespons['candidates'])) {
                foreach ($dataRespons['candidates'] as $cand) {
                    if (isset($cand['content']) && is_array($cand['content'])) {
                        foreach ($cand['content'] as $contentBlock) {
                            if (isset($contentBlock['parts']) && is_array($contentBlock['parts'])) {
                                foreach ($contentBlock['parts'] as $part) {
                                    if (isset($part['text'])) $texts[] = $part['text'];
                                }
                            }
                        }
                    } elseif (isset($cand['output'])) {
                        $texts[] = $cand['output'];
                    }
                }
            }

            $outputResult = ['status' => 'true', 'content' => $texts ?: $dataRespons];
        }

        return json_encode($outputResult);
    }
}