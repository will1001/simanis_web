<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
  .Container {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .form-bg {
    width: 50%;
  }

  .form-container {
    font-family: 'Poppins', sans-serif;
    position: relative;
    z-index: 1;
  }

  .form-container .form-horizontal {
    background-color: #fff;
    padding: 30px 30px 10px;
    border: 1px solid #e7e7e7;
  }

  .form-container .form-horizontal:before,
  .form-container .form-horizontal:after {
    content: '';
    background-color: #fff;
    height: 100%;
    width: 100%;
    border: 1px solid #e7e7e7;
    transform: rotate(3deg);
    position: absolute;
    left: 0;
    top: 0;
    z-index: -1;
  }

  .form-container .form-horizontal:after {
    transform: rotate(-3deg);
  }

  .form-container .title {
    color: #777;
    background: linear-gradient(to right, #f5f5f5, transparent, transparent, transparent, #f5f5f5);
    font-size: 23px;
    font-weight: 600;
    text-align: center;
    text-transform: capitalize;
    padding: 2px;
    margin: 0 0 20px 0;
  }

  .form-horizontal .form-group {
    background-color: #eaeaea;
    font-size: 0;
    margin: 0 0 15px;
    border: 1px solid #d1d1d1;
    border-radius: 3px;
  }

  .form-horizontal .input-icon {
    color: #888;
    font-size: 18px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    width: 40px;
    vertical-align: top;
    display: inline-block;
  }

  .form-horizontal .form-control {
    color: #555;
    background-color: transparent;
    font-size: 14px;
    letter-spacing: 1px;
    width: calc(100% - 55px);
    height: 40px;
    padding: 2px 10px 2px 0;
    box-shadow: none;
    border: none;
    border-radius: 0;
    display: inline-block;
    transition: all 0.3s;
  }

  .form-horizontal .form-control:focus {
    box-shadow: none;
    border: none;
  }

  .form-horizontal .form-control::placeholder {
    color: rgba(0, 0, 0, 0.7);
    font-size: 14px;
    text-transform: capitalize;
  }

  .form-horizontal .btn {
    color: #fff;
    background: linear-gradient(#1dd1a1, #10ac84);
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    width: 100px;
    padding: 5px 18px;
    margin: 0 0 15px 0;
    border: none;
    border-radius: 30px;
    display: inline-block;
    transition: all 0.3s ease;
  }

  .form-horizontal .btn:hover,
  .form-horizontal .btn:focus {
    color: #fff;
    letter-spacing: 2px;
  }

  .form-horizontal .forgot-pass {
    font-size: 12px;
    text-align: right;
    width: calc(100% - 105px);
    display: inline-block;
    vertical-align: top;
  }

  .form-horizontal .forgot-pass a,
  .form-horizontal .register a {
    color: #999;
    transition: all 0.3s ease;
  }

  .form-horizontal .forgot-pass a:hover,
  .form-horizontal .register a:hover {
    color: #555;
    text-decoration: underline;
  }

  .form-horizontal .register {
    font-size: 12px;
    text-align: center;
    padding-top: 8px;
    border-top: 1px solid #e7e7e7;
    display: block;
  }
</style>
<div class="Container">
  <div class="form-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
          <div class="form-container">
            <form class="form-horizontal" method="POST" action="{{url('login')}}">
              @csrf
              <h3 class="title">Simanis</h3>
              <!-- build ulang -->

              <div class="flex items-center">
                <span class="mr-2 mb-4 w-[100px]">NIK : </span>
                <div class="form-group p-1">
                  <input class="form-control" type="string" placeholder="NIK" name="nik">
                </div>
              </div>

              <div class="flex items-center">
                <span class="mr-2 mb-4 w-[100px]">Password : </span>
                <div class="form-group p-1">
                  <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
              </div>
              <button class="btn signin">Log in</button>
              <span class="register"><a href="{{url('daftar')}}">Daftar</a></span>
            </form>
            @if (!empty($msg))
            <div>{{$msg}}</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>