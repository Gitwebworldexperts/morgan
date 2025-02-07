@extends('layouts.app')
@section('title', "Mortgage Calculator ")
@section('content')
@php
    $footerSection = getFooterSection();    
@endphp
<!-- breadcrumb -->
    <section class="breadcrumb-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-container">
                        <ul>
                            <li><a href="{{ asset('/') }}" class="">Home</a></li>
                            <li><span>Mortgage Calculator</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>




        <!-- welcome text -->
        <section class="welcome-text-section space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="welcome-text mortgage-text">
                            <h3 class="text-left">Try Our Mortgage <br>Calculator Today!</h3>
                            <p>Use our mortgage calculator to estimate your monthly mortgage payments..</p>
                            <br>
							
							
							
							<div class="morgage-form desktop-none">
                            <form action="">
                                <div class="form-group">
                                    <label>Property Price</label>
                                    <input class="form-control" name="" placeholder="1,000,000" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Down Payment: AED 200,000 (20%)</label>
                                    <div class="range">
                                        <input type="range" min="0" max="100" step="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Loan Duration: 25 Years</label>
                                    <div class="range">
                                        <input type="range" min="0" max="100" step="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Interest Rate:</label>
                                    <input class="form-control" name="" placeholder="3.89%" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>Interest Rate:</label>
                                    <input class="form-control" name="" placeholder="3.89%" type="text" />
                                </div>
                                <div class="form-group">
                                    <div class="result-rate">
                                        <label>Monthly repayment</label>
                                        <h3>AED 3,914</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="note">
                                        <p>* Estimated initial monthly payments based on a AED 1,000,000  purchase price with a 3.89% fixed interest rate.</p>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <a href="" class="green-btn submit-btn">Request a consultation <img src="img/arrow-right3.svg" class=""></a>
                                </div>
                            </form>
                        </div>
							
							
							
							
                            <div class="seperator"></div>
                            <div class="mortgage-question">
                                @include('blog_faq', ['page_name' => 'mortgage'])
                            </div>


                            <div class="need-help">
                                <h5>Still Need Help?</h5>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $footerSection->mortgage_advisor_number}}" class="green-btn"><img src="img/whatsapp.png" alt="" class="" />Talk to a mortgage advisor</a>
                            </div>  
                        </div>
                    </div>






                    <div class="col-lg-6 col-12 mobile-none">
                        <div class="morgage-form">
                           <!-- Success message -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Display Validation Errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('mortgage.submit') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Property Price</label>
                                    <input class="form-control" id="price" name="property_price" placeholder="1,000,000" type="text" required />
                                </div>
                                <div class="form-group">
                                    <label>Down Payment: AED <span id="down_payment">200</span> (<span id="down_percent">20</span>%)</label>
                                    <div class="range">
                                        <input id="down_payment_range" name="down_payment" value="20" type="range" min="0" max="100" step="1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Loan Duration: <span id="duration">25</span> Years</label>
                                    <div class="range">
                                        <input id="load_duration" name="load_duration" value="25" type="range" min="0" max="100" step="1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Interest Rate:</label>
                                    <input class="form-control" id="intrest_rate" name="intrest_rate" placeholder="3.89%" type="text" required />
                                </div>
                                <div class="form-group">
                                    <div class="result-rate">
                                        <label>Monthly repayment</label>
                                        <input type="hidden" name="monthely_payment" id="monthely_payment">
                                        <h3>AED <span id="calculated">3,914</span></h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="note">
                                        <p>* Estimated initial monthly payments based on a AED 1,000,000  purchase price with a 3.89% fixed interest rate.</p>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="green-btn">Request a consultation &nbsp<img src="{{ asset('img/arrow-right3.svg') }}" class=""></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>



@endsection
@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Cache DOM elements
      const priceInput = document.getElementById('price');
      const downPaymentElement = document.getElementById('down_payment');
      const interestRateInput = document.getElementById('intrest_rate');
      const downPaymentRange = document.getElementById('down_payment_range');
      const loanDurationInput = document.getElementById('load_duration');
      const loanDurationInput2 = document.getElementById('duration');
      const calculatedElement = document.getElementById('calculated');

      const calculatedInput = document.getElementById('monthely_payment');

      const downPercentElement = document.getElementById('down_percent');
      const durationElement = document.getElementById('duration');

      // Add event listeners for input events
      priceInput.addEventListener('keyup', handlePriceInput);
      interestRateInput.addEventListener('keyup', feedDataForCalculation);
      downPaymentRange.addEventListener('input', handleDownPaymentRange);
      loanDurationInput.addEventListener('input', handleLoanDurationInput);

      // Handle price input change
      function handlePriceInput() {
        const priceValue = parseFloat(priceInput.value);

        if (!isNaN(priceValue)) {
          const twentyPercent = priceValue * 0.20;
          downPaymentElement.innerHTML = twentyPercent.toFixed(2);  // Format to 2 decimals
          feedDataForCalculation();
        } else {
          console.error('Please enter a valid price.');
        }
      }

      // Handle down payment range input change
      function handleDownPaymentRange() {
        const rangeValue = parseFloat(downPaymentRange.value);
        const downPercent = rangeValue / 100;
        downPercentElement.innerHTML = rangeValue;
        downPaymentElement.innerHTML = (parseFloat(priceInput.value) * downPercent).toFixed(2);
        feedDataForCalculation();
      }

      // Handle loan duration input change
      function handleLoanDurationInput() {
        const durationValue = loanDurationInput.value;
        durationElement.innerHTML = durationValue;
        feedDataForCalculation();
      }

      // Feed data for EMI calculation
      function feedDataForCalculation() {
        const itemPrice = parseFloat(priceInput.value);
        const downPayment = parseFloat(downPaymentElement.innerText);
        const interestRate = parseFloat(interestRateInput.value);
        const loanDurationYears = parseFloat(loanDurationInput2.innerText);

        if (isNaN(itemPrice) || isNaN(downPayment) || isNaN(interestRate) || isNaN(loanDurationYears)) {
          calculatedElement.innerHTML = '0';
          calculatedInput.value = '0';
          return;
        }

        const total = calculateEMI(itemPrice, downPayment, interestRate, loanDurationYears);
        if (!Number.isFinite(total)) {
          total = 0; 
        } 
        calculatedInput.value = calculatedElement.innerHTML = total > 0 ? total.toFixed(2) : 0;
      }

      // EMI Calculation Function
      function calculateEMI(itemPrice, downPayment, interestRate, loanDurationYears) {
        const principal = itemPrice - downPayment;
        const monthlyInterestRate = (interestRate / 100) / 12;
        const numberOfMonths = loanDurationYears * 12;

        if (monthlyInterestRate === 0) {
          return principal / numberOfMonths;
        }

        const emi = (principal * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, numberOfMonths)) /
                    (Math.pow(1 + monthlyInterestRate, numberOfMonths) - 1);

        return emi;
      }
    });
  </script>
  <style>
    .morgage-form .form-group .form-control::placeholder {
      opacity: .3; /* Firefox */
    }
  </style>
@endsection
