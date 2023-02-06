@extends('layouts.app');

@section('title')
    Editar perfil de {{auth()->user()->username}}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-6/12 bg-white shadow p-6" >
            <form class="mt-10 md:mt-0" action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        class="border p-3 w-full rounded-lg @error('username')border-red-500 @enderror"
                        value="{{auth()->user()->username}}"
                    >
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Imagen perfil</label>
                    <input
                        id="image"
                        name="image"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"
                    >
                </div>

                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
