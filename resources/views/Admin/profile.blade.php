<!DOCTYPE html>
<html lang="en">

<head>
    <title>Material Able bootstrap admin template by Codedthemes</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />

    @include('layouts.Admin.Link')

    <style>
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .clear-background {
            background-color: transparent;
            border: none;
            padding: 5px;
            margin: 0;
        }
    </style>

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            {{-- Header --}}
            @include('layouts.Admin.Header')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    {{-- SideBar --}}
                    @include('layouts.Admin.Sidebar')

                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">



                                            <h5 class="m-b-10">Update Profile</h5>
                                            <p class="m-b-0">Welcome to Delivery Dashboard</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">



                                    <div class="card">
                                        <div class="card-header">

                                            {{-- message Section --}}

                                            @if (session('success_message'))
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ session('success_message') }}
                                                </div>
                                            @endif

                                            @if (session('error_message'))
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ session('error_message') }}
                                                </div>
                                            @endif
                                            {{-- end  message Section --}}


                                            <div class="card-block">
                                                <!-- Row start -->
                                                <div class="row m-b-30">
                                                    <div class="col-lg-12 col-xl-8">
                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs md-tabs" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab"
                                                                    href="#home3" role="tab">Personal Info</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#profile3"
                                                                    role="tab">Reset Password</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#messages3"
                                                                    role="tab">Contant Info</a>
                                                                <div class="slide"></div>
                                                            </li>

                                                        </ul>

                                                        <div class="tab-content card-block">
                                                            <div class="tab-pane active" id="home3"
                                                                role="tabpanel">
                                                                <form method="POST" action="{{route('admin.profile.update.personal.info' , $admin->id)}}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group">
                                                                                <label for="simpleInput">Name</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="simpleInput"
                                                                                    placeholder="Name" name="name"
                                                                                    value="{{ $admin->name }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="placeholderInput">Age</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    id="placeholderInput"
                                                                                    placeholder="30" name="age"
                                                                                    value="{{ $admin->age }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary rounded">Update</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="profile3" role="tabpanel">
                                                                <form method="POST" action="{{route('admin.profile.reset.password' , $admin->id)}}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="simpleInput">Current
                                                                                    Password</label>
                                                                                <input type="password"
                                                                                    class="form-control"
                                                                                    id="simpleInput"
                                                                                    placeholder="************"
                                                                                    name="current_password" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="placeholderInput">New
                                                                                    Password</label>
                                                                                <input type="password"
                                                                                    class="form-control"
                                                                                    id="placeholderInput"
                                                                                    placeholder="************"
                                                                                    name="new_password" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="placeholderInput">Confirm
                                                                                    New Paasword</label>
                                                                                <input type="password"
                                                                                    class="form-control"
                                                                                    id="placeholderInput"
                                                                                    placeholder="************"
                                                                                    name="confirm_new_password"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <br>
                                                                    <div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary rounded">Update</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="messages3" role="tabpanel">
                                                                <form method="POST" action="{{route('admin.profile.update.contact.info' , $admin->id)}}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <div class="form-group">
                                                                            <label for="simpleInput">Email</label>
                                                                            <input type="email"
                                                                                class="form-control"
                                                                                id="simpleInput"
                                                                                placeholder="admin@gmail.com" name="email"
                                                                                value="{{ $admin->email }}"
                                                                               readonly required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="placeholderInput">Phone</label>
                                                                            <input type="tel"
                                                                                class="form-control"
                                                                                id="placeholderInput"
                                                                                placeholder="0987654321" name="phone"
                                                                                value="{{ $admin->phone }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary rounded">Update</button>
                                                                </div>

                                                            </form>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
