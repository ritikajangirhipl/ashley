@extends('layouts.frontend')
@section('title', "Cart")
@section('styles')
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid row-gap-2" id="kt_content">
    <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    <h2 class="text-white font-weight-bold my-2 mr-5">Product Order Cart</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center mb-0">
                            <thead>
                                <tr>
                                    <th>Refr #</th>
                                    <th>Product Name</th>
                                    <th>Subject</th>
                                    <th>Duration</th>
                                    <th>costs</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('includes.cart-data')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-custom gutter-b">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center row-gap-2">
                            <h3 class="card-title">ORDER SUMMARY</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center">
                                    <tbody>
                                        <tr>
                                            <th>Total Products</th>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td>£ 49.99</td>
                                        </tr>
                                        <tr>
                                            <th>VAT</th>
                                            <td>£ 0.00</td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount Due</th>
                                            <td>£ 49.99</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b">
                        <div class="card-body">																							
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Organisation Name</label>
                                            <input type="text" class="form-control" placeholder="Your Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Contact Person Name</label>
                                            <input type="text" class="form-control" placeholder="Name of Contact Person in Company">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Contact Email Address</label>
                                            <input type="email" class="form-control" placeholder="Your Contact Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Contact Number</label>
                                            <input type="text" class="form-control" placeholder="Your Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Contact Address</label>
                                            <input type="text" class="form-control" placeholder="Your Contact Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Address Location / Town</label>
                                            <input type="text" class="form-control" placeholder="Your Address Location / Town">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Address Postcode</label>
                                            <input type="text" class="form-control" placeholder="YOur Address Postcode">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 text-left">
                                        <button class="btn btn-primary min-w-100">PROCEED TO CHECK OUT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">										
                    <div class="card card-custom gutter-b">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center row-gap-2">
                            <h3 class="card-title">find and add more products</h3>
                        </div>
                        <div class="card-body">																							
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Select Country</label>
                                            <select class="form-control select2" id="select_country">
                                                <option></option> <!-- Placeholder -->
                                                <option value="ca" data-image="https://flagcdn.com/w40/ca.png">Canada</option>
                                                <option value="in" data-image="https://flagcdn.com/w40/in.png">India</option>
                                                <option value="za" data-image="https://flagcdn.com/w40/za.png">South Africa</option>
                                                <option value="us" data-image="https://flagcdn.com/w40/us.png">United States of America</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Search Services</label>
                                            <select class="form-control select2" id="search_services" name="param">
                                                <option></option> <!-- Placeholder --> <!-- Placeholder -->
                                                <option value="web_design" data-image="https://cdn-icons-png.flaticon.com/128/2965/2965331.png">Web Design</option>
                                                <option value="seo" data-image="https://cdn-icons-png.flaticon.com/128/4289/4289977.png">SEO Optimization</option>
                                                <option value="graphic_design" data-image="https://cdn-icons-png.flaticon.com/128/2921/2921222.png">Graphic Design</option>
                                                <option value="digital_marketing" data-image="https://cdn-icons-png.flaticon.com/128/6208/6208514.png">Digital Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Search a Product</label>
                                            <select class="form-control select2" id="search_product" name="param">
                                                <option></option> <!-- Placeholder --> <!-- Placeholder -->
                                                <option value="web_design" data-image="https://cdn-icons-png.flaticon.com/128/2965/2965331.png">Web Design</option>
                                                <option value="seo" data-image="https://cdn-icons-png.flaticon.com/128/4289/4289977.png">SEO Optimization</option>
                                                <option value="graphic_design" data-image="https://cdn-icons-png.flaticon.com/128/2921/2921222.png">Graphic Design</option>
                                                <option value="digital_marketing" data-image="https://cdn-icons-png.flaticon.com/128/6208/6208514.png">Digital Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Enter Keyword</label>
                                            <input type="text" class="form-control" placeholder="Enter Keyword...">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 text-left">
                                        <button class="btn btn-primary min-w-100">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@endsection