<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{

    public function index():View {

        $contacts = auth()->user()->contacts()->paginate(10);
        return view('contacts.index', ['contacts' => $contacts]);

    }

    public function store(StoreContactRequest $request)
    {

        $contact = Contact::query()->create($request->validated());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $imageController = new ImageController();
            $imageController->storeContactAvatar($contact, $request);
        }

        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact) {
        return view('contacts.edit', ['contact' => $contact]);
    }

    public function update(UpdateContactRequest $request, Contact $contact) {

        $validated = $request->validated();
        unset($validated['avatar']);
        $contact->update($validated);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $imageController = new ImageController();
            $imageController->updateContactAvatar($contact, $request);
        }
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact) {

        $contact->delete();

        return redirect()->route('contacts.index');
    }
    public function export()
    {
        return Excel::download(new ContactsExport(), 'contacts-export.xlsx');
    }





}
