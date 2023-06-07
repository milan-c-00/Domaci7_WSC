<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update contact') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container w-50 shadow p-5 rounded">
            <h2 class="text-secondary text-center mb-3">Update contact info</h2>
            <form id="contact-form" action="{{route('contacts.update', $contact)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mt-2">
                    <input type="text" required placeholder="First name" name="first_name" value={{ old('first_name', $contact->first_name) }} class="form-control">
                    @error('first_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <input type="text" required placeholder="Last name" name="last_name" value={{ old('last_name', $contact->last_name) }} class="form-control">
                    @error('last_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <input type="email" required placeholder="E-mail" name="email" value={{ old('email', $contact->email) }} class="form-control">
                    @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="avatar">Choose avatar (keeps old if not)</label>
                    <input type="file" id="avatar" placeholder="Choose avatar" name="avatar" class="form-control">
                </div>
                <input type="hidden" name="user_id" value={{auth()->user()->id}}>
                <input type="hidden" name="contact_id" value={{ $contact->id }}>
                <button type="submit" class="btn btn-outline-primary col-2 mt-2">Save</button>
            </form>

        </div>
        @if($contact->image)
            <div class="container w-50 shadow p-3 mt-3 rounded">
                <form action="{{ route('images.delete', $contact->image ) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger">Remove avatar</button>
                </form>
            </div>
        @endif

    </div>
</x-app-layout>
