<x-app-layout>
<div class="bb-page-content">
    <!-- Settings  -->
    <div class="bb-tabs-container">
        <div class="bb-tab-navigation">
            <div class="bb-tabs-nav">
                <ul>
                    <li>
                        <a class="bb-seting-link active" target="1" id="Pexels">
                        <span class="bb-tab-icon">
                            <img src="{{ asset('images/2.png') }}" alt="{{ __('Pexels API') }}">   
                        </span>
                        <span>{{ __('Pexels API') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="bb-seting-link" target="2" id="Unsplash">
                        <span class="bb-tab-icon">
                        <img src="{{ asset('images/3.png') }}" alt="{{ __('Unsplash API') }}">   
                        </span>
                        <span>{{ __('Unsplash API') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="bb-seting-link" target="4" id="Pixabay">
                        <span class="bb-tab-icon">
                        <img src="{{ asset('images/4.png') }}" alt="{{ __('Pixabay API') }}">   
                        </span>    
                        <span>{{ __('Pixabay API') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="bb-seting-link" target="6" id="Leonardo">
                        <span class="bb-tab-icon">
                        <img src="{{ asset('images/6.png') }}" alt="childbook {{ __('Leonardo.Ai API') }}">   
                        </span>    
                        <span>{{ __('Leonardo.Ai API') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="bb-seting-link" target="5" id="Google">
                        <span class="bb-tab-icon">
                        <img src="{{ asset('images/5.png') }}" alt="childbook {{ __('Google Gemini API') }}">   
                        </span>    
                        <span>{{ __('Google Gemini API') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="bb-seting-link" target="7" id="Aspose">
                        <span class="bb-tab-icon">
                        <img src="{{ asset('images/5.png') }}" alt="childbook {{ __('Aspose API') }}">   
                        </span>    
                        <span>{{ __('Aspose API') }}</span>
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
            <div class="tabs-content">
                @csrf
                <!-- Tab content Second -->
                <div class="bb-single-tab setting1" id="">
                    <div class="bb-tab-section">
                        <form action="">
                            <div class="bb-content has-title">
                                <div class="bb-card">
                                    <div class="bb-from-wrapper">
                                    <div class="bb-title-box">
                                        <h4 class="bb-form-title">
                                        {{ __('Pexels API Setting') }}                                         
                                        </h4>
                                        <p>{{ __('The best free stock photos, royalty free images shared by creators') }}  </p>
                                    </div>
                                    <div class="bb-input-wrapper">
                                        <label for="cbc_open_api_key"> 
                                        {{ __('Enter API Key ') }}  
                                        </label>
                                        <input type="text" placeholder="{{ __('Enter API Key') }}" id="pexels_api" name="pexels_api" value="{{ isset($settingsArray['pexels_api_key']) ?  $settingsArray['pexels_api_key'] : '' }}">									<span>
                                        {{ __('Don\'t know how to grab api key?') }}
                                        <a href="https://www.pexels.com/api/documentation" target="_blank">
                                        {{ __('Click Here') }}              
                                        </a>
                                        <a href="https://www.youtube.com/watch?v=6M8kug0KsLg&t=1s" target="_blank">
                                         {{ __('Video Tutorial') }}                                                
                                        </a>
                                        </span>
                                    </div>
                                    <div class="pexels_api_message bb-api-status"></div>
                                    <div class="bb-btn-wrapper">
                                        @if(isset($settingsArray['pexels_api_key']))
                                          <a href="javascript:void(0)" id="bb_pexels_api_clear" data-apiclear="pexels_api" class="bb-btn bb_api_clear">{{ __('Disconnect') }}</a>
                                        @else
                                        <a href="javascript:void(0)" id="bb_pexels_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tab content Third -->
                <div class="bb-single-tab setting2" id="">
                    <div class="bb-tab-section">
                    <form action="">
                        <div class="bb-content has-title">
                            <div class="bb-card">
                                <div class="bb-from-wrapper">
                                <div class="bb-title-box">
                                    <h4 class="bb-form-title">
                                    {{ __('Unsplash API Setting') }}                                           
                                    </h4>
                                    <p>
                                    {{ __('Beautiful, free images and photos that you can download and use for any project. Better than any royalty free or stock photos') }}   
                                    </p>
                                </div>
                                <div class="bb-input-wrapper">
                                    <label for="cbc_open_api_key"> 
                                    {{ __('Enter API Key') }}                                           
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter API Key') }}" id="unsplash_api" name="unsplash_api" value="{{ isset($settingsArray['unsplash_api_key']) ?  $settingsArray['unsplash_api_key'] : '' }}">                                         
                                    <span>
                                    {{ __(' Don\'t know how to grab api key ? ') }}     
                                    <a href="https://unsplash.com/documentation" target="_blank">
                                    {{ __('Click Here ') }}                                           
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=_AprVrgnq4w&t=65s" target="_blank">
                                    {{ __('Video Tutorial') }}                                                
                                    </a>
                                    </span>
                                </div>
                                <div class="unsplash_api_message bb-api-status"></div>
                                <div class="bb-btn-wrapper">
                                    @if(isset($settingsArray['unsplash_api_key']))
                                      <a href="javascript:void(0)" id="bb_unsplash_api_clear" data-apiclear="unsplash_api" class="bb-btn bb_api_clear">{{ __('Disconnect') }}</a>
                                    @else
                                      <a href="javascript:void(0)" id="bb_unsplash_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                    @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Tab content Fourth -->
                <div class="bb-single-tab setting4" id="">
                    <div class="bb-tab-section">
                    <form action="">
                        <div class="bb-content has-title">
                            <div class="bb-card">
                                <div class="bb-from-wrapper">
                                <div class="bb-title-box">
                                    <h4 class="bb-form-title">
                                        {{ __('Pixabay API Setting') }}                                       
                                    </h4>
                                    <p>{{ __('Stunning royalty-free images &amp; royalty-free stock') }} </p>
                                </div>
                                <div class="bb-input-wrapper">
                                    <label for="cbc_open_api_key"> 
                                    {{ __(' Enter API Key') }}                                            
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter API Key') }}" id="pixabay_api" name="pixabay_api" value="{{ isset($settingsArray['pixabay_api_key']) ? $settingsArray['pixabay_api_key'] : '' }}">                                                           <span>
                                    {{ __(' Don\'t know how to grab api key ? ') }} 
                                    <a href="https://pixabay.com/api/docs/" target="_blank">
                                    {{ __(' Click Here  ') }}     
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=_G2VK_wbHlM&t=54s" target="_blank">
                                    {{ __('Video Tutorial') }}                                                
                                    </a>
                                    </span>
                                </div>
                                <div class="pixabay_api_message bb-api-status"></div>
                                <div class="bb-btn-wrapper">
                                    @if(isset($settingsArray['pixabay_api_key']))
                                        <a href="javascript:void(0)" id="bb_pixabay_api_clear" data-apiclear="pixabay_api" class="bb-btn bb_api_clear">{{ __(' Disconnect ') }}</a>
                                    @else
                                       <a href="javascript:void(0)" id="bb_pixabay_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Tab content Five -->
                <div class="bb-single-tab setting5" id="">
                    <div class="bb-tab-section">
                    <form action="">
                        <div class="bb-content has-title">
                            <div class="bb-card">
                                <div class="bb-from-wrapper">
                                <div class="bb-title-box">
                                    <h4 class="bb-form-title">
                                      {{ __(' Google Gemini API Setting ') }}                                     
                                    </h4>
                                    <p>{{ __('Google\'s creative collaborator that helps you generate Content') }}</p>
                                </div>
                                <div class="bb-input-wrapper">
                                    <label for="cbc_open_api_key"> 
                                    {{ __('Enter API Key ') }}                                          
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter API Key') }}" id="google_bard_api" name="google_bard_api" value="{{ isset($settingsArray['google_bard_api_key']) ? $settingsArray['google_bard_api_key'] : '' }}"> 
                                    <span>
                                    {{ __(' Don\'t know how to grab api key ?') }}
                                    <a href="https://console.cloud.google.com/apis/credentials" target="_blank">
                                    {{ __('Click Here') }}
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=ExkHGpTw6Wc" target="_blank">
                                    {{ __('Video Tutorial') }}                                                
                                    </a>
                                    </span>
                                </div>
                                <div class="bard_api_message bb-api-status"></div>
                                <div class="bb-btn-wrapper">
                                        @if(isset($settingsArray['google_bard_api_key']))
                                          <a href="javascript:void(0)" id="bb_google_bard_api_clear" data-apiclear="google_bard_api" class="bb-btn bb_api_clear">{{ __('Disconnect') }}</a>
                                        @else
                                        <a href="javascript:void(0)" id="bb_google_bard_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                        @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Tab content Six -->
                <div class="bb-single-tab setting6" id="">
                    <div class="bb-tab-section">
                    <form action="">
                        <div class="bb-content has-title">
                            <div class="bb-card">
                                <div class="bb-from-wrapper">
                                <div class="bb-title-box">
                                    <h4 class="bb-form-title">
                                    {{ __('  Leonardo.Ai API Setting    ') }}                                     
                                    </h4>
                                    <p>{{ __(' Create production-quality visual assets for your projects with unprecedented quality, speed, and style-consistency ') }} </p>  
                                </div>
                                <div class="bb-input-wrapper">
                                    <label for="cbc_open_api_key"> 
                                    {{ __(' Enter API Key ') }}         
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter API Key') }}" id="leonardo_api" name="leonardo_api" value="{{ isset($settingsArray['leonardo_api_key']) ?  $settingsArray['leonardo_api_key'] : '' }}">                                                         <span>
                                    {{ __(' Don\'t know how to grab api key ?  ') }}     
                                    <a href="https://docs.leonardo.ai/reference/getuserself" target="_blank">
                                   {{ __(' Click Here ') }}                                            
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=SLyOOYZpeNY" target="_blank">
                                    {{ __('Video Tutorial') }}                                                
                                    </a>
                                    </span>
                                </div>
                                <div class="bard_api_message bb-api-status"></div>
                                <div class="bb-btn-wrapper">
                                        @if(isset($settingsArray['leonardo_api_key']))
                                          <a href="javascript:void(0)" id="bb_leonardo_api_clear" data-apiclear="leonardo_api" class="bb-btn bb_api_clear">{{ __(' Disconnect ') }}</a>
                                        @else
                                          <a href="javascript:void(0)" id="bb_leonardo_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                        @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Tab Number 7-->
                <div class="bb-single-tab setting7" id="">
                    <div class="bb-tab-section">
                    <form action="">
                        <div class="bb-content has-title">
                            <div class="bb-card">
                                <div class="bb-from-wrapper">
                                <div class="bb-title-box">
                                    <h4 class="bb-form-title">
                                       {{ __(' Aspose API Setting ') }}                                     
                                    </h4>
                                    <p>{{ __(' It is helpful to convert PDF to EPUB format ') }}</p>
                                </div>
                                <div class="bb-input-wrapper">
                                    <label for="aspose_api"> 
                                    {{ __(' Enter Client ID  ') }}     
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter Client ID') }}" id="aspose_api" name="aspose_api" value="{{ isset($settingsArray['aspose_api_key']) ? $settingsArray['aspose_api_key'] : '' }}">                                                 
                                </div>
                                <div class="bb-input-wrapper">                           
                                    <label for="client_secret"> 
                                    {{ __(' Client Secret ') }}                                           
                                    </label>
                                    <input type="text" placeholder="{{ __('Enter Client Secret') }}" id="client_secret" name="client_secret" value="{{ isset($settingsArray['aspose_client_secret']) ?  $settingsArray['aspose_client_secret'] : '' }}">   
                                    <span> 
                                    {{ __(' Don\'t know how to grab api key ?  ') }}
                                    <a href="https://docs.aspose.com/" target="_blank">
                                    {{ __(' Click Here ') }}                                                
                                    </a>
                                    <a href="https://www.youtube.com/watch?v=Clr0i3TsyT0" target="_blank">
                                    {{ __('Video Tutorial') }}                                                
                                    </a>
                                    </span>
                                </div>
                                <div class="aspose_api_message bb-api-status"></div>
                                    <div class="bb-btn-wrapper">  
                                        @if(isset($settingsArray['aspose_api_key']))
                                           <a href="javascript:void(0)" id="bb_aspose_api_clear" data-apiclear="aspose_api" class="bb-btn bb_api_clear">{{ __(' Disconnect ') }}</a>
                                        @else
                                           <a href="javascript:void(0)" id="bb_aspose_api_save" data-apiclear="pexels_api" class="bb-btn">{{ __('Save') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>