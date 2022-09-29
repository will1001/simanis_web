@extends('layouts.perbankan')
<style>
    .actionContainer{
        width: 922px;
    }
    .boxer{
        width: 393px;
        height: 318px;
    }
    .iconSize{
        width: 18px;
        height: 18px;
    }
    .radioSize{
        width: 20px;
        height: 20px;
    }
</style>
@section('content')
<div onclick="closeDetails()" style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>


<div style="visibility: collapse;" id="detailPopUp" class=" h-[400px] fixed boxer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-white rounded-2xl">
    <div onclick="closeDetails()" class="flex-row-reverse flex cursor-pointer"><img src="{{ asset('/Icon-svg/exit.svg') }}" class="iconSize mt-3 mr-2" alt="close"></div>
    <span class="font-extrabold text-xl translate-x-1 text-slate-800 ml-5 mt-2 ">Tambah Data</span>
    <div class="flex-col ml-5">
      <form action="/simulasi/angsuran" method="post">
        @csrf
        <div class="flex justify-between items-center mr-[20px]"  >
          <span>Jumlah Pinjaman</span>
          <input class="border-1 border-gray-500  p-2" type="number" name="jumlah_dana" required>
        </div>
        <br>
        <div class="flex justify-between items-center mr-[20px]"  >
          <span>Jangka Waktu</span>
          <input class="border-1 border-gray-500  p-2" type="number" name="jangka_waktu" required>
        </div>
        <br>
        <div class="flex justify-between items-center mr-[20px]"  >
          <span>Angsuran</span>
          <input class="border-1 border-gray-500  p-2" type="number" name="angsuran" required>
        </div>
    </div>
    <div class="flex flex-row mx-auto gap-4">
      <div class="flex w-[140px] h-[52px] bg-slate-50 rounded-lg bg-cover mt-4 shadow-md">
          <input onclick="closeDetails()"  type="button" value="Cancel" class=" text-slate-10000 text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
      <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md">
          <button type="submit"  class=" text-white text-sm font-bold my-auto mx-auto h-[17px] ">Tambah Data</button>  
      </div>
    </div>  
    </form>
</div>

<div style="visibility: collapse;" id="detailPopUpEdit" class=" h-[400px] fixed boxer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-white rounded-2xl">
    <div onclick="closeDetails()" class="flex-row-reverse flex cursor-pointer"><img src="{{ asset('/Icon-svg/exit.svg') }}" class="iconSize mt-3 mr-2" alt="close"></div>
    <span class="font-extrabold text-xl translate-x-1 text-slate-800 ml-5 mt-2 ">Edit Data</span>
    <div class="flex-col ml-5">
      <form id="formEdit" action="" method="post">
        @csrf
        <div class="flex justify-between items-center mr-[20px]"  >
          <span>Angsuran</span>
          <input id="angsuran_edit" class="border-1 border-gray-500  p-2" type="number" name="angsuran" required>
        </div>
    </div>
    <div class="flex flex-row mx-auto gap-4">
      <div class="flex w-[140px] h-[52px] bg-slate-50 rounded-lg bg-cover mt-4 shadow-md">
          <input onclick="closeDetails()"  type="button" value="Cancel" class=" text-slate-10000 text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
      <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md">
          <button type="submit"  class=" text-white text-sm font-bold my-auto mx-auto h-[17px] ">Submit</button>  
      </div>
    </div>  
    </form>
</div>

<div class=" text-center h-[150px] p-2 fixed boxer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-white rounded-2xl" bg-white" style="visibility: collapse;" id="popUpStatus">
<h5 id="statusTitlePopUp"></h5>
<form action="" method="get" id="formUserStatus">
    <div class="flex flex-row mx-auto gap-4  justify-center">
      <div class="flex w-[140px] h-[52px] bg-slate-50 rounded-lg bg-cover mt-4 shadow-md">
          <input onclick="closeDetails()"  type="button" value="Cancel" class=" text-slate-10000 text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
      <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md">
          <button id="statusButtonPopUp" type="submit"  class=" text-white text-sm font-bold my-auto mx-auto h-[17px] ">Aktifasi Data</button>  
      </div>
    </div>  
    </form>
</div>

<div style="visibility: collapse;" id="popUpDelete" class=" text-center h-[150px] p-2 fixed boxer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-white rounded-2xl">
<h5>Hapus Data ? </h5>
<form action="" method="delete" id="formUserDelete">
    <div class="flex flex-row mx-auto gap-4  justify-center">
      <div class="flex w-[140px] h-[52px] bg-slate-50 rounded-lg bg-cover mt-4 shadow-md">
          <input onclick="closeDetails()"  type="button" value="Cancel" class=" text-slate-10000 text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
      <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md">
          <button id="statusButtonPopUp" type="submit"  class=" text-white text-sm font-bold my-auto mx-auto h-[17px] ">Hapus</button>  
      </div>
    </div>  
    </form>
</div>


