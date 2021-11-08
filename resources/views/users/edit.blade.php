@extends('layouts.app')

@section('content')
<main role="main" class="feature-main">
    <h1>Editing {{$user->name}} information</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Register') }}</div> -->

                <div class="card-body">
                    <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="First name, Last name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name ??'' }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email ??'' }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Choose a title') }}</label>

                            <div class="col-md-6">
                                <select id="title" name="title" class="form-control">
                                    <option value="Professor" {{isset($user->title) && $user->title=="Professor" ? 'selected': ''}}>Professor</option>
                                    <option value="Web developer" {{isset($user->title) && $user->title=="Web developer" ? 'selected': ''}}>Web developer</option>
                                    <option value="Web designer" {{isset($user->title) && $user->title=="Web designer" ? 'selected': ''}}>Web designer</option>
                                    <option value="Researcher" {{isset($user->title) && $user->title=="Researcher" ? 'selected': ''}}>Researcher</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="biography" class="col-md-4 col-form-label text-md-right">{{ __('Biography') }}</label>

                            <div class="col-md-6">
                                <textarea id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography" required autocomplete="biography">{{ old('biography') ?? $user->biography ??'' }} </textarea>

                                @error('biography')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" autocomplete="picture">

                                @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="roles">Roles</label>
                            <div class="col-sm-6">
                                <select multiple name="roles[]" class="form-control" id="roles">
                                    @foreach($roles as $id => $display)
                                    <option value="{{ $id }}" {{in_array($id, $ids) ? 'selected' :''}}>{{ $display }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Can be left blank">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Can be left blank">
                            </div>
                        </div>

                        <div class="my-buttons form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update User
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection