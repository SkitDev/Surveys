@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="text-center">{{ $questionnaire->name }}</h1>

            <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="post">
                @csrf

                @foreach($questionnaire->questions as $key => $question)
                    <div class="card mt-4">
                        <div class="card-header"><strong>{{ $key + 1 }}.</strong> {{ $question->question }}</div>
                        <div class="card-body">

                            @error('responses.'.$key.'.answer_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <ul class="list-group">
                                @foreach($question->answers as $answer)
                                    <li class="list-group-item">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}" value="{{ $answer->id }}"
                                            {{ (old('responses.'.$key.'.answer_id') == $answer->id) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="answer{{ $answer->id }}">
                                                {{ $answer->answer }}
                                            </label>
                                            <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                <div class="card mt-4">
                    <div class="card-header">Your Information</div>
                    <div class="card-body">
                         <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Your name" name="survey[name]" value="{{ old('survey.name') }}">
                                <small id="nameHelp" class="form-text text-muted">Hello! What's your name?</small>

                                @error('survey.name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                         </div>
                         <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email" name="survey[email]" value="{{ old('survey.email') }}">
                                <small id="emailHelp" class="form-text text-muted">Your Email Please!</small>

                                @error('survey.email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                         </div>
                        <div>
                            <button type="submit" class="btn btn-dark">Complete Survey</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
