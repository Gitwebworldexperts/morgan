<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
<body>
    @include('layouts.header')    
    @include('layouts.nav')    

    @yield('content')
@include('layouts.footer')
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/owl.carousel.js')}}"></script>
        <script src="{{asset('js/lightgallery.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

  <!-- Modal -->
  <div class="modal fade" id="documentNotFound" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="alertTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="alertContent">
          ...
        </div>
      </div>
    </div>
  </div>

</body>

</html>

