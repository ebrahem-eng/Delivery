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
                                            <h5 class="m-b-10">Add Store</h5>
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

                                                    <h5>Add Store</h5>



                                                </div>
                                                <div class="card-block">

                                                    <form method="POST" action="{{ route('admin.store.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Store Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Name"
                                                                        name="name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="placeholderInput">Store Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="placeholderInput"
                                                                        placeholder="store@gmail.com" name="email"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        id="simpleInput"
                                                                        placeholder="******************"
                                                                        name="password" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <label for="simpleInput">Store Type</label>

                                                                <select name="type" class="form-control" required>
                                                                    <option>Select Store Type</option>
                                                                    <option value="resturant">Resturant</option>
                                                                    <option value="clothes">Clothes</option>
                                                                    <option value="super_market">Super Market</option>
                                                                    <option value="flower">Flower</option>
                                                                    <option value="pharmacy">Pharmacy</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-sm-2">
                                                                <label for="simpleInput">Store Status</label>

                                                                <select name="status" class="form-control" required>
                                                                    <option>Select Store Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Not Active</option>

                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Phone</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="simpleInput" placeholder="5432302"
                                                                        name="phone" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Open Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="simpleInput" placeholder="1:20 PM"
                                                                        name="openTime" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Close Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="simpleInput" placeholder="1:20 PM"
                                                                        name="closeTime" required>
                                                                </div>
                                                            </div>


                                                            {{-- <div class="col-sm-3">
                                                                <label for="simpleInput">Store Catigory</label>

                                                                <select name="catigoryID" class="form-control" required>
                                                                    <option>Select Store Catigory</option>
                                                                    @foreach ($catigories as $catigory)
                                                                    <option value="{{$catigory->id}}">{{$catigory->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div> --}}

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Store Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="simpleInput" name="img" required>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Location Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Loc1"
                                                                        name="locationName" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Area</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Area 1"
                                                                        name="area" required>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Street</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Street 1"
                                                                        name="street" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Floor</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Floor 1"
                                                                        name="floor" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Near</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Near 1"
                                                                        name="near" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Another Details</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="No Details"
                                                                        name="details" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput">Store Category</label>

                                                                @foreach ($catigories as $category)
                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="category_{{ $category->id }}"
                                                                            name="catigoryID[]"
                                                                            value="{{ $category->id }}">
                                                                        <label
                                                                            for="category_{{ $category->id }}">{{ $category->name }}</label>
                                                                    </div>
                                                                @endforeach

                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <input type="hidden" id="latitude" name="latitude">
                                                            <br>
                                                            <input type="hidden" id="longitude" name="longitude">
                                                        </div>
                                                        <div id="map" style="height: 500px; width: 1000px;">
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <button type="submit"
                                                                class="btn btn-primary rounded">Ok</button>
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
    <script>
        var map, marker;

        function initMap() {
            // The location of the user
            var myLatLng = {
                lat: -34.397,
                lng: 150.644
            }; // default location

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    myLatLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: myLatLng
                    });

                    marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        draggable: true,
                        title: 'Drag me!'
                    });

                    // Set default values for latitude and longitude
                    document.getElementById('latitude').value = myLatLng.lat;
                    document.getElementById('longitude').value = myLatLng.lng;

                    // Add event listener to marker for position update
                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        document.getElementById('latitude').value = this.getPosition().lat();
                        document.getElementById('longitude').value = this.getPosition().lng();
                    });

                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBddryhfLC4gYIvreVc9YDY4gLv2BrhhmY&callback=initMap"></script>

</body>

</html>
