@extends('layouts.app')

@section('title')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">

            @if (session('message'))
            <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{session('message')}}
            </div>
            @endif

            <form  action="{{route('profiles.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{auth()->user()->username}}" >

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de Perfil</label>
                    <input id="image" name="image" type="file" class="border p-3 w-full rounded-lg" value="" accept=".jpg, .jpeg, .png">
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">cambiar el corrreo electronico</label>
                    <input id="email" name="email" type="email" placeholder="Tu Correo Electronico" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{auth()->user()->email}}">
                    
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="current_password" class="mb-2 block uppercase text-gray-500 font-bold">Ingrese la Contraseña actual</label>
                    <input id="current_password" name="current_password" type="password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg @error('current_password') border-red-500 @enderror">
                    
                    @error('current_password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Cambiar la Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar Nueva Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Tu Repita su Contraseña" class="border p-3 w-full rounded-lg">
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection