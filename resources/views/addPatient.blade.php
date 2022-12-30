@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @if (session('status'))
            <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('status') }}
            </div>
        @endif
        <div class="w-full bg-gray-100 p-6 rounded-lg">
            <h1 class="text-2xl">Register a Patient</h1>
            <div>
                <p>&nbsp;</p>
            </div>
            <form action="{{ route('addPatient') }}" method="POST">
                <!-- Cross Site Request Forgery-->
                                @csrf
                <!-- Name-->
                                <div class="mb-4"> <!--FIRSTNAME-->
                                    <label for="firstname" class="sr-only">Enter Name</label>
                                    <input type="text" name="firstname" id="firstname" placeholder="Patient Firstame" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('firstname') }}">
                                <!--Error prompt-->
                                    @error('firstname')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4"> <!--Middlename-->
                                    <label for="middlename" class="sr-only">Enter Middlename</label>
                                    <input type="text" name="middlename" id="middlename" placeholder="Patient Middlename" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('middlename') border-red-500 @enderror" value="{{ old('middlename') }}">
                                <!--Error prompt-->
                                    @error('middlename')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4"> <!--LASTNAME-->
                                    <label for="lastname" class="sr-only">Enter last</label>
                                    <input type="text" name="lastname" id="lastname" placeholder="Patient lastname" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('lastname') border-red-500 @enderror" value="{{ old('lastname') }}">
                                <!--Error prompt-->
                                    @error('lastname')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                <!-- Contact-->
                                <div class="mb-4">
                                    <label for="contact" class="sr-only">Contact</label>
                                    <input type="text" name="contact" id="contact" placeholder="Patient Contact number" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('contact') border-red-500 @enderror" value="{{ old('contact') }}">
                                <!--Error prompt-->
                                    @error('contact')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="othercontact" class="sr-only">Contact</label>
                                    <input type="text" name="othercontact" id="othercontact" placeholder="Guardian's Contact (optional)" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('othercontact') border-red-500 @enderror" value="{{ old('otherontact') }}">
                                <!--Error prompt-->
                                    @error('othercontact')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                <!-- Email-->
                                <div class="mb-4">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Patient Email (optional)" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                                <!--Error prompt-->
                                    @error('email')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                <!-- Submit Buttin -->
                                <div>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py3 rounded font-medium w-full">Add This Patient</button>
                                </div>
                            </form>


        </div>
    </div>
@endsection
