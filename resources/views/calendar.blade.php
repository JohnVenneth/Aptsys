<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AptSys</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
       <link rel="stylesheet" href="{{ url('css/cal.css') }}">
       <script src="{{ url('js/calendar.js') }}" defer></script>

    </head>
    <body>
        <div class="relative min-h-screen md:flex">

            <!-- mobile menu bar -->
            <div class="bg-gray-800 text-gray-100 flex justify-between md:hidden">
              <!-- logo -->

              @auth
                    <a href="#" class="block p-4 text-white font-bold">{{ auth()->user()->name }}</a>
                @endauth
                @guest
                    <a href="#" class="block p-4 text-white font-bold">AptSys</a>
                @endguest


              <!-- mobile menu button -->
              <button class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>

            <!-- sidebar -->
            <div class="sidebar bg-blue-700 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out" style="z-index: 99;">

              <!-- logo -->
              <a href="#" class="text-white flex items-center space-x-2 px-4">
                @auth
                    <ul style="list-style-type:none">
                        <li>
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="text-2xl font-extrabold"> {{ auth()->user()->name }}
                            </span>
                        </li>
                            <li>Email: {{ auth()->user()->email }}</li>
                            <li>Conact: {{ auth()->user()->contact }}</li>
                        </ul>
                @endauth
                @guest
                    <span class="text-2xl font-extrabold"> AptSys </span>
                @endguest
              </a>

              <!-- nav -->
              <nav>
                <a href="{{ route('calendar') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                  CALENDAR
                </a>
                <a href="{{ route('patientHistory') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                  PATIENT HISTORY
                </a>
                <a href="{{ route('accounts') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                  ACCOUNTS
                </a>

                @auth
                <a href="" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-3">LOGOUT</button>
                    </form>
                  </a>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    LOG-IN
                 </a>
                @endguest

              </nav>
            </div>

            <!-- content -->
            <div class="flex-1 p-10">
<!----------------------------------- CALENDAR -------------------------------------------->
            <div class="calbody">
                <div class="wrapper">
                    <header>
                    <p class="current-date"></p>
                    <div class="icons">
                        <span id="prev" class="material-symbols-rounded"><</span>
                        <span id="next" class="material-symbols-rounded">></span>
                    </div>
                    </header>
                    <div class="calendar">
                    <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="days"></ul>
                    </div>
                </div>
            </div>
<!----------------------------------- CALENDAR -------------------------------------------->
            </div><!-- side bar content div-->
<!----------------------------------- Appointments -------------------------------------------->
            <div class="flex justify-center">
                <div class="bg-gray-100 p-6 rounded-lg">
                    <h1 class="text-center">A P P O I N T M E N T S</h1>
                    <div class="appointment">
                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                              <tr>
                                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500 text-left">TIME</th>
                                <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 text-left">PATIENT</th>
                              </tr>
                            </thead>
                            <tbody class="schedule bg-white">
                              <tr class="sitems">
                                <td class="border-b border-slate-700 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-900">S E L E C T</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-800">D A T E</td>
                              </tr>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        <script> /////////////////////////////////////Side Bar Scripts

            // grab everything we need
            const btn = document.querySelector(".mobile-menu-button");
            const sidebar = document.querySelector(".sidebar");
            let isSidebarOpen = false;
            // add our event listener for the click
            btn.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
            });
            ///////////////////////////////////////////////////////////


            ///////////////////////////////////////////////////////////
            $(document).ready(function(){
                $('.days').on('click','#dateclick', function(e){
                    $target=$(e.target);
                    const monthid = $target.attr('data-m');
                    const dayid = $target.attr('data-d');
                    const yearid = $target.attr('data-y')

                    getAppointments(yearid,monthid,dayid);

                    function getAppointments(y,m,d) {
                        $.ajax({
                        type:'GET',
                        url:'/getAppointments/'+y+"/"+m+"/"+d,
                        data:'jason',
                        success:function(data) {
                            console.log(data.appts);
/*Display Appointment Table*/   $('.sitems').remove();
                                $.each(data.appts, function (key,items){
                                    $('.schedule').append('<tr class="sitems hover:bg-sky-200">\
                                    <td class="border-b border-slate-700 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-900">'+items.AppDate+'|'+items.AppTime+'</td>\
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-800">'+items.PatFirstName+' '+items.PatLastName+'</td></tr>')
                                });
                            }
                        });
                    }
                })
            })

        </script>
    </body>
</html>

