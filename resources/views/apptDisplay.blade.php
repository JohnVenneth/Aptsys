@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="w-full bg-gray-100 p-6 rounded-lg">
            @if (session('status'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
            @endif
            <a class="block py-2.5 px-4 rounded transition duration-200 text-lg">Patient Appointment Session {{ $appointments->AppDate }}</a>
                @if($patients)
                    <div class="block bg-gray-200 p-6 rounded-lg text-sm">

                        <table class="table-fixed w-full">
                            <tbody>
                                <tr>
                                    <td>Firstname:</td>
                                    <td>{{ $patients->PatFirstName }}</td>
                                    <th class="w-3/5"><a href="/patient/{{ $patients->id }}"><button class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Patient Summary</button></a></th>
                                </tr>

                                <tr>
                                    <td>Middlename:</td>
                                    <td>{{ $patients->PatMiddleName }}</td>
                                    <td>&nbsp;</td>

                                </tr>

                                <tr>
                                    <td>Lastname:</td>
                                    <td>{{ $patients->PatLastName }}</td>
                                </tr>

                                <tr>
                                    <td>Contact:</td>
                                    <td>{{ $patients->PatContact }}</td>
                                </tr>

                                <tr>
                                    <td>Other Contact:</td>
                                    <td>{{ $patients->OtherToContact }}</td>
                                </tr>

                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $patients->PatEmail  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <p>&nbsp;</p>
                    </div>

                    <a class="block py-2.5 px-4 rounded transition duration-200 text-lg">Appointment</a>
<!--Appointment Table--><div class="block bg-gray-200 p-6 rounded-lg">

    <table class="border-collapse table-auto w-full text-sm">
        <thead>
          <tr>
            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-black text-left">Description</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-black text-left">Date</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-black text-left">Time</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-black text-left">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-black">{{ $appointments->AppTitle }}</td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-black">{{ $appointments->AppDate }}</td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ $appointments->AppTime }}</td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                @if($appointments->AppStatus==1)
                    <p class="text-slate-500 dark:text-green-800">DONE</p>
                @else
                <p class="text-slate-500 dark:text-blue-800">Scheduled</p>
                @endif
            </td>
          </tr>
        </tbody>
      </table>
                    </div><!--Appointment table close Div-->

                    <div>
                        <p>&nbsp;</p>
                    </div>
                    <a class="block py-2.5 px-4 rounded transition duration-200 text-lg">Concern : {{ $concerns->ConcernTitle }}</a>

                    <div class="block bg-gray-200 p-6 rounded-lg">
                        <table id="tableRemarks" class="table-fixed w-full">
                            <thead>
                                <th class="w-2/5 text-left text-lg">Remarks</th>
                            </thead>
                        </table>
                        <div class="py-2">
                            <div>
                                <table class="table- w-full">
                                    <tbody id="remarksList" class="list-disc list-outside">
                                        @if($remarks->count())
                                            @foreach ($remarks as $remark )
                                                <tr id="RemarkItem{{ $remark->id  }}" class="remarkitem border border-gray-500">
                                                    <td contenteditable="true" class="w-11/12 text-justify"><p id="Remark{{ $remark->id  }}">{{ $remark->Remarks }}</p></td>

                                                    <td class="editremark w-fit text-center">
                                                        <button id="editRemark" class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-yellow-500 font-bold py-1 px-2 rounded-full" data-r={{ $remark->id }}>E</button>

                                                        <button id="deleteRemark" data-r={{ $remark->id }} class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-red-500 font-bold py-1 px-2 rounded-full ml-2">D</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <li class="noRem">No Remarks Made Yet</li>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <p>&nbsp;</p>
                            </div>
                            <div>
                            </div>
                    <!--Remark-->
                            <div id="remarkForm">
                            <div class="mb-4">
                                    <label for="remark" class="sr-only">Remark</label>
                                    <textarea type="text" name="remark" id="remark" placeholder="type in your remarks on this appointment" class="bg-gray-100 border-2 w-full p-4 rounded-lg"></textarea>
                            </div>
                            <!-- Submit Buttin -->
                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button type="submit" data-c="{{ $concerns->id }}" data-a="{{ $appointments->id }}" id="btnAddRemark" class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Add</button>
                            </div>
                            </div>
                        </div>
                    </div><!--Remarsk DIV-->

                    <div>
                        <p>&nbsp;</p>
                    </div>

                    <div class="block content-between p-2">
                    <h1 class="inline text-lg">Lab Results </h1><button type="submit" class="modal-open float-right text-sm border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Add</button>
                    </div>

                    <div class="block bg-gray-200 p-6 rounded-lg">
<!--Lab Results     ---><table class="w-full">
                            <thead>
                                <tr>
                                    <td>Result</td>
                                    <td>Image</td>
                                </tr>
                        </thead>
                        <tbody class="border border-black bg-white">
                                @if($labresults->count())
                                    @foreach ($labresults as $labresult )
                                    <tr>
                                        <td>{{ $labresult->ResulTitle }}</td>
                                        <td><a href="{{ URL::to('/') }}/images/{{ $labresult->ResultDoc }}" target="_blank">{{ $labresult->ResultDoc }}</a></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No Lab Results Uploaded Yet</td>
                                    </tr>
                                @endif

                        </tbody>
<!--Lab Results     ---></table><!--Lab Results-->
                    </div>
                @else
                    <p>No Records Found</p>
                @endif
        </div>
    </div>
<!-- Add Image Modal -->
    @include('modal.addlabresult')
    <script>

    </script>
@endsection
