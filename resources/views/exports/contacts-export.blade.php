<table>
    <thead>
        @php($style1 = 'background-color: #57b9a8; border: 1px solid black; text-align: center; font-weight: bold;')
        <tr>
            <td style="{{$style1}}">Last name</td>
            <td style="{{$style1}}">First name</td>
            <td style="{{$style1}}">E-mail</td>
        </tr>
    </thead>
    <tbody>
        @php($style2 = 'background-color: #b4dce9; border: 1px solid black')
        @foreach($contacts as $contact)
            <tr>
                <td style="{{$style2}}">{{ $contact->last_name }}</td>
                <td style="{{$style2}}">{{ $contact->first_name }}</td>
                <td style="{{$style2}}">{{ $contact->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
