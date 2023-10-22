@extends('adminlte::page')

@section('css')
    @vite('resources/css/app.css')
@stop

@section('content')
    @if($event)
        <h2>{{ $event->title }}</h2>
        <p>{{ $event->text }}</p>
        <p class="date_event">{{ $event->created_at }}</p>
    @endif

    @if($users)
        <h2>Участники</h2>

        @php
            $is_event = false;
        @endphp

        {{-- вывод участников --}}
        @foreach($users as $user)
            @if(auth()->user()->id === $user->id)
                @php($is_event = true)
            @endif

            <div class="users">
                <a href="" data-toggle="modal" data-target="#modalPurple_{{ $user->id }}">
                    {{ $user->first_name }} {{ $user->last_name }}
                </a>
            </div>

            {{-- modal --}}
            <x-adminlte-modal id="modalPurple_{{ $user->id }}" title="Об участнике" theme="purple" icon="fas fa-bolt" size='lg' disable-animations>
                <p>name: {{ $user->first_name }} {{ $user->last_name }}</p>
                <p>login: {{ $user->login }}</p>
                <p>date of birth: {{ $user->date_of_birth }}</p>
                <p>date of register: {{ $user->created_at }}</p>
            </x-adminlte-modal>
        @endforeach

        {{-- проверка участия --}}
        @if($is_event)
            <div class="users__btn">
                <a href="{{ route('cancel_event', $event->id) }}">
                    <x-adminlte-button label="Отказаться от участия" theme="danger" icon="fas fa-ban" />
                </a>
            </div>
        @else
            <div class="users__btn">
                <a href="{{ route('apply_event', $event->id) }}">
                    <x-adminlte-button label="Принять участие" theme="success" icon="fas fa-thumbs-up" />
                </a>
            </div>
        @endif
    @endif
@stop
