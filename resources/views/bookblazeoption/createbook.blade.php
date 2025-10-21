
<x-app-layout>
<div class="bb-page-content">
      <!-- Content categories -->
      <div class="bb-propt-categories">
            <ul>
               <li>
                  <input type="radio" name="promptCat" id="catStory" value="storycreator" checked="" datacate="{{ __('Story of') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/story.png') }}" alt="{{ __('Story Creator') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Story Creator') }}
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="booksmaker" id="catBook" datacate="{{ __('Write Book of') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/book.png') }}" alt="{{ __('book') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Books Maker') }}
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="novelcreator" id="catNovel" datacate="{{ __('Write novel of') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/novel.png') }}" alt="{{ __('novel') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Novel Creator') }}
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="poemcreator" id="catPoem" datacate="{{ __('Write poem on') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/poem.png') }}" alt="{{ __('poem') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Poem Creator') }}
                        </div>
                  </div>
               </li>
               <li>
               <input type="radio" name="promptCat" value="formalletter" id="catLetter" datacate="{{ __('Write letter on') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/letter.png') }}" alt="{{ __('letter') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Formal Letter ') }}
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="preports" id="catReport" datacate="{{ __('Write report on') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/report.png') }}" alt="{{ __('report') }}">
                        </div>
                        <div class="cat-tilte">
                        {{ __('Project Reports') }}
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="presentations" id="catPresentation" datacate="{{ __('Write presentation on') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/presentation.png') }}" alt="{{ __('presentation') }}">
                        </div>
                        <div class="cat-tilte">
                           Presentations Maker
                        </div>
                  </div>
               </li>
               <li>
                  <input type="radio" name="promptCat" value="customcontent" id="catCustom" datacate="{{ __('Write content on') }}">
                  <div class="bb-propt-cat-box">
                        <div class="cat-img-icon">
                           <img src="{{ asset('images/category/custom.png') }} " alt="{{ __('custom') }}">
                        </div>
                        <div class="cat-tilte">
                           {{ __('Custom Content ') }}
                        </div>
                  </div>
               </li>
            </ul>
      </div>
      <!--Page Content -->
      <div class="bb-main-content has-two-col bb-story-page story-not-generated">
            <div class="bb-filter-wrap">
               <div class="bb-from-wrapper bb-card">
                  <div class="bb-filter-wrap">
                  <div class="bb-filter-aside">
                        <div class="bb-cover-img-wrap">
                           <div class="bb-input-wrapper layoutstyle mb-0">
                              <label>{{ __('Add Cover Image') }}</label>
                              <!---cover image button-->
                              <a href="javascript:void(0);" bb-open-modal="childBookGalleryModal" id="pdf_cover" data-image-id="cover_image" class="bb-cover-img-link"><span>{{ __('Select Cover Image') }}</span></a>
                              <!---cover image end-->
                           </div>
                           <a href="javascript:void(0);" bb-open-modal="childBookCoverImageSetting" class="bb-cover-stting-link">{{ __('Cover Image Settings') }}</a>
                        </div>
                        <!---Add water Mark Start-->
                        <div class="bb-input-wrapper">
                           <label for="">{{ __('Cover Image Heading') }}</label>
                           <textarea class="textoptions_textarea bb-text-field" placeholder="{{ __('Type Text Here..') }}"></textarea>
                           <div class="wateter-mark-actions">
                              <a href="javascript:void(0);" class="bb-btn btn-sm" id="au_add_text">{{ __('Add Text') }}</a>
                              <a href="javascript:void(0);" class="bb-btn btn-sm  bb-text-delete-option">{{ __('Remove Text') }}</a>
                              <a href="javascript:void(0);" class="bb-btn btn-sm" id="bb_image_capture_btn">{{ __('Save') }}</a>
                           </div>
                        </div>
                        <div class="bb-input-wrapper">
                           <label for="color_text">{{ __('Text Color') }}</label>
                           <span class="bb-ovrlay-clr-piker" id="color_text"><span class="bb-ovrlay-clr" id="colorselector_text">
                           </span> 
                          {{ __(' Click & Select Color') }}</span>
                        </div>
                        <div class="bb-input-wrapper">
                           <label for="textoptions_font_tranformation">{{ __('Text Transform & Weight') }}</label>
                           <div class="d-flex bb-font-weight-transfrom">
                              <select id="textoptions_font_tranformation" class="bb-text-tranformation">
                              <option value="none">{{ __('Transformation') }}</option>
                              <option value="uppercase">{{ __('Uppercase') }}</option>
                              <option value="lowercase">{{ __('Lowercase') }}</option>
                              <option value="capitalize">{{ __('Capitalize') }}</option>
                              </select>
                              <select name="" id="textoptions_font_weight" class="required au_cs_select au_text_font_weight" data-error=" {{ __('Please select Font family') }}">
                              <option value="100">{{ __('100 Thin (Hairline)') }}</option>
                              <option value="200">{{ __('200 Extra Light (Ultra Light)') }}</option>
                              <option value="300">{{ __('300 Light') }}</option>
                              <option value="400">{{ __('400 Normal (Regular)') }}</option>
                              <option value="500">{{ __('500 Medium') }}</option>
                              <option value="600">{{ __('600 Semi Bold (Demi Bold)') }}</option>
                              <option value="700">{{ __('700 Bold') }}</option>
                              <option value="800">{{ __('800 Extra Bold (Ultra Bold)') }}</option>
                              <option value="900">{{ __('900 Black (Heavy)') }}</option>
                              </select>
                           </div>
                        </div>
                        <div class="bb-input-wrapper">
                           <label for="textoptions_font_family">
                           {{ __('Font Family &amp; Size') }}</label>
                           <div class="d-flex bb-font-family-size">
                              <select name="textoptions_font_family" id="textoptions_font_family" class="required bb-font-family" data-error="{{ __('Please select Font family') }}">
                              <option value="montserrat">{{ __('Montserrat') }}</option>
                              <option value="lato">{{ __('Lato') }}</option>
                              <option value="poppins">{{ __('Poppins') }}</option>
                              <option value="cursive">{{ __('Cursive') }}</option>
                              <option value="cardo">{{ __('Cardo') }}</option>
                              <option value="roboto">{{ __('Roboto') }}</option>
                              <option value="raleway">{{ __('Raleway') }}</option>
                              <option value="ubuntu">{{ __('Ubuntu') }}</option>
                              <option value="droid">{{ __('Droid') }} </option>
                              <option value="hind">{{ __('Hind') }}</option>
                              <option value="oxygen">{{ __('Oxygen') }}</option>
                              <option value="oswald">{{ __('Oswald') }}</option>
                              </select>
                              <select name="textoptions_font_size" id="textoptions_font_size" class="required au_cs_select au_text_font_size" data-error="{{ __('Please select Font Size') }}">
                              <option value="14px">{{ __('14px') }}</option>
                              <option value="15px">{{ __('15px') }}</option>
                              <option value="16px">{{ __('16px') }}</option>
                              <option value="17px">{{ __('17px') }}</option>
                              <option value="18px">{{ __('18px') }}</option>
                              <option value="19px">{{ __('19px') }}</option>
                              <option value="20px">{{ __('20px') }}</option>
                              <option value="21px">{{ __('21px') }}</option>
                              <option value="22px">{{ __('22px') }}</option>
                              <option value="23px">{{ __('23px') }}</option>
                              <option value="24px">{{ __('24px') }}</option>
                              <option value="25px">{{ __('25px') }}</option>
                              <option value="26px">{{ __('26px') }}</option>
                              <option value="27px">{{ __('27px') }}</option>
                              <option value="28px">{{ __('28px') }}</option>
                              <option value="29px">{{ __('29px') }}</option>
                              <option value="30px">{{ __('30px') }}</option>
                              <option value="31px">{{ __('31px') }}</option>
                              <option value="32px">{{ __('32px') }}</option>
                              <option value="33px">{{ __('33px') }}</option>
                              <option value="34px">{{ __('34px') }}</option>
                              <option value="35px">{{ __('35px') }}</option>
                              <option value="36px">{{ __('36px') }}</option>
                              <option value="37px">{{ __('37px') }}</option>
                              <option value="38px">{{ __('38px') }}</option>
                              <option value="39px">{{ __('39px') }}</option>
                              <option value="40px">{{ __('40px') }}</option>
                              <option value="41px">{{ __('41px') }}</option>
                              <option value="42px">{{ __('42px') }}</option>
                              <option value="43px">{{ __('43px') }}</option>
                              <option value="44px">{{ __('44px') }}</option>
                              <option value="45px">{{ __('45px') }}</option>
                              <option value="46px">{{ __('46px') }}</option>
                              <option value="47px">{{ __('47px') }}</option>
                              <option value="48px">{{ __('48px') }}</option>
                              </select>
                           </div>
                        </div>
                        <!---Add water Mark End-->
                        <div class="bb-input-wrapper layoutstyle">
                           <label> {{ __(' PDF Design Style') }} </label>
                           <div class="bb-input-type-radio">
                              <!-- Story Layout  -->
                              <ul class="bb-story-styles" style="display: flex;">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_storycreator" value="bb-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/default.jpg') }}" alt="{{ __('default') }}">
                                       <h4>{{ __(' Default') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/default.jpg') }}" target="_blank">
                                       {{ __(' Preview') }}                                             </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_storycreator" value="bb-story-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/style1.jpg') }}" alt="{{ __('thumb') }}">
                                       <h4> {{ __(' Style One') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/style1.jpg') }}" target="_blank">
                                       {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_storycreator" value="bb-story-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/style2.jpg') }}" alt="{{ __('style2') }}">
                                       <h4> {{ __(' Style Two') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/style2.jpg') }}" target="_blank">
                                       {{ __(' Preview') }}                                         
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_storycreator" value="bb-story-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/style3.jpg') }}" alt="{{ __('thumb') }}">
                                       <h4> {{ __(' Style Three') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/style3.jpg') }}" target="_blank">
                                       {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Book Maker  -->
                              <ul class="bb-book-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_booksmaker" value="bb-book-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/book-thumb1.jpg') }}" alt="{{ __(' thumb1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/book-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                             
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_booksmaker" value="bb-book-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/book-thumb2.jpg') }}" alt="{{ __(' thumb2') }}">
                                       <h4> {{ __(' Style One') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/book-thumb2.jpg') }}" target="_blank">
                                       {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_booksmaker" value="bb-book-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/book-thumb3.jpg') }}" alt="{{ __(' thumb3') }}">
                                       <h4> {{ __(' Style Two') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/book-thumb3.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_booksmaker" value="bb-book-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/book-thumb4.jpg') }}" alt="{{ __('thumb4') }}">
                                       <h4> {{ __(' Style Three') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/book-thumb4.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Novel Layout  -->
                              <ul class="bb-novel-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_novelcreator" value="bb-novel-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/novel-thumb1.jpg') }}" alt="{{ __('thumb1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/novel-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_novelcreator" value="bb-novel-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/novel-thumb2.jpg') }}" alt="{{ __('thumb2') }}">
                                       <h4> {{ __(' Style One') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/novel-thumb2.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_novelcreator" value="bb-novel-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/novel-thumb3.jpg') }}" alt="{{ __('thumb3') }}">
                                       <h4>{{ __(' Style Two ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/novel-thumb3.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_novelcreator" value="bb-novel-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/novel-thumb4.jpg') }}" alt="{{ __('thumb4') }}">
                                       <h4> {{ __(' Style Three') }} </h4>
                                       <a href="assets/images/pdf-thumb/novel-thumb4.jpg" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Poem Layout  -->
                              <ul class="bb-poem-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_poemcreator" value="bb-poem-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/poem-thumb1.jpg') }}" alt="{{ __('thumb1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/poem-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_poemcreator" value="bb-poem-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/poem-thumb2.jpg') }}" alt="{{ __('thumb2') }}">
                                       <h4> {{ __(' Style One') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/poem-thumb2.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_poemcreator" value="bb-poem-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/poem-thumb3.jpg') }}" alt="{{ __('poem-thumb3') }}">
                                       <h4> {{ __(' Style Two') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/poem-thumb3.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_poemcreator" value="bb-poem-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/poem-thumb4.jpg') }}" alt="{{ __('poem-thumb4') }}">
                                       <h4> {{ __(' Style Three') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/poem-thumb4.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Letter Layout  -->
                              <ul class="bb-letter-layout-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_formalletter" value="bb-letter-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/letter-thumb1.jpg') }}" alt="{{ __('letter-thumb1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/letter-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_formalletter" value="bb-letter-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/letter-thumb2.jpg') }}" alt="{{ __('letter-thumb2') }}">
                                       <h4> {{ __(' Style One') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/letter-thumb2.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_formalletter" value="bb-letter-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/letter-thumb3.jpg') }}" alt="{{ __('letter-thumb3') }}">
                                       <h4> {{ __(' Style Two') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/letter-thumb3.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_formalletter" value="bb-letter-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/letter-thumb4.jpg') }}" alt="{{ __('letter-thumb4') }}">
                                       <h4> {{ __(' Style Three') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/letter-thumb4.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Project Report Layout  -->
                              <ul class="bb-project-report-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_preports" value="bb-project-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/report-thumb1.jpg')}}" alt="{{ __('report-thumb1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/report-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_preports" value="bb-project-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/report-thumb2.jpg')}}" alt="{{ __('report-thumb2') }}">
                                       <h4>{{ __(' Style One ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/report-thumb2.jpg')}}" target="_blank">
                                        {{ __(' Preview') }}  
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_preports" value="bb-project-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/report-thumb3.jpg')}}" alt="{{ __('report-thumb3') }}">
                                       <h4>{{ __(' Style Two ') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/report-thumb3.jpg')}}" target="_blank">
                                         {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_preports" value="bb-project-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/report-thumb4.jpg') }}" alt="{{ __('report-thumb4') }}">
                                       <h4>{{ __(' Style Three ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/report-thumb4.jpg') }}" target="_blank">
                                         {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Presentation Layout  -->
                              <ul class="bb-presentation-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_presentations" value="bb-presentation-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/presentation-thumb1.jpg') }}" alt="{{ __('presentation') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/presentation-thumb1.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_presentations" value="bb-presentation-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/presentation-thumb2.jpg') }}" alt="{{ __('presentation-thumb') }}">
                                       <h4> {{ __(' Style One') }} </h4>
                                       <a href="{{ asset('images/pdf-thumb/presentation-thumb2.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_presentations" value="bb-presentation-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/presentation-thumb3.jpg') }}" alt="{{ __('presentation-thumb3') }}">
                                       <h4>{{ __(' Style Two ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/presentation-thumb3.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_presentations" value="bb-presentation-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/presentation-thumb4.jpg') }}" alt="{{ __('presentation') }}">
                                       <h4>{{ __(' Style Three ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/presentation-thumb4.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              </ul>
                              <!-- Custom COntent Layout  -->
                              <ul class="bb-custom-content-styles">
                              <li>
                                    <input type="radio" name="bookLayoutStyle_customcontent" value="bb-custom-default-style" checked="">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/custom-content1.jpg') }}" alt="{{ __('custom-content1') }}">
                                       <h4> {{ __(' Default') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/custom-content1.jpg') }}" target="_blank">
                                         {{ __(' Preview') }}                                          
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_customcontent" value="bb-custom-style-one">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/custom-content2.jpg') }}" alt="{{ __(' custom') }}">
                                       <h4> {{ __(' Style One') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/custom-content2.jpg') }}" target="_blank">
                                        {{ __(' Preview') }}
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_customcontent" value="bb-custom-style-two">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/custom-content3.jpg') }}" alt="{{ __('custom') }}">
                                       <h4> {{ __(' Style Two') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/custom-content3.jpg') }}" target="_blank">
                                         {{ __(' Preview') }}                                         
                                       </a>
                                    </div>
                              </li>
                              <li>
                                    <input type="radio" name="bookLayoutStyle_customcontent" value="bb-custom-style-three">
                                    <div class="bb-pdf-box">
                                       <span></span>
                                       <img src="{{ asset('images/pdf-thumb/custom-content4.jpg') }}" alt="{{ __(' custom') }}">
                                       <h4>{{ __(' Style Three ') }}</h4>
                                       <a href="{{ asset('images/pdf-thumb/custom-content4.jpg') }} " target="_blank">
                                        {{ __(' Preview') }}                                           
                                       </a>
                                    </div>
                              </li>
                              </ul>
                           </div>
                        </div>
                        <!-- Title Fonts Setting  -->
                        <div class="bb-typo-tab-wrap">
                           <div class="bb-tab-navigation">
                              <ul>
                              <li class="active">
                                    <a href="#tab1">{{ __(' Title Style') }}</a>
                              </li>
                              <li>
                                    <a href="#tab2">{{ __(' Font Style ') }}</a>
                              </li>
                              </ul>
                           </div>
                           <div class="bb_tab_content">
                              <div id="tab1" class="bb_tab_section">
                              <div class="bb-input-wrapper">
                                    <label>{{ __(' Title Family ') }}</label>
                                    <select id="textTitleFamily" name="textTitleFamily" class="bb-story-title-family">
                                       <option value="inherit" data-category="sans-serif" style="font-family:inherit"> {{ __('Select') }}</option>
                                       <option value="Caveat" data-category="cursive" style="font-family:Caveat"> {{ __('Caveat') }}</option>
                                       <option value="Courgette" data-category="cursive" style="font-family:Courgette">{{ __(' Courgette') }}</option>
                                       <option value="Dai Banna SIL" data-category="serif" style="font-family:Dai Banna SIL">{{ __(' Dai Banna SIL') }}</option>
                                      
                                       <option value="EB Garamond" data-category="serif" style="font-family:EB Garamond">{{ __('EB Garamond ') }}</option>
                                       <option value="Jost" data-category="sans-serif" style="font-family:Jost">{{ __(' Jost') }}</option>
                                       <option value="Lexend" data-category="sans-serif" style="font-family:Lexend">{{ __(' Lexend') }}</option>
                                       <option value="Montserrat" data-category="sans-serif" style="font-family:Montserrat"> {{ __(' Montserrat') }}</option>
                                       <option value="Noto Sans" data-category="sans-serif" style="font-family:Noto Sans">{{ __(' Noto Sans ') }}</option>
                                       <option value="Open Sans" data-category="sans-serif" style="font-family:Open Sans"> {{ __(' Open Sans') }}</option>
                                       <option value="Oswald" data-category="sans-serif" style="font-family:Oswald"> {{ __(' Oswald') }}</option>
                                       <option value="Oxygen" data-category="sans-serif" style="font-family:Oxygen"> {{ __(' Oxygen') }}</option>
                                       <option value="Poppins" data-category="sans-serif" style="font-family:Poppins"> {{ __(' Poppins') }}</option>
                                       <option value="ABeeZee" data-category="sans-serif" style="font-family:ABeeZee"> {{ __(' ABeeZee') }}</option>
                                       <option value="Raleway" data-category="sans-serif" style="font-family:Raleway"> {{ __(' Raleway') }}</option>
                                       <option value="Roboto" data-category="sans-serif" style="font-family:Roboto"> {{ __(' Roboto') }}</option>
                                       <option value="Satisfy" data-category="cursive" style="font-family:Satisfy"> {{ __(' Satisfy') }}</option>
                                       <option value="Signika Negative" data-category="sans-serif" style="font-family:Signika Negative">{{ __(' Signika Negative ') }}</option>
                                       <option value="Slabo 13px" data-category="serif" style="font-family:Slabo 13px"> {{ __(' Slabo 13px') }}</option>
                                       <option value="SourceCodePro" data-category="monospace" style="font-family:SourceCodePro"> {{ __(' SourceCodePro') }}</option>
                                       <option value="Sriracha" data-category="cursive" style="font-family:Sriracha"> {{ __(' Sriracha') }}</option>
                                       <option value="Lato" data-category="sans-serif" style="font-family:Lato"> {{ __(' Lato') }}</option>
                                       <option value="Lobster" data-category="cursive" style="font-family:Lobster"> {{ __(' Lobster') }}</option>
                                    </select>
                              </div>
                              <div class="bb-input-wrapper">
                                    <label> {{ __(' Title Weight') }}</label>
                                    <select id="textTitleWeight" name="textTitleWeight" class="title-font-weight">
                                       <option value="400" selected=""> {{ __(' Select') }}</option>
                                       <option value="100"> {{ __(' 100') }}</option>
                                       <option value="200"> {{ __(' 200') }}</option>
                                       <option value="300"> {{ __(' 300') }}</option>
                                       <option value="400"> {{ __(' 400') }}</option>
                                       <option value="500"> {{ __(' 500') }}</option>
                                       <option value="600"> {{ __(' 600') }}</option>
                                       <option value="700"> {{ __(' 700') }}</option>
                                       <option value="800"> {{ __(' 800') }}</option>
                                       <option value="900"> {{ __(' 900') }}</option>
                                    </select>
                              </div>
                              <div class="bb-input-wrapper">
                                    <label for="">{{ __(' Title Size ') }}</label>
                                    <div class="has-range-input">
                                       <input type="range" class="bb-title-size" min="10" max="100" value="20">
                                       <input type="text" class="bb-title-value" value="20px">
                                    </div>
                              </div>
                              <div class="bb-color-options">
                                    <div class="bb-input-wrapper has-color-option">
                                       <label for="color_text">{{ __('Title color') }}</label>
                                          <span class="bb-ovrlay-clr-piker" id="color_title">
                                             <span class="bb-ovrlay-clr" id="colorselector_title">
                                          </span> 
                                          {{ __(' Click & Select Color') }}
                                          </span>
                                    </div>
                              </div>
                              </div>
                              <div id="tab2" class="bb_tab_section" style="display: none;">
                              <div class="bb-input-wrapper">
                                    <label>{{ __(' Font Family ') }}</label>
                                    <select id="textFontFamily" name="textFontFamily" class="bb-story-font-family">
                                       <option value="inherit" data-category="sans-serif" style="font-family:inherit">{{ __(' Select') }}</option>
                                       <option value="Caveat" data-category="cursive" style="font-family:Caveat"> {{ __(' Caveat') }}</option>
                                       <option value="Courgette" data-category="cursive" style="font-family:Courgette"> {{ __(' Courgette') }}</option>
                                       <option value="Dai Banna SIL" data-category="serif" style="font-family:Dai Banna SIL"> {{ __('Dai Banna SIL') }}</option>
                                      
                                       <option value="EB Garamond" data-category="serif" style="font-family:EB Garamond">{{ __(' EB Garamond ') }}</option>
                                       <option value="Jost" data-category="sans-serif" style="font-family:Jost"> {{ __(' Jost') }}</option>
                                       <option value="Lexend" data-category="sans-serif" style="font-family:Lexend"> {{ __(' Lexend') }}</option>
                                       <option value="Montserrat" data-category="sans-serif" style="font-family:Montserrat"> {{ __(' Montserrat') }}</option>
                                       <option value="Noto Sans" data-category="sans-serif" style="font-family:Noto Sans"> {{ __(' Noto Sans') }}</option>
                                       <option value="Open Sans" data-category="sans-serif" style="font-family:Open Sans"> {{ __(' Open Sans') }}</option>
                                       <option value="Oswald" data-category="sans-serif" style="font-family:Oswald"> {{ __(' Oswald') }}</option>
                                       <option value="Oxygen" data-category="sans-serif" style="font-family:Oxygen"> {{ __(' Oxygen') }}</option>
                                       <option value="Poppins" data-category="sans-serif" style="font-family:Poppins"> {{ __(' Poppins') }}</option>
                                       <option value="ABeeZee" data-category="sans-serif" style="font-family:ABeeZee"> {{ __(' ABeeZee') }}</option>
                                       <option value="Raleway" data-category="sans-serif" style="font-family:Raleway"> {{ __(' Raleway') }}</option>
                                       <option value="Roboto" data-category="sans-serif" style="font-family:Roboto"> {{ __(' Roboto') }}</option>
                                       <option value="Satisfy" data-category="cursive" style="font-family:Satisfy"> {{ __(' Satisfy') }}</option>
                                       <option value="Signika Negative" data-category="sans-serif" style="font-family:Signika Negative">{{ __('Signika Negative ') }}</option>
                                       <option value="Slabo 13px" data-category="serif" style="font-family:Slabo 13px">{{ __('Slabo 13px ') }}</option>
                                       <option value="SourceCodePro" data-category="monospace" style="font-family:SourceCodePro"> {{ __('SourceCodePro') }}</option>
                                       <option value="Sriracha" data-category="cursive" style="font-family:Sriracha"> {{ __(' Sriracha') }}</option>
                                       <option value="Lato" data-category="sans-serif" style="font-family:Lato"> {{ __('Lato') }}</option>
                                       <option value="Lobster" data-category="cursive" style="font-family:Lobster">{{ __(' Lobster') }}</option>
                                    </select>
                              </div>
                              <div class="bb-input-wrapper">
                                    <label>{{ __(' Font Weight ') }}</label>
                                    <select id="textFontWeight" name="textFontWeight" class="text-font-weight">
                                       <option value="400" selected=""> {{ __(' Select') }}</option>
                                       <option value="100"> {{ __(' 100') }}</option>
                                       <option value="200"> {{ __(' 200') }}</option>
                                       <option value="300"> {{ __(' 300') }}</option>
                                       <option value="400"> {{ __(' 400') }}</option>
                                       <option value="500"> {{ __(' 500') }}</option>
                                       <option value="600"> {{ __(' 600') }}</option>
                                       <option value="700"> {{ __(' 700') }}</option>
                                       <option value="800"> {{ __(' 800') }}</option>
                                       <option value="900"> {{ __(' 900') }}</option>
                                    </select>
                              </div>
                              <div class="bb-input-wrapper">
                                    <label for="">{{ __(' Font Size ') }}</label>
                                    <div class="has-range-input">
                                       <input type="range" class="bb-font-size" min="10" max="100" value="20">
                                       <input type="text" class="bb-font-value" value="20px">
                                    </div>
                              </div>
                              <div class="bb-color-options">
                                    <div class="bb-input-wrapper">
                                       <label for="color_font">{{ __('Font color') }}</label>
                                       <span class="bb-ovrlay-clr-piker" id="color_font"><span class="bb-ovrlay-clr" id="colorselector_font">
                                       </span> 
                                    {{ __(' Click & Select Color') }}</span>
                                    </div>
                              </div>
                              <div class="bb-color-options">
                                    <div class="bb-input-wrapper">
                                       <label for="color_imageborder_color">{{ __('Image Border color') }}</label>
                                       <span class="bb-ovrlay-clr-piker" id="color_imageborder_color"><span class="bb-ovrlay-clr" id="colorselector_imagebordercolor">
                                       </span> 
                                        {{ __(' Click & Select Color') }}</span>
                                    </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
            <!-- Content Data  -->
            <div class="bb-filted-data">

               <!-- Search Form Box  -->
               <div class="bb-search-box">
                  <form id="bb_filter" method="POST">
                        @csrf
                        <div class="bb-search-head">
                           <div class="bb_response_massage"></div>
                           <h4>{{ __('Enter keyword ') }} <span> {{ __('Sometimes Google Bard does not respond as expected therefore modify your prompt and try again.') }} </span> </h4>
                           <div class="messages"></div>
                           <div class="bb-search-head-row">
                           <div class="bb-input-wrapper bb-search-wrapper">
                              <span class="bb-prompt-text"> {{ __('Story Of') }}</span>
                              <input type="text" name="bb_post_title" id="bb_post_title" placeholder="{{ __('Enter Here...') }}">
                              <input type="hidden" name="bb_post_id" id="bb_post_id" value="">
                           </div>
                           <button type="submit" name="Submit" id="bb_content_generate" class="bb-btn">
                           {{ __('Generate') }}                      
                           <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader"> 
                           </button>
                           </div>
                           <p class="bb-book-cat-title">{{ __(' Enter the keyword to get your book titles ') }}</p>
                        </div>
                  </form>
               </div>

               <div class="bb-btn-wrapper bb-action-btn">
                  <button class="bb-btn" type="button" id="bb_generate_pdf">
                   {{ __(' Submit') }}
                  <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader">                
                  </button>
                  <a href="" class="bb-btn" id="generate_title">
                   {{ __(' Generate Book ') }} 
                  <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader">     
                  </a>
                  <a href="" target="_blank" class="bb-btn" id="preview_pdf">
                   {{ __(' Preview') }} <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader">    
                  </a>
                  <a href="" download="" class="bb-btn" id="download_pdf">
                    {{ __(' Download PDF') }} 
                  <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader">      
                  </a>
                  @php
                   $aspose_api_key = isset($settingsArray['aspose_api_key']) ? $settingsArray['aspose_api_key'] : '';
                   $aspose_client_secret = isset($settingsArray['aspose_client_secret']) ? $settingsArray['aspose_client_secret'] : '';
                  @endphp
                  @if(!empty($aspose_api_key) && !empty($aspose_client_secret))
                     <a href="javascript:void(0);" class="bb-btn" id="generate_ePub">
                     {{ __(' Download ePub ') }} 
                     <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader"> 
                     </a>
                     <a href="javascript:void(0);" class="bb-btn" id="generate_mobi">
                     {{ __(' Download MOBI ') }}
                     <img src="{{ url('public/images/btn-loader.gif'); }}" class="bb-btn-loader"> 
                     </a>
                  @endif
               </div>
               <div class="bb-filted-data-inner bb-from-wrapper bb-card">
                  <!-- No Data Box Start  -->
                  <h4 class="bb-story-find-note">
                  <span>
                  <img src="{{ asset('images/info.svg') }}" alt="{{ __('information') }}">
                  </span>
                  {{ __(' Please enter prompt to generate data... ') }} 
                  </h4>
                  <!-- No Data Box End  -->
                  <!-- Main Data  -->
                  <div class="bb-main-story-box bb-story-wrapper">
                   @csrf  
                  <!-- Story Content  -->
                  <div id="default_fonts_family"></div>
                  <div id="pdfMainWrapper" data-styles="bbStyles" class="bb-main-story-content" data-bordercolor="">
                        <!-- cover image start-->
                        <div id="bb-cover-img"></div>
                        <!-- cover image End-->
                        <h2 class="bb-story-title" contenteditable="true">{{ __(' Story Title') }}</h2>
                        <div class="bb-story-section-row" id="gpt_post_content">
                           <!-- Dynamic Story Content -->      
                                               
                        </div>
                  </div>
                  </div>
               </div>
              
               <div id="pdfWrapper"></div>
            </div>
      </div>
   </div>

<!-- Modal HTML -->
<div id="childBookGalleryModal" class="bb-custom-modal">
    <div class="bb-custom-modal-dialog">
        <div class="bb-custom-modal-content">
            <span class="bb-close-modal" bb-close-modal>X</span>
            @csrf
            <div class="bb-custom-modal-body">
                <div class="bb-custom-modal-inner">
                    <h4 class="bb-modal-title">@lang('Please Select Image to Update')</h4>
                    <!-- Content here -->
                    <div class="bb-modal-tabs-container">
                        @php
                           $unsplash_api = isset($settingsArray['unsplash_api_key']) ? $settingsArray['unsplash_api_key'] : '';
                           $unsplash_active_tab = !empty($unsplash_api) ? 'active' : '';

                           $pixabay_api = isset($settingsArray['pixabay_api_key']) ? $settingsArray['pixabay_api_key'] : '';
                           $pixabay_active_tab = !empty($pixabay_api) ? 'active' : '';

                           $pexels_api = isset($settingsArray['pexels_api_key']) ? $settingsArray['pexels_api_key'] : '';
                           $pexels_active_tab = !empty($pexels_api) ? 'active' : '';

                           $leonardo_api = isset($settingsArray['leonardo_api_key']) ? $settingsArray['leonardo_api_key'] : '';
                           $leonardo_active_tab = !empty($leonardo_api) ? 'active' : '';

                           $data_keys = !empty(request()->input('data_keys')) ? sanitize_text_field(request()->input('data_keys')) : '';
                        @endphp
                        <div class="bb-top-div">
                            <div class="bb-modal-tab-navigation">
                                <div class="bb-modal-tabs-nav">
                                    <ul id="bb-tabs-nav">
                                        @if(!empty($pixabay_api))
                                            <li>
                                                <a href="javascript:;" class="bb-modal-tab-link modal-tab-active bb_modal_link bb-check {{ $pixabay_active_tab }}" id="bb-Pixabay" data-types="{{ __('Pixabay') }}" data-keys="{{ $data_keys }}"><span>{{ __('Pixabay') }}</span></a>
                                            </li>
                                        @endif
                                        @if(!empty($unsplash_api))
                                            <li>
                                                <a href="javascript:;" class="bb-modal-tab-link bb_modal_link bb-check {{ $unsplash_active_tab }}" id="bb_unsplash" data-types="{{ __('Unsplash') }}" data-keys="{{ $data_keys }}"><span>{{ __('Unsplash') }}</span></a>
                                            </li>
                                        @endif
                                        @if(!empty($pexels_api))
                                            <li>
                                                <a href="javascript:;" class="bb-modal-tab-link bb-check bb_modal_link {{ $pexels_active_tab }}" id="bb-Pexels" data-types="{{ __('Pexels') }}" data-keys="{{ $data_keys }}"><span>{{ __('Pexels') }}</span></a>
                                            </li>
                                        @endif
                                        @if(!empty($leonardo_api))
                                            <li>
                                                <a href="javascript:;" class="bb-modal-tab-link bb_modal_link bb-check {{ $leonardo_active_tab }}" id="bb-leonardo" data-types="{{ __('Leonardo') }}" data-keys="{{ $data_keys }}"><span>{{ __('Leonardo') }}</span></a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="javascript:;" class="bb-modal-tab-link bb_modal_link" id="image-upload-button" data-types="{{ __('customupload') }}"><span>{{ __('Custom Image') }}</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @if(!empty($unsplash_api) || !empty($pixabay_api) || !empty($pexels_api) || !empty($leonardo_api))
                                <div class="bb-form-search-image">
                                    <input type="text" value="" class="bb-search-image" name="title" id="bb-search-images-name">
                                    <a href="javascript:;" class="bb-image-find-name bb-btn buzz-btn" id="search-generate" data-type="{{ __('Unsplash') }}">{{ __('Find Image') }}</a>
                                </div>
                            @endif
                           <div class="bb-upload-image bb-input-wrapper">
                              <form id="imageUploadForm" enctype="multipart/form-data">
                                 @csrf
                                 <input type="file" class="bb-search-image" name="image" id="image">
                                 <button type="button"  class="bb-btn"  id="uploadBtn">{{ __('Upload Image'); }}
                                 </button>
                              </form>
                              <div id="preview"></div>
                           </div>
                        </div>
                    </div>
                    <div class="bb-form-search-topbar">
                    
                    </div>
                    <!-- Loader  -->
                    <div class="filter-loader">
                        <div class="filter-loader-box">
                           <img src="{{ asset('images/fav.png') }}" alt="{{ __('Loader') }}" />
                        </div> 
                     </div> 
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>