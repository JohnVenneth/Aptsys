$(document).ready(function(){

    //add remarks ajax
    $('#remarkForm').on('click','#btnAddRemark',function(e){
        $target=$(e.target);
        const idConcern = $target.attr('data-c');
        const idAppointment = $target.attr('data-a');
        const remarktxt=$('#remark').val();

        if ($.trim(remarktxt)!='')
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/createRemark',
                data: {remarkIn: remarktxt, concernID: idConcern, appointmentID: idAppointment},
                datatype:"json",
                success:function(response) {
                   fetchRemarks(response.data.appointment_id);
                    },
                error: function (jqXHR, exception) {
                        console.log(jqXHR);
                    }
                });

        }else{
            alert("Please Enter Remarks");
        }
    });

    //Edit Remark
    $('#remarksList').on('click','#editRemark',function(e){
        $target=$(e.target);
        const idRemark = $target.attr('data-r');
        const remarktxt=$("#Remark"+idRemark).text();

        if ($.trim(remarktxt)!='')
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'PUT',
                url:'/editRemark',
                data: {remarkID: idRemark, text: remarktxt},
                datatype:"json",
                success:function(response) {
                   console.log(response);
                    },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                    }
                });
        }else{
            alert("Something went wrong");
        }
    });

    //fetchremark
    function fetchRemarks(id)
    {
        $.ajax({
            type:"GET",
            url:"/fetchRemark/"+id,
            datatype: "json",
            success: function (response)
            {
/*Display Appointment Table*/

                $('#remarksList').html("");
                $('.noRem').remove();
                $('#remark').val('');
                $.each(response.remarks, function (key,items){
                    $('#remarksList').append('<tr id="RemarkItem'+items.id+'" class="remarkItem border border-gray-500"><td contenteditable="true" class="w-11/12 text-justify"><p id="Remark'+items.id+'">'+items.Remarks+'</p></td><td class="w-fit text-center"><button id="editRemark" class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-yellow-500 font-bold py-1 px-2 rounded-full" data-r='+items.id+'>E</button><button id="deleteRemark" data-r='+items.id+' class="border border-gray-500 hover:border-indigo-500 text-black-500 hover:text-red-500 font-bold py-1 px-2 rounded-full ml-2">D</button></td></tr>');
                });
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });
    }

    // Delete Remark
    $('#remarksList').on('click','#deleteRemark',function(e){
        $target=$(e.target);
        const idRemark = $target.attr('data-r');

        if (idRemark!=0)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'DELETE',
                url:'/deleteRemark',
                data: {remarkID: idRemark},
                datatype:"json",
                success:function(response) {
                   console.log(response);
                   $("#RemarkItem"+idRemark).remove();
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
                });
        }else{
            alert("Something went wrong");
        }
    });

});

/*$(document).ready(function(){
    $('.remarksList').on('click','#dateclick', function(e){
        $target=$(e.target);
        const monthid = $target.attr('data-m');
        const dayid = $target.attr('data-d');
        const yearid = $target.attr('data-y');

        getAppointments(yearid,monthid,dayid);

        function getAppointments(y,m,d) {
            $.ajax({
            type:'GET',
            url:'/createRemark/'+y+"/"+m+"/"+d,
            data:'jason',
            success:function(data) {
                console.log(data.appts);
/*Display Appointment Table   $('.sitems').remove();
                    $.each(data.appts, function (key,items){
                        $('.schedule').append('<tr class="sitems hover:bg-sky-200">\
                        <td class="border-b border-slate-700 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-900">'+items.AppDate+'|'+items.AppTime+'</td>\
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-800">'+items.PatFirstName+' '+items.PatLastName+'</td></tr>')
                    })
                }
            });
        }
    })
})*/

// class = .
// ID = #
