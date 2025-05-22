<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

class ContactController extends Controller
{
    public function index()
    {

        $contacts = Contact::when(request()->keyword, function (Builder $query) {
            $query->where('title', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('dashboard.pages.contact.index', compact('contacts'));

    }

    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'active']);

        return view('dashboard.pages.contact.show', compact('contact'));
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        if (!$contact) {
            return to_route('admin.contact.index')->with('error', 'Contact not found');
        }
        return to_route('admin.contact.index')->with('success', 'Contact deleted successfully');

    }
}
