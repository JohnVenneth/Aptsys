 <!--Modal-->
 <div style="overflow-y: auto;" class="Emodal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="Emodal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="Emodal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

      <div class="Emodal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="Emodal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Appointment Creation</p>
          <div class="Emodal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <form id="editPatient">
          <!-- Cross Site Request Forgery-->
                          @csrf
                    <!-- Input-->
                <!-- Name-->
                <div class="mb-4"> <!--FIRSTNAME-->
                    <label for="firstname" class="sr-only">Enter Name</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Patient Firstame" class="bg-gray-100 border-2 w-full p-4 rounded-lg " value="{{ $patients->PatFirstName }}">
                <!--Error prompt-->
                    <div class="firstnameErr text-red-500"></div>
                </div>

                <div class="mb-4"> <!--Middlename-->
                    <label for="middlename" class="sr-only">Enter Middlename</label>
                    <input type="text" name="middlename" id="middlename" placeholder="Patient Middlename" class="bg-gray-100 border-2 w-full p-4 rounded-lg " value="{{ $patients->PatMiddleName }}">
                <!--Error prompt-->
                <div class="middlenameErr text-red-500"></div>
                </div>

                <div class="mb-4"> <!--LASTNAME-->
                <label for="lastname" class="sr-only">Enter last</label>
                <input type="text" name="lastname" id="lastname" placeholder="Patient lastname" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $patients->PatLastName }}">
                <!--Error prompt-->
                <div class="lastnameErr text-red-500"></div>
                </div>

                <!-- Contact-->
                <div class="mb-4">
                <label for="contact" class="sr-only">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="Patient Contact number" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $patients->PatContact }}">
                <!--Error prompt-->
                <div class="contactErr text-red-500"></div>
                </div>

                <div class="mb-4">
                <label for="othercontact" class="sr-only">Contact</label>
                <input type="text" name="othercontact" id="othercontact" placeholder="Guardian's Contact (optional)" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $patients->OtherToContact }}">
                </div>

                <!-- Email-->
                <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="email" id="email" placeholder="Patient Email (optional)" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $patients->PatEmail }}">

                </div>

          <!-- Submit Buttin -->
                          <!--Footer-->
                          <div class="flex justify-end pt-2">
                              <button type="submit" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Save</button>
                              <button type="button" class="Emodal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                          </div>
                      </form>
      </div>
    </div>
  </div>

  <script>
    var openmodal = document.querySelectorAll('.Editmodal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
        event.preventDefault()
        EtoggleModal()
      })
    }

    const Eoverlay = document.querySelector('.Emodal-overlay')
    Eoverlay.addEventListener('click', EtoggleModal)

    var Eclosemodal = document.querySelectorAll('.Emodal-close')
    for (var i = 0; i < Eclosemodal.length; i++) {
      Eclosemodal[i].addEventListener('click', EtoggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var EisEscape = false
      if ("key" in evt) {
        EisEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        EisEscape = (evt.keyCode === 27)
      }
      if (EisEscape && document.body.classList.contains('Emodal-active')) {
        EtoggleModal()
      }
    };


    function EtoggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.Emodal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('Emodal-active')
    }

$(document).ready(function(e){
    $('#editPatient').on('submit', function(e) {
       e.preventDefault();
       var Firstname = $('#firstname').val();
       var Middlename = $('#middlename').val();
       var Lastname = $('#lastname').val();
       var Contact = $('#contact').val();
       var Othercontact = $('#othercontact').val();
       var Email = $('#email').val();
       var PatID = {{ $patients->id }};

       $('.firstnameErr').html('');
       $('.middlenameErr').html('');
       $('.lastnameErr').html('');
       $('.contactErr').html('');

       $.ajax({
           type: "PUT",
           url: '/editPatient',
           data: {firstname: Firstname, middlename: Middlename, lastname: Lastname,contact: Contact, othercontact: Othercontact, email: Email, patID: PatID },
           success: function( data ) {
               console.log(data);
               //id="Tfirstname"
               $('#Tfirstname').html(data.firstname);
               $('#Tmiddlename').html(data.middlename);
               $('#Tlastname').html(data.lastname);
               $('#Tcontact').html(data.contact);
               $('#Tothercontact').html(data.othercontact);
               $('#Temail').html(data.email);
               EtoggleModal();
           },
            error: function (jqXHR, exception) {
                console.log(jqXHR.responseJSON.errors.firstname);

                if(jqXHR.responseJSON.errors.firstname){
                    var html = '<p>'+jqXHR.responseJSON.errors.firstname+'</p>'
                    $('.firstnameErr').html(html);
                }
                if(jqXHR.responseJSON.errors.middlename){
                    var html = '<p>'+jqXHR.responseJSON.errors.middlename+'</p>'
                    $('.middlenameErr').html(html);
                }
                if(jqXHR.responseJSON.errors.lastname){
                    var html = '<p>'+jqXHR.responseJSON.errors.lastname+'</p>'
                    $('.lastnameErr').html(html);
                }
                if(jqXHR.responseJSON.errors.contact){
                    var html = '<p>'+jqXHR.responseJSON.errors.contact+'</p>'
                    $('.contactErr').html(html);
                }


            }
       });
   });
});


  </script>
