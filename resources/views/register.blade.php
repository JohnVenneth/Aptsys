@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-200 p-6 rounded-lg">
            <form action="{{ route('register') }}" method="POST">
<!-- Cross Site Request Forgery-->
                @csrf
<!-- Name-->
                <div class="mb-4">
                    <label for="name" class="sr-only">Enter Name</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                <!--Error prompt-->
                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

<!-- Contact-->
                <div class="mb-4">
                    <label for="contact" class="sr-only">Contact</label>
                    <input type="text" name="contact" id="contact" placeholder="Your Contact number" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('contact') border-red-500 @enderror" value="{{ old('contact') }}">
                <!--Error prompt-->
                    @error('contact')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

<!-- Email-->
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                <!--Error prompt-->
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
<!-- Account type-->
                <div class="mb-4">
                    <label for="acctype" class="sr-only">Email</label>
                    <p class="text-sm">Choose Account Privilage</p>
                    <select type="text" name="acctype" id="acctype" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('acctype') border-red-500 @enderror" value="{{ old('acctype') }}">
                        <option value="0">Admin</option>
                        <option value="1">User</option>
                    </select>
                <!--Error prompt-->
                    @error('acctype')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

<!-- Shift-->
                <div class="mb-4">
                    <label for="shift" class="sr-only">Email</label>
                    <p class="text-sm">Choose Employee Shift</p>
                    <select type="text" name="shift" id="shift" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('shift') border-red-500 @enderror" value="{{ old('shift') }}">
                        @if($shifts->count())
                            @foreach ($shifts as $sh )
                                <option value={{ $sh->id }}>{{ $sh->ShiftTitle }}</option>
                            @endforeach
                        @endif
                    </select>
                <!--Error prompt-->
                    @error('shift')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

<!-- Password -->
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('password') border-red-500 @enderror" value="">
                <!--Error prompt-->
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
<!-- Repeat Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password</label>
                    <input type="password" name="password_confirmation" id="password" placeholder="Choose a Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('password_confirmation') border-red-500 @enderror" value="">
                <!--Error prompt-->
                    @error('password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

<!-- Submit Buttin -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py3 rounded font-medium w-full">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
