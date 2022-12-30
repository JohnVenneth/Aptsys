@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="w-full bg-gray-100 p-6 rounded-lg">
            @if (session('status'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
            @endif
            <a class="block py-2.5 px-4 rounded transition duration-200 text-lg">Patient Summary</a>
                @if($patients)
                    <div class="block bg-gray-200 p-6 rounded-lg text-sm">

                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td>Firstname:</td>
                                    <td id="Tfirstname">{{ $patients->PatFirstName }}</td>
                                    <th><a><button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Create Appointment</button></a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Middlename:</td>
                                    <td id="Tmiddlename">{{ $patients->PatMiddleName }}</td>

                                </tr>

                                <tr>
                                    <td>Lastname:</td>
                                    <td id="Tlastname">{{ $patients->PatLastName }}</td>
                                    <th><a><button class="Editmodal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Edit Patient Info</button></a></th>
                                </tr>

                                <tr>
                                    <td>Contact:</td>
                                    <td id="Tcontact">{{ $patients->PatContact }}</td>
                                </tr>

                                <tr>
                                    <td>Other Contact:</td>
                                    <td id="Tothercontact">{{ $patients->OtherToContact }}</td>
                                    <th><a href=""><button class="bg-transparent border border-yellow-500 hover:border-red-500 text-gray-500 hover:text-black font-bold py-2 px-4 rounded-full">Delete Patient</button></a></th>
                                </tr>

                                <tr>
                                    <td>Email:</td>
                                    <td id="Temail">{{ $patients->PatEmail  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <p>&nbsp;</p>
                    </div>

                    <div class="block bg-gray-200 p-6 rounded-lg text-sm">
                        <table class="table-fixed w-full">
                            <thead>
                                <tr>
 <!-- Header Buttons-->         <th class="bg-transparent border border-gray-500 hover:border-indigo-500 text-black hover:text-indigo-500 font-bold py-2 px-4 rounded-full"><button onclick="DispAppt()">Appointments</button></th>
                                    <th class="bg-transparent border border-gray-500 hover:border-indigo-500 text-black hover:text-indigo-500 font-bold py-2 px-4 rounded-full"><button onclick="DispCons()">Concerns</button></th>
                                    <th class="bg-transparent border border-gray-500 hover:border-indigo-500 text-black hover:text-indigo-500 font-bold py-2 px-4 rounded-full"><button onclick="DispLabs()">Lab Results</button></th>
                                </tr>
                            </thead>
                        </table>

                        <div>
                            <p>&nbsp;</p>
                        </div>

                        <div id="appt">
                        <table  class="w-full">
<!--Appointments-----------><thead class="w-full">
                            @if($appointments->count())
                                <tr>
                                    <td>Title</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Status</td>
                                    <td>action</td>
                                </tr>
                            </thead>
                            <tbody class="w-full border border-black bg-white">

                                    @foreach ($appointments as $appointment)
                                        <tr class="border border-black bg-white">
                                            <td>{{ $appointment->AppTitle }}</td>
                                            <td>{{ $appointment->AppDate }}</td>
                                            <td>{{ $appointment->AppTime }}</td>

                                            @if($appointment->AppStatus==1)
                                                <td>DONE</td>
                                            @else
                                                <td>Scheduled</td>
                                            @endif

                                            <td>
                                                <a href="/displayAppt/{{ $appointment->id }}"><button class=" border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">View</button></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <p>There are no Appointments</p>
                                        <p><button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Create Appointment</button></p>
                                    @endif
                            </tbody> <!--Appointments-->
 <!--Appointments------></table>
<!--END Appointments--></div>

                    <div id="cons" class="hidden" style="display: none;">
                    <!--Div for Textarea for add concern-->
                        <div class="w-full">
                            <textarea id="newCon" class="new-concern w-full" placeholder="Type in New Concern of the Patient"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button data-p="{{ $patients->id }}" class="add-concern bg-white border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Add Patient Concern</button>
                        </div>
<!--Patient Concerns---><table class="concern-table w-full">
                            <thead>
                                <tr>
                                    <td class="w-2/5">CONCERN</td>
                                    <td class="w-1/12">Date</td>
                                    <td class="w-1/12"></td>
                                </tr>
                            </thead>
                            <tbody class="concern-list border border-black bg-white">
                                    @if($concerns->count())
                                        @foreach ($concerns as $concern)
                                            <tr id="item-concern-{{ $concern->id }}" class="border border-black bg-white">
                                                <td id="concern-{{ $concern->id }}" contenteditable="false" class="">{{ $concern->ConcernTitle }}</td>
                                                <td>{{ $concern->created_at }}</td>
                                                <td>
                                                    <button data-c="{{ $concern->id }}" id="edit-concern-{{ $concern->id }}" class="edit-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Edit</button>
                                                    <button hidden data-c="{{ $concern->id }}" id="save-concern-{{ $concern->id }}" class="save-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Save</button>
                                                    <button hidden data-c="{{ $concern->id }}" id="cancel-concern-{{ $concern->id }}" class="cancel-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Cancel</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>There are no Appointments</p>
                                        <p><button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Create Appointment</button></p>
                                    @endif
                            </tbody>
<!--Patient Concerns---></table><!--Patient Concerns-->

                    </div>
<!--END Patient Concerns--->
                        <div id="labs" class="hidden" style="display: none;">
<!--Lab Results     ---><table class="w-full">
                        @if($labResults->count())
                            <thead>
                                    <tr>
                                        <td>Result</td>
                                        <td>Image</td>
                                    </tr>
                            </thead>
                            <tbody class="border border-black bg-white">


                                        @foreach ($labResults as $labResult )
                                            <tr>
                                                <td>
                                                    {{ $labResult->ResulTitle }}
                                                </td>
                                                <td>
                                                    <a href="{{ URL::to('/') }}/images/{{ $labResult->ResultDoc }}" target="_blank">
                                                        {{ $labResult->ResultDoc }}
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach
                            </tbody>
                            @else
                            <tbody>
                                <thead class="w-full">
                                    <tr>
                                        <th class="text center">
                                            Select an item in the Appointment Tab to Input Lab Result for this Patient
                                        </th>
                                    </tr>
                                </thead>
                            </tbody>
                            @endif
<!--Lab Results     ---></table><!--Lab Results-->
                        </div>
                    </div>
                @else
                    <p>Add Patient</p>
                @endif
            <div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    @include('modal.addapt')
    @include('modal.editPatmodal')
    <script>
        //////// update appointment status
            ApptStatus();
            function ApptStatus(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'PUT',
                url:'/updateApptStatus/'+{{ $patients->id }},
                datatype:"json",
                success:function(response) {
                   console.log(response);
                    },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    }
                });
            }

            ///// Add and Edit concern /////
            $(document).ready(function(){

                //change content-editable attribute to true and display sava buttons
                $('.concern-list').on('click','.edit-concern',function(e){
                    $target=$(e.target);
                    const conID = $target.attr('data-c');

                    $("#concern-"+conID).attr("contenteditable","true");
                    $("#concern-"+conID).addClass("border border-green-400 bg bg-green-100");
                    $("#edit-concern-"+conID).hide();
                    $("#save-concern-"+conID).show();
                    $("#cancel-concern-"+conID).show();
                });

                //Save the Edited Concern
                $('.concern-list').on('click','.save-concern',function(e){
                    $target=$(e.target);
                    const conID = $target.attr('data-c');
                    const contxt=$("#concern-"+conID).text();

                    if ($.trim(contxt)!='')
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type:'PUT',
                                url:'/editConcern',
                                data: {concernID: conID, text: contxt},
                                datatype:"json",
                                success:function(response) {
                                    console.log(response);
                                    $("#concern-"+conID).attr("contenteditable","false");
                                    $("#concern-"+conID).removeClass("border border-green-400 bg bg-green-100");
                                    $("#edit-concern-"+conID).show();
                                    $("#save-concern-"+conID).hide();
                                    $("#cancel-concern-"+conID).hide();


                                    },
                                error: function (jqXHR, exception) {
                                    console.log(jqXHR);
                                    }
                                });
                        }else{
                            alert("Something went wrong");
                        }

                });

                //Cancel the edit concern
                $('.concern-list').on('click','.cancel-concern',function(e){
                    $target=$(e.target);
                    const conID = $target.attr('data-c');

                    $("#concern-"+conID).attr("contenteditable","false");
                    $("#concern-"+conID).removeClass("border border-green-400 bg bg-green-100");
                    $("#edit-concern-"+conID).show();
                    $("#save-concern-"+conID).hide();
                    $("#cancel-concern-"+conID).hide();
                });

                //Add Concern
                $('#cons').on('click','.add-concern',function(e){
                    $target=$(e.target);
                    const patID = $target.attr('data-p');
                    const contxt=$("#newCon").val();

                    if ($.trim(contxt)!='')
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type:'POST',
                                url:'/addConcern',
                                data: {patientID: patID, text: contxt},
                                datatype:"json",
                                success:function(data) {
                                    console.log(data.response);
                        //append to concern list for table display
                                    $('.concern-list').append('<tr id="item-concern-'+data.response.id+'" class="border border-black bg-white"><td id="concern-'+data.response.id+'" contenteditable="false" class="">'+data.response.ConcernTitle+'</td><td>'+data.response.created_at+'</td><td><button data-c="'+data.response.id+'" id="edit-concern-'+data.id+'" class="edit-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Edit</button><button hidden data-c="'+data.response.id+'" id="save-concern-'+data.response.id+'" class="save-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Save</button><button hidden data-c="'+data.response.id+'" id="cancel-concern-'+data.response.id+'" class="cancel-concern border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-indigo-500 font-bold py-1 px-2 rounded-full">Cancel</button></td></tr>')


                        //append to create appoitment modal data list
                                    $('.concern-datalist').append('<option value="'+data.response.ConcernTitle+'">')

                        //clear text area
                                    $("#newCon").val("");
                                    },
                                error: function (jqXHR, exception) {
                                    console.log(jqXHR);
                                    }
                                });
                        }else{
                            alert("Something went wrong");
                        }


                });


            });//document ready closing brackets



// Display Tab Script /////////////////////////////////////
            function DispAppt() {
            var x = document.getElementById("appt");
            var y = document.getElementById("cons");
            var z = document.getElementById("labs");
                if (x.style.display === "none") {
                    x.style.display = "block";//x
                    y.style.display = "none";
                    z.style.display = "none";
                } else {
                    x.style.display = "none";
                }
        }

        function DispCons() {
            var x = document.getElementById("appt");
            var y = document.getElementById("cons");
            var z = document.getElementById("labs");
                if (y.style.display === "none") {
                    x.style.display = "none";
                    y.style.display = "block";//y
                    z.style.display = "none";
                } else {
                    y.style.display = "none";
                }
        }
        function DispLabs() {
            var x = document.getElementById("appt");
            var y = document.getElementById("cons");
            var z = document.getElementById("labs");
                if (z.style.display === "none") {
                    x.style.display = "none";
                    y.style.display = "none";
                    z.style.display = "block";//z
                } else {
                    z.style.display = "none";
                }
        }
    </script>
@endsection
