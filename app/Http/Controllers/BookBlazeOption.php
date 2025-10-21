<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfData;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
class BookBlazeOption extends Controller
{
    /**
     * Create Book Options
     */
    public function bookblazetabs(){
        $user_id = Auth::id();
        $settings = Setting::all();
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        return view('bookblazeoption.createbook',compact('settingsArray'));
    }
    /**
     * Bookblaze Settings
     */
    public function bookblaze_setting(){
        $user_id = Auth::id();
        // Retrieve all settings for the user
        $settings = Setting::all();
        // If you want to organize the settings as an associative array (key => value)
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        return view('bookblazeoption.setting',compact('settingsArray'));
           
    }
    /**
     * Bookblaze Book List
     */
    public function bookblaze_book_list(){
        $user_id = Auth::id();
        $user = Auth::user();
        $user_role = $user ? $user->role : null;

        if ($user_role == 'admin') {
            $booklist = PdfData::all();
        } else {
            $booklist = PdfData::where('user_id', '=', $user_id)->get();
        }

        $bookCount = $booklist->count();

        return view('bookblazeoption.booklist', compact('booklist', 'bookCount'));
    }

    /**
     * Delete Book
     */
    public function destroy(PdfData $id)
    {
        $id->delete();
        return redirect()->route('booklist')->with('success', 'Book deleted successfully');
    }
} 