<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class AsposeAccessTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $asposeToken = config('services.aspose.token');
        $expirationTime = config('services.aspose.expiration_time');

        if (time() > $expirationTime) {
           $this->refreshAsposeToken();
        }
        return $next($request);
    }

    private function refreshAsposeToken()
    {
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        $clientId = isset($settingsArray['aspose_api_key']) ? $settingsArray['aspose_api_key'] : '';
        $clientSecret = isset($settingsArray['aspose_client_secret']) ? $settingsArray['aspose_client_secret'] : '';

        $response = Http::asForm()
            ->post('https://api.aspose.cloud/connect/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]);

        $responseArr = $response->json();

        if (!empty($responseArr['access_token'])) {
            config(['services.aspose.token' => trim($responseArr['access_token'])]);
        }

        if (!empty($responseArr['expires_in'])) {
            $expirationTime = time() + $responseArr['expires_in'];
            config(['services.aspose.expiration_time' => $expirationTime]);
        }
    }
}
