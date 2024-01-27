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
                                            <h5 class="m-b-10">Add Delivery Agent</h5>
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

                                                    <h5>Add Delivery Agent</h5>



                                                </div>
                                                <div class="card-block">

                                                    <form method="POST"
                                                        action="{{ route('admin.delivery.agent.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Name"
                                                                        name="name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="placeholderInput">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="placeholderInput"
                                                                        placeholder="delivery@gmail.com" name="email"
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

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput"> Status</label>

                                                                <select name="status" class="form-control" required>
                                                                    <option>Select Delivery Agent Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Not Active</option>

                                                                </select>

                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput"> Status Accept Order</label>

                                                                <select name="status_accept_order"
                                                                    class="form-control" required>
                                                                    <option>Select Status To Accept Order</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Has Order</option>                                                    
                                                   
                                                                  

                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Phone</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="simpleInput" placeholder="0987654321"
                                                                        name="phone" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Age</label>
                                                                    <input type="number" class="form-control"
                                                                        id="simpleInput" placeholder="30"
                                                                        name="age" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput">Gender</label>

                                                                <select name="gender" class="form-control" required>
                                                                    <option>Select Delivery Agent Gender</option>
                                                                    <option value="1">Man</option>
                                                                    <option value="0">Woman</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Delivery Agent
                                                                        Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="simpleInput" name="img" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Location Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="locationName"
                                                                        name="locationName" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <input type="hidden" id="latitudeStart" name="latitudeStart">
                                                            <input type="hidden" id="latitudeEnd" name="latitudeEnd">
                                                            <br>
                                                            <input type="hidden" id="longitudeStart" name="longitudeStart">
                                                            <input type="hidden" id="longitudeEnd" name="longitudeEnd">
                                                        </div>
                                                        
                                                        <div id="map" style="height: 500px; width: 1000px;"></div>
                                                        <div id="radiusSlider">
                                                            <label for="radius">Radius:</label>
                                                            <input type="range" id="radius" name="radius" min="100" max="5000" step="100" value="1000">
                                                            <span id="radiusValue">1000 meters</span>
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <button type="submit" class="btn btn-primary rounded">Ok</button>
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
        var map, circle;
    
        function initMap() {
            var myLatLng = { lat: -34.397, lng: 150.644 }; // default location
    
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    myLatLng = { lat: position.coords.latitude, lng: position.coords.longitude };
    
                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: myLatLng
                    });
    
                    // Create a circle with a default radius
                    circle = new google.maps.Circle({
                        map: map,
                        center: myLatLng,
                        radius: parseInt(document.getElementById('radius').value),
                        editable: true,
                    });
    
                    // Add event listener to circle for radius and center update
                    google.maps.event.addListener(circle, 'center_changed', function() {
                        updateCircle();
                    });
                    google.maps.event.addListener(circle, 'radius_changed', function() {
                        updateCircle();
                    });
    
                    updateCircle(); // Initialize hidden input values
    
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    
        function updateCircle() {
            var circleCenter = circle.getCenter();
            var circleRadius = circle.getRadius();
    
            document.getElementById('latitudeStart').value = circleCenter.lat() - (circleRadius / 111.32);
            document.getElementById('latitudeEnd').value = circleCenter.lat() + (circleRadius / 111.32);
            document.getElementById('longitudeStart').value = circleCenter.lng() - (circleRadius / (111.32 * Math.cos(circleCenter.lat() * (Math.PI / 180))));
            document.getElementById('longitudeEnd').value = circleCenter.lng() + (circleRadius / (111.32 * Math.cos(circleCenter.lat() * (Math.PI / 180))));
    
            document.getElementById('radiusValue').innerText = circleRadius + " meters";
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBddryhfLC4gYIvreVc9YDY4gLv2BrhhmY&callback=initMap"></script>


</body>

</html>
