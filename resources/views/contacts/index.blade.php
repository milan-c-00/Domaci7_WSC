<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    @if($errors->has('first_name') || $errors->has('last_name') || $errors->has('email') || $errors->has('avatar'))
        <script>
            $(document).ready(function () {
                // Open the modal automatically
                $('#openModal').trigger('click');
            });
        </script>
    @endif

    <div class="py-12">

        <div class="container shadow p-5 rounded">
            <div class="mb-3 d-flex">
                <button type="button" id="openModal" class="btn btn-success col-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    New contact
                </button>
                <a href="{{ route('contacts.export') }}" class="btn btn-outline-success col-2 ms-2">Export</a>
            </div>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th class="col-1"></th>
                    <th class="col-2">First name</th>
                    <th class="col-2">Last name</th>
                    <th class="col-2">E-mail</th>
                    <th class="col-5">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td class="col-1 align-middle">
                            <div class="avatar-container h-16 w-16 rounded-full overflow-hidden">
                                @if($contact->image)
                                    <img class="avatar" src="{{$contact->image?->path}}" alt="Avatar image">
                                @else
                                    <img class="avatar" src="{{asset('avatar.jpg')}}" alt="Avatar image">
                                @endif
                            </div>
                        </td>
                        <td class="col-2 align-middle">{{ $contact->first_name }}</td>
                        <td class="col-2 align-middle">{{ $contact->last_name }}</td>
                        <td class="col-2 align-middle">{{ $contact->email }}</td>
                        <td class="col-5 align-middle">
                            <div class="row col-12">
                                <div class="col-4">
                                    <a href="mailto:{{$contact->email}}" class="col-12 btn btn-primary">Mail</a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-outline-warning col-12">Edit</a>
                                </div>
                                <div class="col-4">
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger col-12">Delete</button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="">
                {{ $contacts->links() }}
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add new contact</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="contact-form" action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-2">
                                <input type="text" required placeholder="First name" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                @error('first_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <input type="text" required placeholder="Last name" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <input type="email" required placeholder="E-mail" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="avatar">Choose avatar (optional)</label>
                                <input type="file" id="avatar" placeholder="Choose avatar" name="avatar" class="form-control">
                                @error('avatar')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="user_id" value={{auth()->user()->id}}>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="contact-form" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
