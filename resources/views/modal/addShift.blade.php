 <!--Modal-->
 <div style="overflow-y: auto;" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Create Shift</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <form id="addShift">
          <!-- Cross Site Request Forgery-->
                          @csrf
          <!-- Input-->
  <!--Shift title-->    <div class="mb-4">
                                  <label for="title" class="sr-only">Label</label>
                                  <input type="text" name="title" id="title" placeholder="Label this Shift" class="bg-gray-100 border-2 w-full p-4 rounded-lg">
                              <!--Error prompt-->
                              <div class="titleErr text-red-500"></div>
                              </div>

  <!--Time IN-->  <div class="mb-4">
                                <label for="timein" class="text-sm">Time In</label>
                                <input type="time" name="timein" id="timein" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('timein') }}">
                             <!--Error prompt-->
                                    <div class="timeinErr text-red-500"></div>
                            </div>
  <!--Time Out-->    <div class="mb-4">
                                  <label for="timeout" class="text-sm">Time Out</label>
                                  <input type="time" name="timeout" id="timeout" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('timeout') }}">
                              <!--Error prompt-->
                              <div class="timeoutErr text-red-500"></div>
                              </div>

          <!-- Submit Buttin -->
                          <!--Footer-->
                          <div class="flex justify-end pt-2">
                              <button type="submit" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Create</button>
                              <button type="button" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                          </div>
                      </form>
                      <div class="text-center">
                        -------------------------------------------------
                      </div>

                      <div>
                        <table class="border-collapse dark:border-slate-600 table-auto w-full text-sm text-center">
                          <caption class="text-lg whitespace-no-wrap border-b border-gray-500">List of Shifts</caption>
                          <thead class="border-spacing-2">
                            <tr>
                              <th class="whitespace-no-wrap border-b border-gray-500">Title</th>
                              <th class="whitespace-no-wrap border-b border-gray-500">Time In</th>
                              <th class="whitespace-no-wrap border-b border-gray-500">Time Out</th>
                              <th class="whitespace-no-wrap border-b border-gray-500"></th>
                            </tr>
                          </thead>
                          <tbody class="shiftlist border-spacing-2">
                            @if($shifts->count())
                              @foreach ($shifts as $shift)
                              <tr>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $shift->ShiftTitle }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $shift->TimeIn }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{  $shift->TimeOut }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">
                                  <a href=""><button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">D</button></a>
                                </td>
                              </tr>
                              @endforeach
                            @else
                              <p>Please add Employee Shift schedule</p>
                            @endif
                          </tbody>
                        </table>
                      </div>
      </div>
    </div>
  </div>

  <script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
        event.preventDefault()
        toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
      }
    };


    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }



    $(document).ready(function(e){
        $('#addShift').on('submit', function(e) {
        e.preventDefault();
        var title = $('#title').val();
        var timein = $('#timein').val();
        var timeout = $('#timeout').val();

            console.log(timein,timeout);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            type: "POST",
            url: '/createShift',
            data: {Title: title, Timein: timein, Timeout:timeout},
            dataType: "json",
            success: function( data ) {
                console.log(data.response);

                $(".shiftlist").append('<tr><td class="whitespace-no-wrap border-b border-gray-500">'+data.response.ShiftTitle+'</td><td class="whitespace-no-wrap border-b border-gray-500">'+data.response.TimeIn+'</td><td class="whitespace-no-wrap border-b border-gray-500">'+data.response.TimeOut+'</td><td class="whitespace-no-wrap border-b border-gray-500"><a href=""><button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">D</button></a></td></tr>');

                $('#title').val("");
                $('#timein').val("");
                $('#timeout').val("");
                toggleModal();
            },
            error: function (jqXHR, exception) {

                if(jqXHR.responseJSON.errors){
                    if(jqXHR.responseJSON.errors.Title){
                        var html = '<p>'+jqXHR.responseJSON.errors.Title+'</p>'
                        $('.titleErr').html(html);
                    }
                    if(jqXHR.responseJSON.errors.Timein){
                        var html = '<p>'+jqXHR.responseJSON.errors.Timein+'</p>'
                        $('.timeinErr').html(html);
                    }
                    if(jqXHR.responseJSON.errors.Timeout){
                        var html = '<p>'+jqXHR.responseJSON.errors.Timeout+'</p>'
                        $('.timeoutErr').html(html);
                    }
                  }
                    console.log(jqXHR);
                }
        });
    });
    });

  </script>
