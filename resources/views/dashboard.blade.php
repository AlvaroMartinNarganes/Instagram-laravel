@extends('layouts.app')
@section('title')
    {{$user->username}}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{$user->image ? asset('profiles/'.$user->image) : asset('img/usuario.svg')}}"
                     alt="Imagen Usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start py-10 md:justify-center">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    @auth
                        @if($user->id===auth()->user()->id)
                            <a class="text-gray-500 hover:text-gray-600 cursor-pointer"
                               href="{{route('profile.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers()->count()}}
                    <span class="font-normal">
                        @choice('Seguidor|Seguidores',$user->followers()->count())
                    </span>

                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->following()->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{count($posts)}}
                    <span class="font-normal">Posts</span>
                </p>
                @auth()
                    @if($user->id !== auth()->user()->id)
                        @if(!$user->checkFollower(auth()->user()))
                            <form method="POST" action="{{route('users.follow',$user)}}">
                                @csrf
                                <input type="submit" value="Seguir"
                                       class="bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @else
                            <form method="POST" action="{{route('users.unfollow',$user)}}">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Dejar de seguir"
                                       class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @endif
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-post :posts="$posts" />
    </section>
@endsection
