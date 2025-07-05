<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>

<body class="bg-light">

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-body shadow pt-2 ">
        <div class="container">
            <a class="navbar-brand" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bike h-8 w-8 text-dark">
                    <circle cx="18.5" cy="17.5" r="3.5"></circle>
                    <circle cx="5.5" cy="17.5" r="3.5"></circle>
                    <circle cx="15" cy="5" r="1"></circle>
                    <path d="M12 17.5V14l-3-3 4-3 2 3h2"></path>
                </svg>
                <span class="text-xl font-bold text-drak ps-1">BikeCare</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav  ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Book Service</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-primary text-white " href="{{ route('dashboard') }}">Admin Panel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="toast show position-fixed bg-info bottom-0 end-0 m-3" id="toast" role="alert"
            aria-live="assertive" aria-atomic="true">

            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endif



    <div class="container pt-4">

        <div class="">

            <div class="text-center mb-4">
                <h1 class=" mb-4">Professional Bike Service</h1>
                <p class="mx-auto">Get your bike serviced by certified mechanics.
                    Book
                    online and we'll take care of the rest.</p>
            </div>
            <div class=" row  mb-8">
                <div class="p-4 rounded border-2 shadow  col-12 col-sm-3">
                    <h3 class="font-semibold text-gray-900 mb-1">Basic Service</h3>
                    <p class="text-primary font-medium mb-2">From 150</p>
                    <p class="text-sm text-gray-600">Chain cleaning, basic adjustment</p>
                </div>
                <div class="p-4 rounded border-2 shadow  col-12 col-sm-3">
                    <h3 class="font-semibold text-gray-900 mb-1">Standard Service</h3>
                    <p class="text-primary font-medium mb-2">From $80</p>
                    <p class="text-sm text-gray-600">Full tune-up, brake adjustment</p>
                </div>
                <div class="p-4 roundedborder-2 shadow col-12 col-sm-3">
                    <h3 class="font-semibold text-gray-900 mb-1">Premium Service</h3>
                    <p class="text-primary font-medium mb-2">From $120</p>
                    <p class="text-sm text-gray-600">Complete overhaul, parts replacement</p>
                </div>
                <div class="p-4 rounded border-2 shadow col-12 col-sm-3 ">
                    <h3 class="font-semibold text-gray-900 mb-1">Repair Service</h3>
                    <p class="text-primary font-medium mb-2">Quote on inspection</p>
                    <p class="text-sm text-gray-600">Specific issue diagnosis and repair</p>
                </div>
            </div>
            <div class="bg-white mt-3  rounded-4 shadow p-5">
                <form class="form" action="{{ route('service.store') }}" method="POST">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center"><svg
                                xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user me-2 h-5 w-5 mr-2 text-primary">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>Customer Information</h3>


                        <div class="row ">
                            <div class ="col-6">
                                <label class="form-label">Full
                                    Name</label>
                                <input type="text" name="customerName" class="form-control rounded"
                                    placeholder="Enter your full name" value="{{ old('customerName') }}">
                                @error('customerName')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class ="col-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone') }}" placeholder="(555) 123-4567" value="">
                                @error('phone')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-6"><label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="your@email.com">
                                @error('email')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6"><label class="form-label">Address</label><input type="text"
                                    name="address" class="form-control" placeholder="Your address"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <h3 class="  fs-2 pt-3  mb-4 flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide fs-2 me-2 lucide-bike h-5 w-5 mr-2 text-primary">
                                    <circle cx="18.5" cy="17.5" r="3.5"></circle>
                                    <circle cx="5.5" cy="17.5" r="3.5"></circle>
                                    <circle cx="15" cy="5" r="1"></circle>
                                    <path d="M12 17.5V14l-3-3 4-3 2 3h2"></path>
                                </svg>Bike Information</h3>
                            <div class=" row ">
                                <div class="col-12 col-sm-6">
                                    <label class=" form-label mb-2">Bike Type</label>
                                    <select name="bikeType" class=" form-control ">
                                        <option disabled selected>Select bike type</option>
                                        <option value="Road Bike">Road Bike</option>
                                        <option value="Mountain Bike">Mountain Bike</option>
                                        <option value="Hybrid">Hybrid</option>
                                        <option value="Electric Bike">Electric Bike</option>
                                        <option value="BMX">BMX</option>
                                        <option value="Cruiser">Cruiser</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('bikeType')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label mb-2">Brand</label><input type="text"
                                        name="bikeBrand" value="{{ old('bikeBrand') }}"
                                        class="  border form-control " placeholder="e.g., Trek, Giant, Specialized">
                                    @error('bikeBrand')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="col-12 col-sm-4"><label class="form-label mb-2">Model</label><input
                                        type="text" name="bikeModel" class="form-control"
                                        placeholder="Bike model" value="{{ old('bikeModel') }}">
                                    @error('bikeModel')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-2"><label class="form-label mb-2"> Bike Number  </label><input
                                        type="text" name="bikenumber" class="form-control"
                                        placeholder="Bike number" value="{{ old('bikenumber') }}">
                                    @error('bikenumber')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6"><label class="form-label mb-2">Year</label><input
                                        type="number" name="year" min="1980" max="2025"
                                        class="form-control" placeholder="2023"value="{{ old('year') }}">
                                    @error('year')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <h3 class=" fs-2 pt-3  mb-4 flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-calendar me-2 h-5 w-5 mr-2 text-primary">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>Service Details</h3>
                            <div class="row ">
                                <div class="col-12 col-sm-6"><label class=" form-lable mb-2">Preferred
                                        Date</label><input type="date" name="preferredDate" min="2025-06-30"
                                        class="form-control" value="{{ old('preferredDate') }}">
                                    @error('preferredDate')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row gp-3">

                                        <div class="col-4 ">
                                            <label class=" form-lable mb-2"> Service Type </label>
                                            <div class="d-flex gap-2">
                                        <div class="form-check">
                                                <input type="radio" class="form-check-input" id="pickup"
                                                    name="service_type" value="pickup">
                                                <label class="form-check-label" for="pickup">Pickup</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="drop" value="drop"
                                                    name="service_type">
                                                <label class="form-check-label" for="drop">Drop</label>
                                            </div>
                                            </div>
                                            @error('service_type')
                                            <div class="error"> {{ $message }} </div>

                                            @enderror
                                        </div>

                                        <div class="col-4">
                                            <label for="preferredTime" class="form-label mb-2">Preferred Time</label>
                                            <input type="time" value="{{ old('preferredTime') }}"
                                                name="preferredTime" id="preferredTime" class="form-control">
                                            @error('preferredTime')
                                                <div class="text-danger small mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class=" col-12 col-sm-6 mt-4"><label class=" form-lable mb-2">Urgency
                                        Level</label><select name="urgency" class="form-control">
                                        <option selected disabled> - Select Urgency - </option>
                                        <option value="normal">Normal (3-5 days)</option>
                                        <option value="urgent">Urgent (1-2 days)</option>
                                        <option value="emergency">Emergency (Same day)</option>
                                    </select>
                                    @error('urgency')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-12 col-sm-6 mt-4">
                                    <label class="form-lable mb-2">
                                        Service </label>
                                    <select class="form-control" name="service">
                                        <option disabled selected>-Select Service-</option>
                                        <option value="Basic Service">Basic Service</option>
                                        <option value="Standard Service">Standard Service</option>
                                        <option value="Premium Service">Premium Service</option>
                                        <option value="Repair Service">Repair Service</option>
                                    </select>
                                    @error('issues')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mt-4"><label class=" form-lable mb-2">Describe
                                        Issues or Special Requests</label>
                                    <textarea name="issues" value="{{ old('issues') }}" class="form-control"
                                        placeholder="Describe any specific issues with your bike or special requests..."></textarea>
                                    @error('issues')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center pt-4   "><button type="submit"
                                    class=" btn btn-primary form-control pt-4 pb-4">Book
                                    Service Appointment</button></div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
