@extends('layouts.app')

@php
    function checkFollowing($userToCheck, $follows){
        foreach ($follows as $follow) {
            if ($userToCheck == $follow->followedUser_id){
                return true;
            }
        }
        return false;
    }
@endphp

@section('content')
    <div class="container  center-align">
        @foreach ($users as $user)
        <br><br>
            <p><strong>{{$user->name}}</strong></p>
            @if (checkFollowing($user->id, $follows))
                <p>Already Following!</p>
                <form action="/unfollowUsers" method="get">
                    @csrf
                <input type="hidden" name="unfollowedUserId" value="{{$user->id}}">
                <input class="btn pink darken-1" type="submit" value="Unfollow">
                </form>
                {{-- @php print_r($user->id); @endphp --}}
            @else
                <form action="/followUsers" method="post">
                    @csrf
                <input type="hidden" name="followedUserId" value="{{$user->id}}">
                <input class="btn pink darken-1" type="submit" value="Follow">
                </form>
            @endif
        @endforeach
        <br>
        <a class="btn pink darken-1" href="tweetFeed" id="tab1">Back</a>
    </div>
@endsection
