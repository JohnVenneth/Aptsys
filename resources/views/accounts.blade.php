@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="w-full bg-gray-100 p-6 rounded-lg">
            @if (session('status'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
        @endif
            <a class="block py-2.5 px-4 rounded transition duration-200">My Account</a>
                @if($detail)
                    <div class="block bg-gray-200 p-6 rounded-lg text-sm">
                       <ul style="list-style-type:none">
                        <li>Name: {{ $detail->name }}</li>
                        <li>Email: {{ $detail->email }}</li>
                        <li>Contact: {{ $detail->contact }}</li>
                        <li>Shift: {{ $usershift->ShiftTitle }}</li>
                        <li>IN at {{ $usershift->TimeIn }} - OUT at {{ $usershift->TimeOut }}</li>
                       </ul>
                    </div>
                @else
                    <p>Please Log in</p>
                @endif
            <div class="content-center justify-center">
                <div class="block w-full">
                    <table class="table table-auto content-center justify-center w-full">
                        <thead class="justify-center content-center">
                            <tr class="content-center justify-center">
                                <th>
                                    <a href="/showAccount/{{ auth()->user()->id }}">
                                        <button class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Edit My Account</button>
                                    </a>
                                </th>
                                <th>
                                    <a href=" {{ route('register') }}">
                                        <button class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Register New Account</button>
                                    </a>
                                </th>
                                <th>
                                    <a>
                                        <button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Add Shift</button>
                                    </a>
                                </th>
                                <th>
                                    <a href="/timein/{{ 0 }}">
                                        <button class="bg-transparent border border-gray-500 hover:border-green-500 text-gray-500 hover:text-green-500 font-bold py-2 px-4 rounded-full">Time me IN for Attendance</button>
                                    </a>
                                </th>
                                <th>
                                    <a href="/timeout/{{ 1 }}">
                                        <button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">Time me out for Attendance</button>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div>
                <p>&nbsp;</p>
            </div>

            <div>
                <table class="account-list border-collapse dark:border-slate-600 table-auto w-full text-sm text-center">
                    <thead class="border-spacing-2">
                      <tr>
                        <th class="whitespace-no-wrap border-b border-gray-500">Name</th>
                        <th class="whitespace-no-wrap border-b border-gray-500">Email</th>
                        <th class="whitespace-no-wrap border-b border-gray-500">Contact</th>
                        <th class="whitespace-no-wrap border-b border-gray-500">Account Type</th>
                        <th class="whitespace-no-wrap border-b border-gray-500">Shift</th>
                        <th class="whitespace-no-wrap border-b border-gray-500">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="border-spacing-2">
                        @if ($allAccounts->count())
                            @foreach ($allAccounts as $acc)
                            <tr>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $acc->name }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $acc->email }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $acc->contact }}</td>
                                @if($acc->acctype==0)
                                    <td class="whitespace-no-wrap border-b border-gray-500">Admin</td>
                                @else
                                    <td class="whitespace-no-wrap border-b border-gray-500">User</td>
                                @endif

                                <td class="whitespace-no-wrap border-b border-gray-500">{{ $acc->ShiftTitle }}</td>
                                <td class="whitespace-no-wrap border-b border-gray-500">
                                    <a href="/showAccount/{{ $acc->id }}">
                                        <button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">E</button>
                                    </a>
                                    <a>|</a>
                                    <a href=""><button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">D</button></a>
                                    <a>|</a>
                                    <a href="/showAttLog/{{ $acc->id }}"><button class="bg-transparent border border-gray-500 hover:border-yellow-500 text-gray-500 hover:text-yellow-500 font-bold py-2 px-4 rounded-full">Attlogs</button></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <p>please Create a User</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modal.addShift')
@endsection
