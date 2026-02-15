<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request) {
        $contact = $request->all();
        $contact['tel'] =  $request->tel;

        $category = Category::findOrFail($request->categry_id);

        return view('contact.confirm', compact('contact', 'category'));
    }

    public function store(Request $request) {
        $form = $request->only([
            'categry_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ]);

        Contact::create($form);
        return view('contact.thanks');
    }



}
