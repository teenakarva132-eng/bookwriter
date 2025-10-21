<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PdfData;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use \Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        // Create mPDF instance
        $template = base64_decode($request->input('template'));
        $headingFont = $request->input('heading_font');
        $textFont = $request->input('text_font');
        $templateStyle = $request->input('template_style');
        $bordercolor = $request->input('bd_color');
        $webToken = $request->input('_token');

        if($templateStyle =='bb-default-style'){

			$template_styles ='<style>
								.singleimage {
									border-right: 2px dashed;
									border-left: 2px dashed;
									border-color: '.$bordercolor.';
								 }
							   </style>'; 
		   
		}elseif($templateStyle =='bb-story-style-one'){

			$template_styles ='<style>
							.singleimage {
								min-height: 380px;
								object-fit: cover;
								width: 100%;
								border: 10px ridge;
							} 
						</style>';
        }     
        $bg_images1 = asset('images/style2-bg.jpg');
        $bg_images2 = asset('images/border5.png');
        $bg_images3 = asset('images/image2.png');

        $book_bg1 = asset('images/bg/book-bg1.png');
        $book_bg2 = asset('images/bg/book-bg2.png');
        $book_bg3 = asset('images/bg/book-bg3.png');
        $book_bg4 = asset('images/bg/poem-bg1.png');
        $book_bg5 = asset('images/bg/poem-bg2.png');
        $book_bg6 = asset('images/bg/poem-bg3.jpg');
        $book_bg7 = asset('images/bg/poem-bg4.jpg');
        $book_bg8 = asset('images/bg/presentation-bg.jpg');
        $book_bg9 = asset('images/bg/presentation-bg-one.jpg');
        $book_bg10 = asset('images/bg/custom-bg1.jpg');
        $book_bg11 = asset('images/bg/presentation.jpg');
        $book_bg12 = asset('images/bg/custom-background.jpg');
        $letterBgImg = asset('images/bg/custom-img.jpg');
        $htmlContent = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Ebook</title>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='.$headingFont.'&display=swapp">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='.$textFont.'&display=swap">
            </head>
            <body>
            <style>
               /**
                * PDF Specific
                */
                @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");
                :root {
                    --bb-primary: #F39F5F;
                    --bb-title-color: #1F242C;
                    --bb-font-color: #385469;
                    --bb-whiter: #ffffff;
                    --bb-border-color: #c0d1e4;
                    --bb-danger: #cb2027;
                    --bb-transition: all .3s;
                    --bb-title-fonts: Roboto, sans-serif;
                    --bb-global-fonts: Roboto, sans-serif;
                }
                *, ::after, ::before {
                    box-sizing: border-box;
                }
                a.bb_remove_section img{
                    display: none;
                } 	
                .bb-story-cover-img {
                    position: relative;
                }	
                .bb-story-title {
                    text-align: center;
                    margin: 0 00 30px;
                    font-size: 26px;
                    font-weight: 700;
                    text-transform: capitalize;
                }
                .bb-default-style .bb-story-content {
                    float: left;
                }
                .bb-story-content {
                    margin: 0 0 20px;
                }
                .bb-default-style .bb-story-img {
                    width: 45%;
                    float: left;
                }
                .bb-story-img {
                    padding: 0 15px;
                    margin: 0 0 30px;
                    position: relative;
                }
                .bb-default-style .bb-story-data {
                    width: 45%;
                    float: left;
                }
                .bb-story-data {
                    padding: 0 15px;
                    margin: 0 0 30px;
                }
                .bb-story-img a {
                    position: absolute;
                    display: inline-flex;
                    left: 0;
                    right: 0;
                    margin: auto;
                    width: fit-content;
                    bottom: -8px;
                    background: var(--bb-title-color);
                    color: var(--bb-whiter);
                    padding: 8px 15px;
                    text-decoration: none;
                    font-size: 14px;
                    border-radius: 60px;
                }
                .bb-story-data h4 {
                    margin: 0 0 15px;
                    font-weight: 700;
                    font-size: 22px;
                }
                .bb-story-data p {
                    font-size: 16px;
                    line-height: 1.8;
                    margin: 0 0 20px;
                }
                /* Default Style  */
                .bb-default-style .bb-story-content .bb-story-img img {
                    border-right: 2px dashed;
                    border-left: 2px dashed;
                    border-color: var(--bb-primary);
                }
                /* Style one  */
                .bb-story-style-one .bb-story-content > div {
                    text-align: center;
                    width: 100%;
                }
                .bb-story-style-one .bb-story-content > div.bb-story-img {
                    max-width: 1170px;
                    margin: 0 auto 40px;
                    padding: 0 250px;
                    width: 100%;
                }
                .bb-story-style-one .bb-story-content > div.bb-story-img img {
                    min-height: 380px;
                    object-fit: cover;
                    width: 100%;
                    border: 10px ridge;
                }
                .bb-story-style-one .bb-story-content > div.bb-story-img img.style-one-avtar {
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    top: 0;
                    width: 300px;
                    min-height: auto;
                    min-width: auto;
                    border: 0;
                    max-height: initial;
                }
                .bb-story-style-one .bb-story-content > div p {
                    font-size: 18px;
                }
                /* Style Two  */							
                .bb-story-style-two {
                    max-width: 980px;
                    margin: auto;
                    text-align: center;
                }
                .bb-story-style-two .bb-story-content > div {
                    text-align: center;
                    width: 100%;
                }
                .bb-story-style-two .bb-story-title {
                    background: #eeedf5;
                    display: inline-block;
                    padding: 4px 50px;
                    border-radius: 20px 20px;
                    position: relative;
                    font-size: 20px;
                    text-transform: uppercase;
                    letter-spacing: 1.2px;
                    margin: 0 auto 20px;
                }

                .bb-story-style-two .bb-story-content {
                    border: 3px dashed #ebebeb;
                    padding: 30px;
                    border-radius: 10px;
                    background: url('.$bg_images1.');
                    background-position: center !important;
                    background-repeat: repeat !important;
                }


                .bb-story-style-two .bb-story-content .bb-story-data {
                    margin: 0;
                    padding: 0;
                }
                .bb-story-style-two .bb-story-content p {
                    font-size: 20px;
                    font-weight: 500;
                }
                /* Style three  */
                .bb-story-style-three {
                    max-width: 1120px;
                    margin: auto;
                    text-align: center;
                }
                .bb-story-style-three .bb-story-content > div {
                    text-align: center;
                    width: 100%;
                }
                .bb-story-style-three .bb-story-title {
                    display: inline-block;
                    margin: 0 auto 20px;
                    position: relative;
                    font-size: 28px;
                }
                .bb-story-style-three .bb-story-content {
                    border-style: inset;
                    padding: 30px 80px 30px;
                    border-radius: 10px;
                    border: 10px solid orange;
                    background: url('.$bg_images2.');
                    background-size: 100% !important;
                    background-position: top center !important;
                    background-repeat: no-repeat !important;
                    background-repeat: repeat-y !important;
                }
                .bb-story-style-three .bb-story-content > div > img {
                    width: 100%;
                    height: 380px;
                    max-height: 480px !important;
                    object-fit: cover;
                    border: 1px dotted #fbeec5;
                }
                .bb-story-style-three .bb-story-content .bb-story-data {
                    margin: 0;
                    padding: 0;
                }
                .bb-story-style-three .bb-story-content p {
                    font-size: 20px;
                    font-weight: 500;
                }
                [data-styles="bbStyles"] {
                    margin-bottom: 30px;
                }
                .bb-story-img img.style-one-avtar {
                    display: none !important;
                }
                .bb-modal-link {
                    display: none !important;
                }
                
                /* new css
                    */
                .bb-edit-data-btn {
                    display: none !important;
                } 
                a.bb-edit-data-btn img {
                    display: none;
                }
                .bb-book-default-style .bb-story-img,
                .bb-book-style-one  .bb-story-img,
                .bb-book-style-two  .bb-story-img,
                .bb-book-style-three  .bb-story-img,
                .bb-novel-default-style  .bb-story-img,
                .bb-novel-style-one  .bb-story-img,
                .bb-novel-style-two  .bb-story-img,
                .bb-novel-style-three  .bb-story-img,
                .bb-poem-default-style  .bb-story-img, 
                .bb-poem-style-one  .bb-story-img,
                .bb-poem-style-two  .bb-story-img,
                .bb-poem-style-three  .bb-story-img,
                .bb-letter-default-style  .bb-story-img,
                .bb-letter-style-one  .bb-story-img, 
                .bb-letter-style-two  .bb-story-img, 
                .bb-letter-style-three  .bb-story-img,
                .bb-project-default-style  .bb-story-img, 
                .bb-project-style-one  .bb-story-img,
                .bb-project-style-two  .bb-story-img, 
                .bb-project-style-three  .bb-story-img,
                .bb-presentation-default-style  .bb-story-img, 
                .bb-presentation-style-one  .bb-story-img,
                .bb-presentation-style-two  .bb-story-img, 
                .bb-presentation-style-three  .bb-story-img,
                .bb-custom-default-style  .bb-story-img, 
                .bb-custom-style-one  .bb-story-img,
                .bb-custom-style-two  .bb-story-img,
                .bb-custom-style-three  .bb-story-img {
                    display: none;
                }
                .bb-cover-img {
                    display: none;
                }
                
                /*----------------------- Book Styles CSS Start -----------------------*/
                .bb-book-cover-img {
                    text-align: center;
                    margin: 0 0 30px;
                }
                .bb-book-default-style .bb-story-data,
                .bb-book-style-one .bb-story-data, 
                .bb-book-style-two .bb-story-data,
                .bb-book-style-three .bb-story-data {
                    width: 100%;
                }
                /* One */
                .bb-book-style-one {
                    background: #fafafd;
                    padding: 30px 80px;
                    background: url("'.$book_bg1.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    border-radius: 5px;
                    position: relative;
                    max-width: 1280px;
                }
                /* Two */
                .bb-book-style-two {
                    padding: 30px 80px;
                    position: relative;
                    background: url("'.$book_bg2.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    max-width: 1280px;
                }
                /* Three */
                .bb-book-style-three {
                    padding: 30px 80px;
                    position: relative;
                    background: url("'.$book_bg3.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    max-width: 1280px;
                }
                /*----------------------- Book Styles CSS End -----------------------*/
                /*------------------ Novel ------------------*/
                .bb-novel-default-style .bb-story-data,
                .bb-novel-style-one .bb-story-data, 
                .bb-novel-style-two .bb-story-data,
                .bb-novel-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-novel-default-style {
                    background: #fafafd;
                    padding: 30px 80px;
                    border-radius: 5px;
                    position: relative;
                    max-width: 1280px;
                }
                /* One */
                .bb-novel-style-one {
                    background: #fdf7ec;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                /* Two */
                .bb-novel-style-two {
                    background: #ffeee2;
                    padding: 50px 80px;
                    position: relative;
                    max-width: 1280px;
                }
                /* Three */
                .bb-novel-style-three {
                    background: #000000;
                    padding: 30px 80px;
                    border-radius: 5px;
                    position: relative;
                    max-width: 1280px;
                    color: #ffffff;
                }
                /*----------------------- Novel Styles CSS End -----------------------*/
                /*------------------ Poem ------------------*/
                .bb-poem-default-style .bb-story-data,
                .bb-poem-style-one .bb-story-data, 
                .bb-poem-style-two .bb-story-data,
                .bb-poem-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-poem-default-style {
                    background: #fafafd;
                    padding: 30px 80px;
                    background: url("'.$book_bg4.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%100%;
                    border-radius: 5px;
                    position: relative;
                    max-width: 1280px;
                }
                /* One */
                .bb-poem-style-one {
                    background: #fdf7ec;
                    padding: 30px 80px;
                    background: url("'.$book_bg5.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                /* Two */
                .bb-poem-style-two {
                    background: #ecf7fd;
                    padding: 30px 80px;
                    background: url("'.$book_bg6.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-poem-style-two p {
                    font-size: 16px;
                    max-width: 770px;
                    margin: 0 auto 30px;
                    font-weight: 600;
                }
                /* Three */
                .bb-poem-style-three {
                    background: #ecf7fd;
                    padding: 30px 80px;
                    background: url("'.$book_bg7.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-poem-style-three p {
                    font-weight: 500;
                    color: #bf5134;
                }
                /*----------------------- Poem Styles CSS End -----------------------*/
                /*------------------ letter ------------------*/
                .bb-letter-default-style .bb-story-data,
                .bb-letter-style-one .bb-story-data, 
                .bb-letter-style-two .bb-story-data,
                .bb-letter-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-letter-default-style {
                    background: #fef4e8;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    border-top: 10px solid #f7941d;
                }
                /* One */
                .bb-letter-style-one {
                    background: #eef2ff;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-letter-style-one .bb-story-title {
                    border-bottom: 3px double currentColor;
                    color: #336aea;
                }
                .bb-letter-style-one p {
                    border-bottom: 1px solid currentColor;
                    padding-bottom: 10px;
                }
                /* Two */
                .bb-letter-style-two {
                    background: #fff8ee;
                    padding: 0px 0px 30px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-letter-style-two .bb-story-title {
                    color: #ffffff;
                    background: #ffa524;
                    padding: 15px 20px;
                }
                .bb-letter-style-two p {
                    padding: 0 20px;
                }
                /* Three */
                .bb-letter-style-three {
                    background: #eef2ff;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    background: url("'.$letterBgImg.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                }
                /*----------------------- letter Styles CSS End -----------------------*/
                /*------------------ project ------------------*/
                .bb-project-default-style .bb-story-data,
                .bb-project-style-one .bb-story-data, 
                .bb-project-style-two .bb-story-data,
                .bb-project-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-project-default-style {
                    background: #fafafd;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                /* One */
                .bb-project-style-one {
                    background: #efefef;
                    text-align: center;
                    padding: 30px 80px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                /* Two */
                .bb-project-style-two {
                    background: #fdf8bc;
                    padding: 50px 60px;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-project-style-two .bb-story-title {
                    text-align: left;
                    margin: 0 0 15px;
                }
                .bb-project-style-two .bb-story-content> div {
                    padding: 0;
                    margin: 0;
                }
                /* Three */
                .bb-project-style-three {
                    background: #deefea;
                    padding: 30px 50px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-project-style-one .bb-book-cover-img, .bb-project-style-two .bb-book-cover-img, .bb-project-style-three .bb-book-cover-img, .bb-project-default-style .bb-book-cover-img {
                    display: none;
                }
                /*----------------------- Project Styles CSS End -----------------------*/
                /*------------------ presentation ------------------*/
                .bb-presentation-default-style .bb-story-data,
                .bb-presentation-style-one .bb-story-data, 
                .bb-presentation-style-two .bb-story-data,
                .bb-presentation-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-presentation-default-style .bb-presentation-box{
                    background: #fafafd;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    background: url("'.$book_bg8.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    margin: 0 0 20px;
                    min-height: 520px;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: center;
                }
                /* One */
                .bb-presentation-style-one .bb-presentation-box{
                    background: #fdf7ec;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    background: url("'.$book_bg9.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                    margin: 0 0 20px;
                    min-height: 520px;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: center;

                }
                /* Two */
                .bb-presentation-style-two .bb-presentation-box{
                    background: #124d59;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    color: #ffffff;
                    background: url("'.$book_bg11.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    margin: 0 0 20px;
                    min-height: 520px;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: center;

                }
                .bb-presentation-style-two .bb-story-title {
                    color: #ffffff;
                }
                /* Three */
                .bb-presentation-style-one .bb-presentation-box p,.bb-presentation-default-style  .bb-presentation-box p {
                    font-weight: 600;
                }
                .bb-presentation-style-three .bb-presentation-box P, .bb-presentation-style-two .bb-presentation-box p,.bb-presentation-style-one .bb-presentation-box p,.bb-presentation-default-style  .bb-presentation-box p {
                    width: 100%;
                    font-size: 42px;
                    text-align: center;
                }
                /*----------------------- presentation Styles CSS End -----------------------*/
                /*------------------ custom ------------------*/
                .bb-custom-default-style .bb-story-data,
                .bb-custom-style-one .bb-story-data, 
                .bb-custom-style-two .bb-story-data,
                .bb-custom-style-three .bb-story-data {
                    width: 100%;
                }
                /* Default  */
                .bb-custom-default-style {
                    background: #f8e2b1;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    background: url("'.$book_bg10.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100% 30%;
                }
                /* One */
                .bb-custom-style-one {
                    background: #f7e5c3;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    background: url("'.$book_bg12.'");
                    background-position: center;
                    background-repeat: repeat-y;
                    background-size: 100%;
                }
                /* Two */
                .bb-custom-style-two {
                    background: #ede5b9;
                    padding: 50px 20px;
                    position: relative;
                    max-width: 1280px;
                }
                /* Three */
                .bb-custom-style-three {
                    background: #f1f1f1;
                    padding: 30px 20px;
                    border-radius: 5px;
                    position: relative;
                    max-width: 1280px;
                }
                .bb-sa-content {
                    line-height: 1.8;
                }
                .bb-poem-style-two p {
                    font-size: 16px;
                    max-width: 100%;
                    margin: 0 auto 30px;
                    font-weight: normal;
                }
                .bb-story-cover-img {
                    text-align: center;
                    margin: 150px 0px;
                    width: 100%;
                    height: auto;
                    border:none;
                    padding-top: 20px;
                    text-align: center;
                    margin: 0 0 20px;
                }
                .bb-story-cover-img img{
                    border-right: none;
                    border-left: none;
                    max-height: 800px;
                    border: 0;
                }
                .bb-story-cover-img {
                    min-height: 850px;
                }
                .bb-story-cover-img img{
                    border: 0 !important;
                }
                [data-styles="bbStyles"] {
                    max-width: 920px;
                    margin: auto;
                }
                img {
                    max-width: 100%;
                }
                .bb-presentation-style-three .bb-presentation-box {
                    background: #1a1a53;
                    padding: 30px 20px;
                    border-radius: 0;
                    position: relative;
                    max-width: 1280px;
                    color: #ffffff;
                    margin: 0 0 20px;
                    min-height: 520px;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: center;
                }
                span.editableElement.au_draggable.au_border_box.au_edit_box.au_textelem.ui-draggable.ui-draggable-handle.editableElementActive {
                    position: relative;
                    left: -305px;
                    top: -345px;
                } 
                /*----------------------- custom Styles CSS End -----------------------*/
            </style>'.
                $template_styles. 
                $template
            .'</body>
            </html>'; 
        $data = [
            'user_id' => Auth::id(), // Set the user_id based on the authenticated user
            'title' => 'book'.Auth::id(),
            'content' => $request->input('template'),
            ]; 
        // Save data to the database
        $pdfData = PdfData::create($data);
        $fontDir = public_path('mpdf/fonts/');
        $fontData = [
            'roboto' => [
                'R' => 'Roboto-Regular.ttf', 
            ],
            'satisfy' => [
                'R' => 'Satisfy-Regular.ttf',
            ],
            'alexbrush' => [
                'R' => 'AlexBrush-Regular.ttf', 
            ],
            'caveat' => [
                'R' => 'Caveat-Regular.ttf', 
            ],
            'courgette' => [
                'R' => 'Courgette-Regular.ttf', 
            ],
            'daiBannaSIL' => [
                'R' => 'DaiBannaSIL-Regular.ttf', 
            ],
            'dancingScript' => [
                'R' => 'DancingScript-Regular.ttf', 
            ],
            'ebgaramond' => [
                'R' => 'EBGaramond-Regular.ttf', 
            ],
            'jost' => [
                'R' => 'Jost-Regular.ttf', 
            ],
            'lato' => [
                'R' => 'Lato-Regular.ttf', 
            ],
            'lexend' => [
                'R' => 'Lexend-Regular.ttf', 
            ],
            'lobster' => [
                'R' => 'Lobster-Regular.ttf', 
            ],
            'montserrat' => [
                'R' => 'Montserrat-Regular.ttf', 
            ],
            'notoSans' => [
                'R' => 'NotoSans-Regular.ttf', 
            ],
            'openSans' => [
                'R' => 'OpenSans-Regular.ttf', 
            ],
            'oswald' => [
                'R' => 'Oswald-Regular.ttf', 
            ],
            'oxygen' => [
                'R' => 'Oxygen-Regular.ttf', 
            ],
            'poppins' => [
                'R' => 'Poppins-Regular.ttf', 
            ],
            'ptsans' => [
                'R' => 'PTSans-Regular.ttf', 
            ],
            'raleway' => [
                'R' => 'Raleway-Regular.ttf', 
            ],
            'roboto' => [
                'R' => 'Roboto-Regular.ttf', 
            ],
            'signikaNegative' => [
                'R' => 'SignikaNegative-Regular.ttf', 
            ],
            'slabo13px' => [
                'R' => 'Slabo13px-Regular.ttf', 
            ],
            'sourcecodepro' => [
                'R' => 'SourceCodePro-Regular.ttf', 
            ],
            'sriracha' => [
                'R' => 'Sriracha-Regular.ttf', 
            ],
        ];
        $mpdf = new Mpdf([
            'fontDir' => $fontDir,
            'fontdata' => $fontData,
        ]);
        $mpdf->allow_charset_conversion = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->default_font = 'Roboto, sans-serif';
        // Add content to the PDF
        $mpdf->WriteHTML($htmlContent);
        $mpdf->SetDisplayMode('fullpage');
        // Save the PDF to a directory (replace 'path/to/save' with your desired path)
        $filePath = 'public/pdfs/' . $pdfData->id . '.pdf';
        $result_data = $mpdf->Output($filePath, 'F');
        $current_file = asset('public/pdfs/' . $pdfData->id . '.pdf');
        if($current_file){
            PdfData::where('id', $pdfData->id)->update(['url' =>'pdfs/'.$pdfData->id.'.pdf']);
            return response()->json(['status'=>true, 'pdf_url'=>$current_file,'message' => 'PDF generated and saved successfully']);
        }else{
            return response()->json(['status'=>false, 'pdf_url'=>'','message' => 'Something Want Wrong']);
        } 

    }
    /**
     * Book Blaze Pdf to Epub
     */
    public function bookblazeProPdfToEpub(Request $request)
    {
        $asposeToken = config('services.aspose.token');
        $pdfFile = $request->input('generate_pdf');
        $uploadsDir = public_path('storage');
        $random = Str::random(8);
        $epubFile = $uploadsDir . '/ebook-' . $random . '.epub';
        // Execute ebook-convert command
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $asposeToken,
        ])->attach('Document', file_get_contents($pdfFile), 'Document.pdf')->put('https://api.aspose.cloud/v4.0/words/convert?format=epub');

        $dataOutput = file_put_contents(public_path('storage/ebook.epub'), $response->body());

        $downloadEpub = asset('storage/ebook.epub');

        if ($response->successful()) {
            $epubs = [
                'status' => 'true',
                'epub_url' => $downloadEpub,
                'message' => 'successful',
            ];
            return json_encode($epubs);
        } else {
            $epubs = [
                'status' => 'false',
                'epub_url' => '#',
                'message' => 'API Request Failed',
            ];
            return json_encode($epubs);
        }
    }
    /**
     * Book Blaze Pdf to Mobi
     */
    public function bookblazeProPdfToMobi(Request $request)
    {
        $asposeToken = config('services.aspose.token');

        $pdfFile = $request->input('generate_pdf');
        $uploadsDir = public_path('storage');
        $random = Str::random(8);
        $mobiFile = $uploadsDir . '/ebook-' . $random . '.mobi';
        // Execute ebook-convert command
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $asposeToken,
        ])->attach('Document', file_get_contents($pdfFile), 'Document.pdf')->put('https://api.aspose.cloud/v4.0/words/convert?format=mobi');
        $dataOutput = file_put_contents(public_path('storage/ebook.mobi'), $response->body());
        $downloadMobi = asset('storage/ebook.mobi');
        $epubs = [
            'status' => 'true',
            'mobi_url' => $downloadMobi,
            'message' => 'successful',
        ];
        return json_encode($epubs);
    }
    
}
