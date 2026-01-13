<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactFormController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $this->extractContactData($request);
        if ($request->input('action') === 'back') {
            return redirect('/')->withInput($contact);
        }

        $contact['tel'] = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');
        $category = Category::find($request->input('category_id'));
        $contact['category'] = $category ? $category->content : '';
        $contact['gender_label'] = Contact::GENDER_LABELS[(int) $contact['gender']] ?? '';

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $this->extractContactData($request);
        $contact['tel'] = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');
        unset($contact['tel1'], $contact['tel2'], $contact['tel3']);
        Contact::create($contact);

        return view('thanks');
    }

    private function extractContactData(ContactRequest $request): array
    {
        return $request->only([
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'detail',
        ]);
    }

}
