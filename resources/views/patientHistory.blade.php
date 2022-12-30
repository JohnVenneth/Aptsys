@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @if (session('status'))
            <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
        @endif
        <div class="space-y-4 w-full bg-gray-100 p-6 rounded-lg">
            <div class="flex-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <td><h1 class="text-2xl">Registered Patients</h1></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="block">
                                    <input type="text" name="searchPat" id="searchPat" placeholder="Search Patient" class="w-full p-2">
                                </div>
                            </td>

                            <th><a href="{{ route('addPatient') }}"><button class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Add Patient</button></a></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="searchResult">

            </div>

            <div class="w-auto bg-white">
                <table class="PatTable table-auto min-w-full text-center">
                    <thead>
                      <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Firstname</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Middlename</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">lastname</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Contact</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if($patients->count())
                            @foreach ($patients as $patient)
                            <tr>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">{{ $patient->PatFirstName }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">{{ $patient->PatMiddleName }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">{{ $patient->PatLastName }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">{{ $patient->PatContact }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">
                                    <a href="/patient/{{ $patient->id }}">
                                        <button class=" border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">View</button>
                                    </a>
                                </td>
                              </tr>
                            @endforeach
                        @else
                            <p>There are no Patients Registered</p>
                            <p><a href="{{ route('addPatient') }}" class="border-solid mx-px my-py py-1 px-1 rounded transition duration-200 hover:bg-blue-700 hover:text-white text-base">Add Patient</a></p>
                        @endif

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <script>
        var app = {{ Js::from($patients) }};
        //console.log(app[1].PatFirstName);

        $("#searchPat").on('input', function(e){
        $target = $(e.target);

        var schinpt = $('#searchPat').val();
        //var Patient = [];

        var html = '<table><tbody>';
        var MatchCount = 0;

        for(var i=0; i<app.length; i++){
            if(app[i].PatFirstName.indexOf(schinpt)!=-1 && schinpt.length!=0){
            MatchCount++;
            html+='<tr><td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">'+app[i].PatFirstName+'</td><td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">'+app[i].PatMiddleName+'</td><td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">'+app[i].PatLastName+'</td><td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500">'+app[i].PatContact+'</td><td class="px-6 py-2 whitespace-no-wrap border-b border-gray-500"><a href="/patient/'+app[i].id+'"><button class=" border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">View</button></a></td></tr>';
            }
        }

        if(MatchCount==0){
            html+='<tr><td> No Match Found </td></tr>';
        }

        if(schinpt.length==0){
            html='';
        $('.searchResult').html(html);
        }else{
            html+='</tbody></table>';
            $('.searchResult').html(html);
        }



    });
    </script>
@endsection
