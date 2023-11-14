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



                                            <h5 class="m-b-10">Archive Store Table</h5>
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

                                            {{-- end  message Section --}}
                                            <h5>Archive Store Table</h5>

                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                                    {{-- <li><i class="fa fa-trash close-card"></i></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Store Name</th>
                                                            <th>Email</th>
                                                            <th>Store Type</th>
                                                            <th>Status</th>
                                                            <th>Phone</th>
                                                            <th>Store Image</th>
                                                            <th>Open Time</th>
                                                            <th>Close Time</th>
                                                            <th>Store Location Name</th>
                                                            <th>Location Area</th>
                                                            <th>Location Street</th>
                                                            <th>Location Floor</th>
                                                            <th>Location Near</th>
                                                            <th>Location Another Details</th>
                                                            <th>Created By</th>
                                                            <th>Created Date</th>
                                                            <th>Last Updated Date</th>
                                                            <th>Deleted Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($stores as $store)
                                                            <tr>
                                                                <th scope="row">{{ $store->id }}</th>
                                                                <td>{{ $store->name }}</td>
                                                                <td>{{ $store->email }}</td>
                                                                <td>{{ $store->type }}</td>
                                                                <td>
                                                                    @if ($store->status == 0)
                                                                        <div class="btn btn-danger btn-sm rounded">
                                                                            Not Active
                                                                        </div>
                                                                    @else
                                                                        <div class="btn btn-success btn-sm rounded">
                                                                            Active
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $store->phone }}</td>
                                                                <td>
                                                                    <img src="{{ asset('image/'. $store->img) }}"
                                                                        style="width: 100px; height: 100px;">
                                                                </td>
                                                                <td>{{ $store->openTime }}</td>
                                                                <td>{{ $store->closeTime }}</td>
                                                                <td>{{ $store->location->name }}</td>
                                                                <td>{{ $store->location->area }}</td>
                                                                <td>{{ $store->location->street }}</td>
                                                                <td>{{ $store->location->floor }}</td>
                                                                <td>{{ $store->location->near }}</td>
                                                                <td>{{ $store->location->another_details }}</td>
                                                                <td>{{ $store->admin->name }}</td>
                                                                <td>{{ $store->created_at }}</td>
                                                                <td>{{ $store->updated_at }}</td>
                                                                <td>{{ $store->deleted_at }}</td>

                                                                <td>
                                                                    <div class="button-group">
                                                                        <form method="GET" action="{{route('admin.store.restore' , $store->id)}}" >
                                                                            @csrf
                                                                            <button type="submit" class="clear-background"><i class="fa fa-refresh"></i></button>
                                                                        </form>
                                                                        
                                                                        <form action="{{route('admin.store.force.delete' , $store->id)}}" method="POST">
                                                                            @csrf
                                                                            @method('delete')

                                                                            <button type="submit" class="clear-background"><i class="fa fa-trash"></i></button>
                                                                        </form>
                                                                        
                                                                    </div>
                                                                </td>                                                                

                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Page-body end -->
                            </div>
                            <div id="styleSelector"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
