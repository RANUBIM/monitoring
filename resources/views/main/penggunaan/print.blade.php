<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Bahan</title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="">

    <style type="text/css">
        @page {
            size: Legal
        }


        * {
            /* background: none; */
            /* border: none; */
        }

        body {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1;
            word-spacing:1.25spt;
            letter-spacing: 0.2pt;
            font-family: Garamond, "Times New Roman", serif;
            color: #000;
            background: none;
            font-size: 14pt;
        }

        tr.spaceUnder>td {
            padding-bottom: 5em;
        }

        .pagebreak {
            page-break-after: always;
        }

        /* .garisgaris table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        } */

    </style>

</head>

<body class="Legal">
    <section class="pagebreak">

        {{-- KOP SURAT --}}
        <div class="row">
            <div class="col-3">
                <center>
                    <img src="../../assets/img/surat/KOP KIRI.png" class="img-fluid" style="height: 95px; width: auto">
                </center>
            </div>
            <div class="col-6">
                <center>
                <div class="sekolah" class="">
                    SEKOLAH MENENGAH KEJURUAN (SMK) HASANAH PEKANBARU
                </div>
                <br>
                <div class="detail-judul" style="font-size: 15px;">
                    <strong>BUKTI PENGAMBILAN BAHAN PRAKTEK</strong>
                </div>
                </center>
            </div>
            <div class="col-3">
                <img src="../../assets/img/surat/KOP KANAN.png" class="img-fluid" style="height: 95px; width: auto">
            </div>
        </div>
        {{-- KOP SURAT --}}

        {{-- NAMA SURAT --}}
        <hr style="border: 2px solid black;">
        <div class="row">
            <div class="col-12">
                <div style="line-height: 1;">
                    <table align="center">
                        <tr>
                            <td>
                                <center>
                                    <font style="font-weight: bold; text-decoration: underline;">
                                        {{-- {{ strtoupper($data->letter_name) }}</font> --}}
                                        DATA PENGGUNAAN BAHAN
                                    <br>
                                    {{-- Nomor : Index Surat --}}
                                    {{-- {{ $data->letter_index }} --}}
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- NAMA SURAT --}}

        <br>

        {{-- KATA PEMBUKA --}}
        {{-- <div class="kata-pembuka">
            <table align="justify" style="line-height: 1.5;">
                <tr>
                    <td>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span> Kondisi alat sebelum peminjamaan <strong>{{ $datas->kondisi_peminjaman }}</strong>, kondisi alat saat dikembalikan <strong>{{ $datas->kondisi_pengembalian }}</strong>
                    </td>
                </tr>
            </table>
        </div> --}}
        {{-- /KATA PEMBUKA --}}

        {{-- DATA --}}
        <div class="row">
            <div style="line-height: 1; margin-top: 10px;">
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            Pengguna
                        </div>
                        <div class="col-8">
                            : {{ $datas->dataUser->nama }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-4">
                            Mata Pelajaran/Kegiatan
                        </div>
                        <div class="col-8">
                            : {{ $datas->kegiatan }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-4">
                            Tujuan
                        </div>
                        <div class="col-8">
                            : {{ $datas->tujuan }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-4">
                            Tanggal Penggunaan
                        </div>
                        <div class="col-8">
                            : {{ \Carbon\Carbon::parse($datas->tgl_permintaan)->translatedFormat('d M Y') }} 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            Kondisi Bahan
                        </div>
                        <div class="col-8">
                            : {{ $datas->note }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- DATA --}}
        
        <br>
        
        {{-- DATA --}}
        <div class="col-12">
            <table class="table table-hover table-responsive-lg table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Labor</th>
                        <th scope="col">Nama Bahan</th>
                        <th scope="col">Spesifikasi</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($datas as $data) --}}
                    @foreach ($datas->dataBahan as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-left">{{ $item->dataLabor->nama }}</td>
                            <td class="text-left">{{ $item->nama }}</td>
                            <td class="text-left">{{ $item->spesifikasi }}</td>
                            <td>{{ $item->pivot->jumlah }} {{ $item->satuan }}</td>
                            {{-- <td>
                            @foreach ($datas->dataAlat as $item)
                            {{ $item['nama'] }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($datas->dataAlat as $item)
                            {{ $item->pivot->jumlah }}
                            @endforeach
                        </td> --}}

                            {{-- Tombol Aksi Dropdown --}}
                            {{-- <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="/detail-peminjaman/{{ $datas->uuid }}" class="dropdown-item">Detail</a>
                                        <a href="/peminjaman/{{ $datas->uuid }}/edit" class="dropdown-item">Edit</a>
                                        
                                        <form action="/peminjaman/{{ $datas->uuid }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                        </form>
                                    </div>
                                </div>
                            </td> --}}
                            {{-- /Tombol Aksi Dropdown --}}
                        </tr>
                    @endforeach
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
        {{-- /DATA --}}

        <br>

        {{-- <div class="col-12">
            <table align="justify" style="line-height: 1.5; margin-top:10px">
                <tr>
                    <td class="justify">
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Demikianlah surat permohonan ini kami
                        buat dengan sebenarnya, untuk dapat dipergunakan seperlunya. 
                    </td>
                </tr>
            </table>
        </div> --}}


        {{-- TANDA TANGAN --}}
        <div class="row">
            <div class="col-6">
                <div style="margin-bttom:10px; overflow:auto;">
                    <table align="left" width="320">
                        <tr>
                            <td width="">Mengetahui,</td>
                            {{-- <td width="10 px">: </td>
                            <td width=""> [---] </td> --}}
                            <td></td>
                        </tr>
                        <tr>
                            <td style=" border-bottom: 1px solid #000; ">Kepala Bagian/Unit Kerja</td>
                            {{-- <td style=" border-bottom: 1px solid #000;">: </td>
                            <td style=" border-bottom: 1px solid #000;"> --}}
                                {{-- {{ \Carbon\Carbon::now()->translatedFormat('d MM Y') }} --}}
                                {{-- </td> --}}
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <div style="margin-bttom:10px; overflow:auto;">
                    <table align="right" width="320">
                        <tr>
                            <td width="">Pekanbaru, {{ \Carbon\Carbon::now()->translatedFormat('d MM Y') }}</td>
                            {{-- <td width="10 px">: </td>
                            <td width=""> [---] </td> --}}
                            <td></td>
        
                        </tr>
                        <tr>
                            <td style=" border-bottom: 1px solid #000; ">Pengguna</td>
                            {{-- <td style=" border-bottom: 1px solid #000;">: </td>
                            <td style=" border-bottom: 1px solid #000;"> --}}
                                
                                </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <table align="right" width="400" >
                <tr class="spaceUnder">
                    <td width=""> </td>
                    <td>
                        {{-- <center> tes </center> --}}
                    </td>
                </tr>
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> Riki Arso, S.Kom </b></u></center>
                    </td>
                </tr>
            </table>
            </div>
            <div class="col-6">
                <table align="right" width="400" >
                <tr class="spaceUnder">
                    <td width=""> </td>
                    <td>
                        {{-- <center> tes </center> --}}
                    </td>
                </tr>
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> {{ $datas->dataUser->nama }} </b></u></center>
                    </td>
                </tr>
            </table>
            </div>
        </div>
            
        
        {{-- TANDA TANGAN --}}


        {{-- @if ($data->user->position == 'Kepala Desa') --}}
            {{-- <table align="right" width="400" border="1px">


                @if ($data->signature == 'wet')
                    <tr class="spaceUnder">
                        <td width=""> </td>
                        <td>
                            <center> {{ strtoupper($data->user->position) }}
                                {{ strtoupper($informations->village_name) }} </center>
                        </td>
                @endif
                @if ($data->signature == 'digital')
                    <tr>
                        <td> </td>
                        <td>
                            <center> {{ strtoupper($data->user->position) }}
                                {{ strtoupper($informations->village_name) }} </center>
                        </td>
                    <tr>

                        <td> </td>
                        <td>
                            <center> <img src="{{ asset('/storage/' . $informations->signature) }}"
                                    class="img-fluid" width="100"></center>

                    </tr>
                @endif
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                    {{ $data->user->back_title }} </b></u></center>
                    </td>
                </tr>
            </table> --}}
        {{-- @else
            <table align="right" width="400" border="1px">
                <tr class="spaceUnder">
                    <td width=""> </td>
                    <td>
                        <center>An. KEPALA DESA {{ strtoupper($informations->village_name) }}<BR>
                            {{ strtoupper($data->user->position) }} {{ strtoupper($informations->village_name) }}
                        </center>

                    </td>
                <tr>
                    <td width=""> </td>
                    <td>
                        <center><u><b> {{ $data->user->front_title }} {{ strtoupper($data->user->name) }}
                                    {{ $data->user->back_title }} </b></u></center>
                    </td>
                </tr>

            </table>
        @endif --}}


        <div style="margin-top:-50px; margin-left:70px;" class="right">

            {{-- {!! QrCode::size(100)->generate('Dokumen sah Desa ' . $informations->village_name . ' Hari/Tanggal ' . $data->letter_date . ' Untuk Keperluan ' . $data->letter_name . '-' . $data->name) !!} --}}

        </div>
        </div>
    </section>


</body>

</html>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<!-- prevent ctrl+s ctrl+u rightclick -->
<script>
    document.onkeypress = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }
    document.onmousedown = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }
    document.onkeydown = function(event) {
        event = (event || window.event);
        return keyFunction(event);
    }

    //Disable right click script 
    var message = "Sorry, right-click has been disabled";

    function clickIE() {
        if (document.all) {
            (message);
            return false;
        }
    }

    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which == 2 || e.which == 3) {
                (message);
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    } else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
    }
    document.oncontextmenu = new Function("return false")

    function keyFunction(event) {
        //"F12" key
        if (event.keyCode == 123) {
            return false;
        }

        if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
            return false;
        }
        //"J" key
        if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
            return false;
        }
        //"S" key
        if (event.keyCode == 83) {
            return false;
        }
        //"U" key
        if (event.ctrlKey && event.keyCode == 85) {
            return false;
        }
        //F5
        if (event.keyCode == 116) {
            return false;
        }
    }
</script>
<script>
    window.print();
    window.onfocus = function() {
        setTimeout(function() {
            window.close();
        }, 300);
    }
</script>
