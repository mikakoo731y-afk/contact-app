<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->buildSearchQuery($request);
        $contacts = $query->paginate(7);
        $categories = Category::all();
        $selectedContact = null;
        if ($request->filled('id')) {
            $selectedContact = Contact::with('category')->find($request->id);
        }

        return view('admin.index', compact('contacts', 'categories', 'selectedContact'));
    }

    public function export(Request $request)
    {
        $contacts = $this->buildSearchQuery($request)->get();

        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '内容'];
        $filename = "contacts_" . date('YmdHis') . ".csv";

        $callback = function () use ($csvHeader, $contacts) {
            $file = fopen('php://output', 'w');
            stream_filter_append($file, 'convert.iconv.utf-8/cp932//TRANSLIT');
            fputcsv($file, $csvHeader);

            foreach ($contacts as $contact) {
                $genderText = [1 => '男性', 2 => '女性', 3 => 'その他'][$contact->gender];
                fputcsv($file, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $genderText,
                    $contact->email,
                    $contact->category->content,
                    $contact->detail,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ]);
    }

    private function buildSearchQuery(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$keyword}%"]);
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('categry_id')) {
            $query->where('categry_id', $request->categry_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
