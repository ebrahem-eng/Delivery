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

    @include('layouts.Store.Link')
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
            @include('layouts.Store.Header')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    {{-- SideBar --}}
                    @include('layouts.Store.Sidebar')

                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Update Product</h5>
                                            <p class="m-b-0">Welcome to Delivery Dashboard</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('store.dashboard') }}">Dashboard</a>
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

                                                    <h5>Update Product</h5>

                                                </div>
                                                <div class="card-block">

                                                    <form method="POST" action="{{ route('store.product.update' ,  $product->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="simpleInput" placeholder="Name"
                                                                        name="name" value="{{$product->name}}" required>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Price</label>
                                                                    <input type="number" class="form-control"
                                                                        id="simpleInput" placeholder="20000 SYP"
                                                                        name="price" value="{{$product->price}}" required>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <label for="simpleInput">Status</label>

                                                                <select name="status" class="form-control" required>
                                                                    <option>Select Code Status</option>
                                                                    <option value="1" {{ $product->status === 1 ? 'selected' : '' }} >Active</option>
                                                                    <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Not Active</option>

                                                                </select>

                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Product Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="simpleInput" name="img">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="simpleInput">Details</label>

                                                                        <textarea name="details" class="form-control" id="simpleInput" cols="30" rows="5" required>
{{$product->details}}
                                                                        </textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="simpleInput">Product Category</label>

                                                                @foreach ($catigories as $catigory)
                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="category_{{ $catigory->id }}"
                                                                            name="catigoryID[]"
                                                                            value="{{ $catigory->id }}"
                                                                            {{ $productCatigoryIDs->contains($catigory->id) ? 'checked' : '' }}>
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
