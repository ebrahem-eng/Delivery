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
                                            <h5 class="m-b-10">Edit Store</h5>
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
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- Basic Form Inputs card start -->
                                            <div class="card">
                                                <div class="card-header">
                                                    {{-- Validation error --}}
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li style="color: red;">{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    {{-- End Validation error --}}

                                                    {{-- message Section --}}

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

                                                    <h5>Edit Store</h5>



                                                </div>
                                                <div class="card-block">

                                                    <form method="POST"
                                                        action="{{ route('admin.store.update', $store->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Store Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Name"
                                                                        name="name" value="{{ $store->name }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="placeholderInput">Store Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="placeholderInput"
                                                                        placeholder="store@gmail.com" name="email"
                                                                        value="{{ $store->email }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            {{-- <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        id="simpleInput"
                                                                        placeholder="******************"
                                                                           name="password" required>
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-sm-4">
                                                                <label for="simpleInput">Store Type</label>

                                                                <select name="type" class="form-control" required>
                                                                    <option>Select Store Type</option>
                                                                    <option value="resturant"
                                                                        {{ $store->type === 'resturant' ? 'selected' : '' }}>
                                                                        Resturant</option>
                                                                    <option value="clothes"
                                                                        {{ $store->type === 'clothes' ? 'selected' : '' }}>
                                                                        Clothes</option>
                                                                    <option value="super_market"
                                                                        {{ $store->type === 'super_market' ? 'selected' : '' }}>
                                                                        Super Market</option>

                                                                    <option value="flower"
                                                                        {{ $store->type === 'flower' ? 'selected' : '' }}>
                                                                        Flower</option>
                                                                    <option value="pharmacy"
                                                                        {{ $store->type === 'pharmacy' ? 'selected' : '' }}>
                                                                        Pharmacy</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-sm-2">
                                                                <label for="simpleInput">Store Status</label>

                                                                <select name="status" class="form-control" required>
                                                                    <option>Select Store Status</option>
                                                                    <option value="1"
                                                                        {{ $store->status === 1 ? 'selected' : '' }}>
                                                                        Active</option>
                                                                    <option value="0"
                                                                        {{ $store->status === 0 ? 'selected' : '' }}>
                                                                        Not Active</option>

                                                                </select>

                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Open Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="simpleInput" placeholder="1:20"
                                                                        name="openTime"
                                                                        value="{{ $store->openTime }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Close Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="simpleInput" placeholder="1:20"
                                                                        name="closeTime"
                                                                        value="{{ $store->closeTime }}" required>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Phone</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="simpleInput" placeholder="5432302"
                                                                        name="phone" value="{{ $store->phone }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Store Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="simpleInput" name="img">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput">Store Category</label>

                                                                @foreach ($catigories as $catigory)
                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="category_{{ $catigory->id }}"
                                                                            name="catigoryID[]"
                                                                            value="{{ $catigory->id }}"
                                                                            {{ $storeCatigoryIDs->contains($catigory->id) ? 'checked' : '' }}>
                                                                        <label
                                                                            for="category_{{ $catigory->id }}">{{ $catigory->name }}</label>
                                                                    </div>
                                                                @endforeach

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




</body>

</html>
