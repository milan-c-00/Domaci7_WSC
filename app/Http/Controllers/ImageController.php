<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function storeContactAvatar($contact, StoreContactRequest $request){

        $this->storeImage($request->file('avatar'), $contact);

    }
    private function storeImage($file, $contact){

        $name = $file->getClientOriginalName();
        $path = "storage/" . $file->store('avatars');
        $contact->image()->create([
            'name' => $name,
            'path' => $path
        ]);

    }

    public function updateContactAvatar($contact, UpdateContactRequest $request) {

        $contact->image?->delete();
        $this->storeImage($request->file('avatar'), $contact);

    }

    public function deleteAvatar(Image $image) {
        $image?->delete();
        if($image->path){
            $fileName = basename($image->path);
            Storage::delete('avatars/'.$fileName);
        }
        return redirect()->route('contacts.index');
    }

}
