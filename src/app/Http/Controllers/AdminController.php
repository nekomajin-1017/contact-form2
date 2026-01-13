<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::with('category')->paginate(7);
        return view('admin', compact('categories', 'contacts'));
    }

    public function search(Request $request)
    {
        $query = $this->buildSearchQuery($request);
        $contacts = $query->with('category')->paginate(7)->appends($request->except('page'));
        $categories = Category::get();
        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $fileName = 'contacts.csv';
        $contacts = $this->buildSearchQuery($request)->with('category')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $columns = ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'];

        return response()->streamDownload(function () use ($contacts, $columns) {
            $stream = fopen('php://output', 'w');
            fputcsv($stream, $columns);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    "{$contact->last_name} {$contact->first_name}",
                    $contact->gender_label,
                    $contact->email,
                    '="' . $contact->tel . '"',
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail,
                ]);
            }

            fclose($stream);
        }, $fileName, $headers);
    }

    public function destroy(Request $request)
    {
        $contactId = $request->input('contact_id');
        $contact = Contact::findOrFail($contactId);
        $contact->delete();
        return redirect('/admin');
    }

    private function buildSearchQuery(Request $request)
    {
        $search = $request->input('search_word');
        $searchCategory = $request->input('category_id');
        $gender = $request->input('gender');
        $date = $request->input('date');

        $query = Contact::query();

        if ($search) {
            $query->where(function ($q) use ($search) {

                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($gender !== null && $gender !== '') {
            $query->where('gender', $gender);
        }

        if ($searchCategory !== null && $searchCategory !== '') {
            $query->where('category_id', $searchCategory);
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        return $query;
    }
}
