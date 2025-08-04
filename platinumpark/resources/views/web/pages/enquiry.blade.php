@extends('web.layouts.master')


@section('content')

 <section class="section-content content enquiry-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>MAKE AN ENQUIRY</h1>
                <p>Please select the nature of your query from the 
                    respective boxes. </p>
            </div>
            <div class="col-12 col-md-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="food-tab" data-toggle="tab" href="#food" role="tab" aria-controls="food" aria-selected="true">
                            <img class="normal" src="{{ asset('assets/web/images/enquiry/asset-1.png') }}" alt="">
                            <img class="hover" src="{{ asset('assets/web/images/enquiry/asset-5.png') }}" alt="">
                            Food & Beverages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="leasing-tab" data-toggle="tab" href="#leasing" role="tab" aria-controls="leasing" aria-selected="false">
                            <img class="normal" src="{{ asset('assets/web/images/enquiry/asset-2.png') }}" alt="">
                            <img class="hover" src="{{ asset('assets/web/images/enquiry/asset-6.png') }}" alt="">
                            Leasing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">
                            <img class="normal" src="{{ asset('assets/web/images/enquiry/asset-3.png') }}" alt="">
                            <img class="hover" src="{{ asset('assets/web/images/enquiry/asset-7.png') }}" alt="">
                            Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">
                            <img class="normal" src="{{ asset('assets/web/images/enquiry/asset-4.png') }}" alt="">
                            <img class="hover" src="{{ asset('assets/web/images/enquiry/asset-8.png') }}" alt="">
                            General
                        </a>
                      </li>
                  </ul>
            </div>
        </div>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="food" role="tabpanel" aria-labelledby="food-tab">
                <form action="{{ route('enquiry.store') }}" class="enquiry-form" method="post" role="form" name="contactForm">
                    @csrf
                    <input type="hidden" value="food" name="type">
                    <div class="row">
                        <div class="col-12">
                            <p>* MANDATORY TO FILL</p>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <select name="gender" id="gender">
                                <option value="MR" selected>MR</option>
                                <option value="MS">MS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="contact" required="" placeholder="CONTACT NUMBER*">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="first_name" required="" placeholder=" NAME*" >
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="email" required="" placeholder="EMAIL ADDRESS*">
                        </div>
                        {{-- <div class="form-group col-12 col-sm-6">
                            <input type="text" name="last_name" required="" placeholder="LAST NAME*" >
                        </div> --}}
                        <div class="form-group col-12 col-sm-6">
                            <select name="services" id="services">
                                <option value selected disabled >RELATED SERVICES</option>
                                <option value="investment">INVESTMENT</option>
                                <option value="leasing">LEASING</option>
                                <option value="other services">OTHER SERVICES</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-6">
                           
                        </div>

                        {{-- <div class="form-group col-12 col-sm-6">
                            <label for="inquiry" class="label-form">INQUIRY</label>
                            <textarea name="inquiry" id="inquiry"></textarea>
                        </div> --}}

                        <div class="form-group-checkbox col-12 col-sm-6">
                            <input type="checkbox" id="asset_checkbox" name="asset_checkbox" value="Yes">
                            <label for="asset_checkbox">I would like to know more about Platinum Park</label>
                        </div>

                        <div class="form-group-submit col-12">
                            <button type="submit" class="submit-btn" name="submit-form">SUBMIT</button>
                        </div>
            
                    
                    </div>
                    

                
                </form>
            </div>


            <div class="tab-pane fade" id="leasing" role="tabpanel" aria-labelledby="leasing-tab">
                <form action="{{ route('enquiry.store') }}" class="enquiry-form" method="post" role="form" name="contactForm">
                    @csrf
                    <input type="hidden" value="food" name="type">
                    <div class="row">
                        <div class="col-12">
                            <p>* MANDATORY TO FILL</p>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <select name="gender" id="gender">
                                <option value="MR" selected>MR</option>
                                <option value="MS">MS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="contact" required="" placeholder="CONTACT NUMBER*">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="first_name" required="" placeholder=" NAME*" >
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="email" required="" placeholder="EMAIL ADDRESS*">
                        </div>
                        {{-- <div class="form-group col-12 col-sm-6">
                            <input type="text" name="last_name" required="" placeholder="LAST NAME*" >
                        </div> --}}
                        <div class="form-group col-12 col-sm-6">
                            <select name="services" id="services">
                                <option value selected disabled >RELATED SERVICES</option>
                                <option value="investment">INVESTMENT</option>
                                <option value="leasing">LEASING</option>
                                <option value="other services">OTHER SERVICES</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-6">
                           
                        </div>

                        {{-- <div class="form-group col-12 col-sm-6">
                            <label for="inquiry" class="label-form">INQUIRY</label>
                            <textarea name="inquiry" id="inquiry"></textarea>
                        </div> --}}

                        <div class="form-group-checkbox col-12 col-sm-6">
                            <input type="checkbox" id="asset_checkbox_2" name="asset_checkbox" value="Yes">
                            <label for="asset_checkbox_2">I would like to know more about Platinum Park</label>
                        </div>

                        <div class="form-group-submit col-12">
                            <button type="submit" class="submit-btn" name="submit-form">SUBMIT</button>
                        </div>
            
                    
                    </div>
                    

                
                </form>
            </div>

            <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events-tab">
                <form action="{{ route('enquiry.store') }}" class="enquiry-form" method="post" role="form" name="contactForm">
                    @csrf
                    <input type="hidden" value="food" name="type">
                    <div class="row">
                        <div class="col-12">
                            <p>* MANDATORY TO FILL</p>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <select name="gender" id="gender">
                                <option value="MR" selected>MR</option>
                                <option value="MS">MS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="contact" required="" placeholder="CONTACT NUMBER*">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="first_name" required="" placeholder=" NAME*" >
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="email" required="" placeholder="EMAIL ADDRESS*">
                        </div>
                        {{-- <div class="form-group col-12 col-sm-6">
                            <input type="text" name="last_name" required="" placeholder="LAST NAME*" >
                        </div> --}}
                        <div class="form-group col-12 col-sm-6">
                            <select name="services" id="services">
                                <option value selected disabled >RELATED SERVICES</option>
                                <option value="investment">INVESTMENT</option>
                                <option value="leasing">LEASING</option>
                                <option value="other services">OTHER SERVICES</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-6">
                           
                        </div>

                        {{-- <div class="form-group col-12 col-sm-6">
                            <label for="inquiry" class="label-form">INQUIRY</label>
                            <textarea name="inquiry" id="inquiry"></textarea>
                        </div> --}}

                        <div class="form-group-checkbox col-12 col-sm-6">
                            <input type="checkbox" id="asset_checkbox_3" name="asset_checkbox" value="Yes">
                            <label for="asset_checkbox_3">I would like to know more about Platinum Park</label>
                        </div>

                        <div class="form-group-submit col-12">
                            <button type="submit" class="submit-btn" name="submit-form">SUBMIT</button>
                        </div>
            
                    
                    </div>
                    

                
                </form>
            </div>

            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form action="{{ route('enquiry.store') }}" class="enquiry-form" method="post" role="form" name="contactForm">
                    @csrf
                    <input type="hidden" value="food" name="type">
                    <div class="row">
                        <div class="col-12">
                            <p>* MANDATORY TO FILL</p>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <select name="gender" id="gender">
                                <option value="MR" selected>MR</option>
                                <option value="MS">MS</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="contact" required="" placeholder="CONTACT NUMBER*">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="first_name" required="" placeholder=" NAME*" >
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <input type="text" name="email" required="" placeholder="EMAIL ADDRESS*">
                        </div>
                        {{-- <div class="form-group col-12 col-sm-6">
                            <input type="text" name="last_name" required="" placeholder="LAST NAME*" >
                        </div> --}}
                        <div class="form-group col-12 col-sm-6">
                            <select name="services" id="services">
                                <option value selected disabled >RELATED SERVICES</option>
                                <option value="investment">INVESTMENT</option>
                                <option value="leasing">LEASING</option>
                                <option value="other services">OTHER SERVICES</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-6">
                           
                        </div>

                        {{-- <div class="form-group col-12 col-sm-6">
                            <label for="inquiry" class="label-form">INQUIRY</label>
                            <textarea name="inquiry" id="inquiry"></textarea>
                        </div> --}}

                        <div class="form-group-checkbox col-12 col-sm-6">
                            <input type="checkbox" id="asset_checkbox_4" name="asset_checkbox" value="Yes">
                            <label for="asset_checkbox_4">I would like to know more about Platinum Park</label>
                        </div>

                        <div class="form-group-submit col-12">
                            <button type="submit" class="submit-btn" name="submit-form">SUBMIT</button>
                        </div>
            
                    
                    </div>
                    

                
                </form>
             </div>
        </div>
    </div>
 </section>

@endsection

