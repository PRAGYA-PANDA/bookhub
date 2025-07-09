<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookRequestsController extends Controller
{
    public function index()
    {
        $bookRequests = BookRequest::with('user')->get();
        Session::put('page', 'bookRequests');
        return view('admin.requestedbooks.index', compact('bookRequests'));
    }

    public function delete($id)
{
    $bookRequests = BookRequest::find($id);

    if (!$bookRequests) {
        return redirect()->back()->with('error', 'Book Request not found.');
    }

    $bookRequests->delete();

    return redirect()->back()->with('success', 'Book Request deleted successfully.');
}

}



