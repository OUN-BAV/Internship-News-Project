@extends(backpack_view('blank'))

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
@endsection

@php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>{{ trans('backpack::base.my_account') }}</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        @if (session('success'))
        <div class="col-lg-8">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if ($errors->count())
        <div class="col-lg-8">
            <div class="alert alert-danger">
                <ul class="mb-1">
                    @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        {{-- @dd($user->profile) --}}
        <div class="col-md-3 p-0">
            <div class="card card-card card-primary">
                <div class="card-header">User Info</div>
                <div class="card-body p-0">
                    <div class="card-body card-profile p-0">
                        @if($user->profile != null)
                            <div class="border-card text-center px-5 py-3">
                                <img src="{{URL($user->profile)}}" class="profile-user-img img-responsive img-fluid d-block mx-auto rounded-circle img-thumbnail" alt="">
                                <label for="pro" class="btn" id='profile'><i class="la la-camera h4 rounded-circle border border-secondary p-1 shadow-lg" style="position: absolute;margin-left:20px;margin-top:-40px;"></i></label>
                            </div>
                        @else
                            <div class="border-card text-center px-5 py-3">
                                <img src="{{asset('uploads/folder_1/folder_2/images.png')}}" class="profile-user-img img-responsive img-fluid d-block mx-auto rounded-circle img-thumbnail" alt="">
                                <label for="pro" class="btn" id='profile'><i class="la la-camera h4 rounded-circle border border-secondary p-1 shadow-lg" style="position: absolute;margin-left:20px;margin-top:-40px;"></i></label>
                            </div>
                        @endif
                        <div class="text-center">
                            <h3 class="profile-username text-center text-capitalize text-break p-3">{{$user->name}}</h3>
                        </div>
                        <ul class="list-group nav-stacked">
                            <li class="list-group-item tab-active" id="tab-info">
                                 <a id="change_user_info"><em class="nav-icon la la-user-edit la-lg mr-2"></em>Change user info</a>
                            </li>
                            <li class="list-group-item" id="tab-password">
                                <a id="change_password"><em class="nav-icon la la-lock la-lg mr-2"></em>Change password</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- UPDATE INFO FORM --}}
        <div class="col-lg-8" id="userInfo">
            <form class="form" action="{{ route('backpack.account.info.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        {{ trans('backpack::base.update_account_info') }}
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                @php
                                    $label = trans('backpack::base.name');
                                    $field = 'name';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                            </div>

                            <div class="col-md-6 form-group">
                                @php
                                    $label = config('backpack.base.authentication_column_name');
                                    $field = backpack_authentication_column();
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="{{ backpack_authentication_column()==backpack_email_column()?'email':'text' }}" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.save') }}</button>
                        <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>

        {{-- CHANGE PASSWORD FORM --}}
        <div class="col-lg-8" id="passwordReset" style="display: none">
            <form class="form" action="{{ route('backpack.account.password') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        {{ trans('backpack::base.change_password') }}
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.old_password');
                                    $field = 'old_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.new_password');
                                    $field = 'new_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.confirm_password');
                                    $field = 'confirm_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.change_password') }}</button>
                            <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                    </div>

                </div>

            </form>
        </div>

    </div>
@endsection
@section('after_scripts')
<script>
    $(document).ready(function(){
        $('#tab-info').on('click',function(){
            $('#passwordReset').hide();
            $('#userInfo').show();
        })
        $('#tab-password').on('click',function(){
            $('#passwordReset').show();
            $('#userInfo').hide();
        })
        $("#profile").confirm({
                title: 'Change profile!',
                content: '' +
                '<form action="" class="formName" enctype="multipart/form-data">' +
                '<div class="form-group">' +
                '<label>select your image here</label>' +
                '<img class="border border-secondary rounded w-100" id="preview" src="{{URL('uploads/folder_1/folder_2/images.png')}}" >'+
                '<label for ="pro" class="form-control border-0"><div class="btn btn-secondary p-1 w-100">upload<i class="la la-upload"></i></div></label>'+
                '<input type="file" class="name" name="profile" form-control" id="pro" hidden required />' +
                '<input type="number"  form-control" id="id" name="id" value="{{$user->id}}" hidden required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-success',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            if(!name){
                                $.alert('provide a valid name');
                                return false;
                            }
                            else{
                                var jform = new FormData();
                                jform.append('file',$('#pro')[0].files[0]);
                                console.log($('#pro')[0].files[0]);
                                jform.append('file',$('#id').val());
                                console.log($('#id').val());
                                var id=$('#id').val();
                                var url='/admin/user/profileUpdate';
                                console.log(url);
                                $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url:url,
                                    method: 'put',
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    data: jform,
                                    enctype: 'multipart/form-data',
                                    success: function (response) {
                                        if(response.success) {
                                            new Noty({
                                                type: 'success',
                                                text: response.message
                                            }).show();
                                            setTimeout(function() {
                                                crud.table.ajax.reload();
                                            }, 200);
                                        } else {
                                            new Noty({
                                                type: 'error',
                                                text: response.message
                                            }).show();  
                                        }
                                    },
                                    error: function(error) {
                                        new Noty({
                                                type: 'error',
                                                text: "profile upload failed try again."
                                        }).show();
                                    }
                                })
                            }
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    var imgPreview=$('#preview');
                    $('#pro').on('change',function(e){
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imgPreview.attr('src', e.target.result);
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    });
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
    })
</script>
@endsection