<div id="popUpBlackbg" class="bg-slate-50 container max-w-full max-h-full actinContainer" >
  <h3 class="mt-14 font-extrabold w-[192px] h-[37px] text-slate-800">Daftar Data</h3>
  <div class="flex justify-between items-center actionContainer">
    <div class="flex">
        <div class="invisible flex w-[263px] h-[52px] bg-white rounded-lg bg-cover mt-4 shadow-md">
            <img src="{{ asset('/Icon-svg/medium.svg') }}" alt="search" class="h-8 w-8 ml-[18.5px] my-auto">
            <input type="text" placeholder="Cari NIK" class="my-auto h-6 w-[205px] ml-3 placeholder:text-sm ">
        </div>
        <div class="invisible flex">
            <div class="flex w-[154px] h-[52px] bg-white rounded-lg bg-cover mt-4 shadow-md ml-2  text-center">
                <label for="role" class="text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] w-[85px]">Semua Role</label>
                <input type="radio" id="role" name="role" class="hidden">
                <img src="{{ asset('/Icon-svg/icon.svg') }}" alt="role" class="flex ml-[18.5px] my-auto">
            </div>
        </div>
         <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md ml-[210px]">
            <input onclick="lihatDetails()" type="button" value="Tambah Data" class=" text-white text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
        </div>
    </div>
    <div class="invisible">
        <div class="flex w-[140px] h-[52px] bg-slate-100 rounded-lg bg-cover mt-4 shadow-md ml-2  text-center">
            <input type="button" value="Hapus Data" class="text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] w-[85px]">
          <img src="{{ asset('/Icon-svg/sampah.svg') }}" alt="role" class="flex ml-2 my-auto ">
        </div>
    </div>
  </div>

  <table class="actionContainer justify-between rounded-2xl mt-4 shadow-lg">
 
  <tr class="bg-tableColor-900 text-white text-center h-16">
    <td rowspan="2">Platfond</td>
    <th class="text-center border-1 border-white" colspan="{{count($JangkaWaktu)}}" scope="colgroup">Jangka Waktu</th>
    <td rowspan="2">Hapus</td>
  </tr>
  <tr class="bg-tableColor-900 text-white text-center">

  @foreach($JangkaWaktu as $key=>$item)
    <th class="text-center border-1 border-white p-2" scope="col">{{$item->waktu}}</th>
  @endforeach

  </tr>
  @foreach($JumlahPinjaman as $key1=>$item)
  <tr>
    <th class="text-center p-2" scope="row">{{$item->jumlah}}</th>
    @foreach($Simulasi as $key2=>$item2)
    @foreach($JangkaWaktu as $key3=>$item3)
          @if($item2->id_jml_pinjaman == $item->id && $item2->id_jangka_waktu == $item3->id)
            <td class="text-center">
                <div class="flex items-center">
                    <span class="mr-2 w-[70px]">{{ $item2->angsuran}}</span>
                    <a onclick="lihatDetailsEdit('{{ $item2->id}}')" href="#" class="bg-buttonColor-900 px-[15px] py-[5px] rounded-xl text-white mr-2">Edit</a>
                </div>
            </td>
          @endif
        @endforeach
      @endforeach
    <td class="text-center">
      <div class="flex justify-center items-center">
      
        <form method="POST" action="/simulasi/angsuran/delete/{{$item->jumlah}}" class="p-2 bg-buttonDelete rounded-md">
        @csrf  
        <button>
              <img class="w-[20px]" src="{{ asset('/Icon-svg/delete.svg') }}" alt="icon">
          </button>
        </form>
      </div>
    </td>

  </tr>
  @endforeach
</table>
  <div class="flex actionContainer bg-white mt-1">
    <div class="flex  actionContainer">
        <div class="flex bg-white rounded-lg mt-4 shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
    <div class="flex actionContainer justify-end mt-4">  
        <div class="flex gap-3 mx-3"> 
          <button><img src="{{ asset('/Icon-svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/Icon-svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex">
          <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>        
          <button><span class="py-1 px-3 rounded-md">2</span></button>
          <button><span class="py-1 px-3 rounded-md">3</span></button>
          <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 mx-3">
          <button><img src="{{ asset('/Icon-svg/next.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/Icon-svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>
  </div>
  



  

  
</div>






@endsection

<script>
 const lihatDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    blackBg.style.visibility = "visible";
    detailPopUp.style.visibility = "visible";
  }
 const lihatDetailsEdit = (id)=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUpEdit = document.getElementById('detailPopUpEdit');
    const formEdit = document.getElementById('formEdit');
    blackBg.style.visibility = "visible";
    detailPopUpEdit.style.visibility = "visible";
    formEdit.action="/simulasi/angsuran/edit/"+id;
  }
  const closeDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const detailPopUpEdit = document.getElementById('detailPopUpEdit');

    const popUpStatus = document.getElementById('popUpStatus');
    const popUpDelete = document.getElementById('popUpDelete');

    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    detailPopUpEdit.style.visibility = "collapse";
    popUpStatus.style.visibility = "collapse";
    popUpDelete.style.visibility = "collapse";

  }
  const openPopUpStatus = (id,status)=>{
    
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const popUpStatus = document.getElementById('popUpStatus');
    const statusTitlePopUp = document.getElementById('statusTitlePopUp');
    const statusButtonPopUp = document.getElementById('statusButtonPopUp');
    const formUserStatus = document.getElementById('formUserStatus');
    statusTitlePopUp.innerHTML = status === "Aktif" ? "Non Aktifkan User ?" : "Aktifkan User ?"
    statusButtonPopUp.innerHTML = status === "Aktif" ? "Non Aktifkan Data" : "Aktifkan Data"
    blackBg.style.visibility = "visible";
    popUpStatus.style.visibility = "visible";
    formUserStatus.action = `/user/status/${id}/${status === "Aktif" ? "Tidak Aktif": "Aktif"}`;
  }
  const openPopUpDelete = (id)=>{
    
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const popUpDelete = document.getElementById('popUpDelete');
    const formUserDelete = document.getElementById('formUserDelete');
    blackBg.style.visibility = "visible";
    popUpDelete.style.visibility = "visible";
    formUserDelete.action = `/user/delete/${id}`;

  }
</script>