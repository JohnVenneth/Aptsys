@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="w-full bg-gray-100 p-6 rounded-lg">
            @if (session('status'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
        @endif
            <a class="block py-2.5 px-4 rounded transition duration-200 text-xl">Attendance</a>
                @if($user)
                    <div class="block bg-gray-200 p-6 rounded-lg text-sm">
                       <ul style="list-style-type:none">
                        <li>Name: {{ $user->name }}</li>
                        <li>Email: {{ $user->email }}</li>
                        <li>Contact: {{ $user->contact }}</li>
                        <li>Shift: {{ $shift->ShiftTitle }}</li>
                        <li>IN at {{ $shift->TimeIn }} - OUT at {{ $shift->TimeOut }}</li>
                       </ul>
                    </div>
                @else
                    <p>Please Log in</p>
                @endif
        </div>

        <div>
            &nbsp;
        </div>

        <div class="w-full bg-gray-100 p-6 rounded-lg">
            <div class="content-center justify-center">
                <div class="block w-full">
                    <table class="table table-auto content-center justify-center w-full">
                        <caption class="pb-8">
                            <label for="selectMonth">Choose a Month:</label>
                            <select name="selectMonth" id="selectMonth" class="pr-2">
                                <option value=0>January</option>
                                <option value=1>February</option>
                                <option value=2>March</option>
                                <option value=3>April</option>
                                <option value=4>May</option>
                                <option value=5>June</option>
                                <option value=6>July</option>
                                <option value=7>August</option>
                                <option value=8>September</option>
                                <option value=9>Octember</option>
                                <option value=10>November</option>
                                <option value=11>December</option>
                            </select>

                            <span class="pl-2">Enter Year  <input id="year" name="year" type="text" class="pl-2"></span>
                            <span class="pl-2"><button class="disAtt button text-white bg-slate-700 rounded-full py-1 px-2">Display Attendace Log</button></span>
                        </caption>
                        <thead class="border-spacing-2">
                            <tr>
                              <th class="border-b border-gray-500">DATE</th>
                              <th class="border-b border-gray-500">DAY</th>
                              <th class="border-b border-gray-500">TIME IN</th>
                              <th class="border-b border-gray-500">TIME OUT</th>
                            </tr>
                          </thead>
                          <tbody id="dateTable">

                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){

    var app = @json($attendance);
    const applength = app.length-1;

	$('.disAtt').on('click', function(){
			$("#dateTable").html('');

			const weekname = ["SUN","MON","TUE","WED","THU","FRI","SAT"];
			const selectMonth = $("#selectMonth").val();
			var inputYear = $("#year").val();

            const currentyear = new Date();
            if(!inputYear){
                inputYear= currentyear.getFullYear();
                $("#year").val(inputYear);
            }

			var dLmonth = parseInt(selectMonth)+1;
			//console.log(dLmonth);
			var dL = new Date(inputYear, selectMonth, 0);
			console.log("last day of the month =    ",dL.toString()); // last day

			var dF = new Date(inputYear, selectMonth, 1);
			console.log("first day of the month =    ",dF.toString()); // first day

			var last_d = dL.getDate();
			var first_d= dF.getDay();
            //var dissYear = dF.getFullyear();
           // $("#year").text(dissYear);
/////////////////////////////////////////
          /*      const attd = new Date(app[1].AttDate);
                const atyear = attd.getFullYear();
			    const atmonth = attd.getMonth();
			    const atday = attd.getDate();
                const atweek = attd.getDay();

                console.log(app[1].AttDate);
                console.log("the Date : ",attd);
                console.log(atyear,"-",atmonth,"-",atday,"-",atweek);

                console.log(attd.getDate() === dL.getDate());*/

/////////////////////////////////////////
			var w = first_d;
            var a = 0;
            var attd;
            var c=0;
/*FOR LOOP APPEND*/
            for(var i=1; i<=last_d;i++){//append everthing
/*initialize date values*/
            attd = new Date(app[a].AttDate);
            const loopd = new Date(inputYear, selectMonth, i);

//reset hours,minutes, seconds, and miliseconds
            attd.setHours(0,0,0,0);
            loopd.setHours(0,0,0,0);

            console.log(loopd,"><",attd);
                if(attd.getTime() === loopd.getTime()){

                    var url = '{{ URL::to('/') }}/attendancess/'+ app[a].Selfi;
                    var urli = '{{ URL::to('/') }}/attendancess/'+ app[a].SelfiOut;

                    $("#dateTable").append('<tr class="text-center"><td class="border border-gray-500">'+i+'</td><td class="text-center border border-gray-500">'+weekname[w]+'</td><td class="text-center border border-gray-500"><a href="'+url+'" target="_blank">'+app[a].AttTime+'</a></td><td class="text-center border border-gray-500"><a href="'+urli+'" target="_blank">'+app[a].AttOut+'</a></td></tr>');

                    console.log("before increment a = ", a); // 1
                    console.log("while length is ", applength); //2
                    if(a<applength){
                        a++;
                        console.log("increment a = ", a);
                    }

                } else {
                    $("#dateTable").append('<tr class="text-center border border-gray-500"><td class="border border-gray-500">'+i+'</td><td>'+weekname[w]+'</td></tr>');
                }
				if(w==6){//return week count to 0 when last week count reached
					w=0;
				}else{
				w++;}
			}

	});
});
</script>
@endsection
