@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-200 p-6 rounded-lg">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
<!-- Cross Site Request Forgery-->
                @csrf
<!-- Email-->
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('email') border-red-500 @enderror" value="{{ old('AccEmail') }}">
                <!--Error prompt-->
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
<!-- Password -->
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('password') border-red-500 @enderror" value="">
                <!--Error prompt-->
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
<!-- Submit Buttin -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py3 rounded font-medium w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
