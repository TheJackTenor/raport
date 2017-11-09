<?php
/*
|--------------------------------------------------------------------------
| Web Routes                                                              |
|--------------------------------------------------------------------------
| Bismillahirohmanirohim...Keajaiban dimulai dari sini !				  |
|--------------------------------------------------------------------------
*/
/* ----------------HOMEPAGE HANDLER-------------------*/
Route::get('/', function () {
	$nama = DB::table('datamadrasah')->select('namamadrasah')->first();
	session()->set('nama',$nama->namamadrasah);
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::post('homelanding', 'HomeController@homelander');
Route::get('homelandingwali','HomeController@homelanderwali');
Route::post('homelandingbk', 'HomeController@homelanderbk');
/*====================================================*/

Route::get('gock', function(){
	return View('mencobaya');
});

Route::get('just', 'CetakRaportUTSController@mencoba');
/*---------------LOGIN & AUTH HANDLER-----------------*/
Route::get('formlogon',function(){
	$nama = DB::table('datamadrasah')->select('namamadrasah')->first();
	session()->set('nama',$nama->namamadrasah);
	return view('signin');
});
Auth::routes();
/*====================================================*/

Route::get('layout/siswa','SiswaController@unduhLayout');
Route::get('layout/nilai','AspekPengetahuanController@unduhLayoutNilai');
Route::get('layout/nilaibk','AspekSikapSosialControllerBk@downloadLayoutNilaiBk');

Route::post('caripelajaran', 'HomeController@cariPelajaranBk');

Route::group(['middleware'=>['authmiddleware']], function(){
/* ---------------ADMIN MAKER HANDLER-----------------*/
Route::get('manajemenadmin/admin','AdminController@dataadmin');
Route::post('manajemenadmin/admin/prosestambahadmin','AdminController@tambahadmin');
Route::get('manajemenadmin/dataadmin/edit/{id}','AdminController@tampileditadmin');
Route::post('manajemenadmin/dataadmin/proseseditadmin','AdminController@proseseditadmin');
Route::get('manajemenadmin/dataadmin/hapus/{id}','AdminController@hapusadmin');
/*====================================================*/

/* ---------------ADMIN RULE EVERYTHING-----------------*/
Route::get('admin/as/waliprocessor/{id}','HomeController@homelander_AdminAsWali');
Route::get('admin/home','HomeController@dashboard');

Route::post('admin/checkguru','HomeController@checkguru');
Route::get('admin/guru/home','HomeController@homelander_AdminAsGuru');
Route::post('findproperguru','HomeController@findproperguru');

Route::post('admin/setguru','HomeController@setguru');

Route::post('admin/bk/processor','HomeController@adminAsBk');
Route::get('admin/bk/home','HomeController@dashboardBk');
/*====================================================*/

/* ---------------ADMIN RERATA PROCESSOR-----------------*/
Route::post('rerata','RerataController@hitungRerata');
/*====================================================*/

/* ---------------ADMIN TRANSFER NILAI-----------------*/
Route::post('caripelajarantransfer', 'TransferNilaiController@cariPelajaran');
Route::post('carikelastransfer','TransferNilaiController@cariKelas');
Route::post('carigurutertuju','TransferNilaiController@cariGuruTertuju');
Route::post('cekgurutertuju','TransferNilaiController@cekGuruTertuju');
Route::post('prosestransfernilai','TransferNilaiController@prosesTransferNilai');

/*====================================================*/

/*------------------KELAS HANDLER---------------------*/

Route::get('manajemenkelas/datakelas','KelasController@datakelas');
Route::post('manajemenkelas/datakelas/prosestambahkelas','KelasController@inputkelas');
Route::get('manajemenkelas/datakelas/hapus/{id}/{id2}','KelasController@hapuskelas');
Route::get('manajemenkelas/datakelas/edit/{id}','KelasController@edit');
Route::post('manajemenkelas/datakelas/proseseditkelas','KelasController@editeksekutor');

/*====================================================*/

/*------------------GURU HANDLER---------------------*/
Route::get('manajemenguru/dataguru','GuruController@dataguru');
Route::post('manajemenguru/dataguru/prosestambahguru','GuruController@inputguru');
Route::get('manajemenguru/dataguru/hapus/{id}/{id2}','GuruController@hapusguru');
Route::get('manajemenguru/dataguru/edit/{id}/{id2}','GuruController@edit');
Route::post('manajemenguru/dataguru/proseseditguru','GuruController@editeksekutor');

Route::get('manajemenguru/datamengajar','DataMengajarController@datamengajar');
Route::post('manajemenguru/datamengajar/prosestambahdatamengajar','DataMengajarController@inputdatamengajar');
Route::get('manajemenguru/datamengajar/hapus/{id}','DataMengajarController@hapusdatamengajar');
Route::get('manajemenguru/datamengajar/edit/{id}','DataMengajarController@edit') ;
Route::post('manajemenguru/datamengajar/proseseditdatamengajar','DataMengajarController@editeksekutor');

Route::get('manajemenguru/datamengajarkelas','DataMengajarKelasController@datamengajarkelas');
Route::post('manajemenguru/datamengajarkelas/prosestambahdatamengajarkelas','DataMengajarKelasController@inputdatamengajarkelas');
Route::get('manajemenguru/datamengajarkelas/edit/{id}','DataMengajarKelasController@editdatamengajarkelas');
Route::post('manajemenguru/datamengajarkelas/proseseditdatamengajarkelas','DataMengajarKelasController@editeksekutor');
Route::get('manajemenguru/guru/datamengajarkelas/hapus/{id}','DataMengajarKelasController@hapusdatamengajarkelas');
/*====================================================*/

/*------------------SISWA HANDLER---------------------*/
Route::get('manajemensiswa/datasiswa','SiswaController@datasiswa');
Route::post('manajemensiswa/datasiswa/prosestambahsiswa','SiswaController@inputsiswa');
Route::get('manajemensiswa/datasiswa/edit/{id}','SiswaController@edit');
Route::post('manajemensiswa/datasiswa/proseseditsiswa','SiswaController@editeksekutor');
Route::get('manajemensiswa/datasiswa/hapus/{id}','SiswaController@hapussiswa');
/*====================================================*/

/*----------------PELAJARAN HANDLER-------------------*/
Route::get('manajemenpelajaran/datapelajaran','MatapelajaranController@datapelajaran');
Route::post('manajemenpelajaran/datapelajaran/prosestambahpelajaran','MatapelajaranController@inputmatapelajaran');
Route::get('manajemenpelajaran/datapelajaran/edit/{id}','MatapelajaranController@edit');
Route::post('manajemenpelajaran/datapelajaran/proseseditpelajaran','MatapelajaranController@editeksekutor');
Route::get('manajemenpelajaran/datapelajaran/hapus/{id}','MatapelajaranController@hapusmatapelajaran');

Route::get('manajemenpelajaran/manajemendatadasarnilai','DataDasarNilaiController@datadasarnilai');
Route::post('manajemenpelajaran/manajemendatadasarnilai/simpan','DataDasarNilaiController@simpandatadasarnilai');
Route::get('manajemenpelajaran/manajemendatadasarnilai/edit/{id}','DataDasarNilaiController@edit');
Route::post('manajemenpelajaran/manajemendatadasarnilai/prosesedit','DataDasarNilaiController@prosesedit');
Route::get('manajemenpelajaran/manajemendatadasarnilai/hapus/{id}','DataDasarNilaiController@hapus');

Route::get('manajemenpelajaran/kelompokpelajaran','KelompokPelajaranController@show');
Route::post('manajemenpelajaran/kelompokpelajaran/simpan','KelompokPelajaranController@simpan');
Route::get('manajemenpelajaran/kelompokpelajaran/hapus/{id}/{id2}','KelompokPelajaranController@hapus');
Route::get('manajemenpelajaran/kelompokpelajaran/edit/{id}/{id2}','KelompokPelajaranController@tampiledit');
Route::post('manajemenpelajaran/kelompokpelajaran/prosesedit','KelompokPelajaranController@prosesedit');
/*====================================================*/

Route::post('pengaturan','PengaturanController@simpan');

Route::get('datamadrasah','DataMadrasahController@show');
Route::post('datamadrasah/simpan','DataMadrasahController@simpan');

Route::get('manajemenkaryawan','KaryawanController@datakaryawan');
Route::post('manajemenkaryawan/tambahkaryawan','KaryawanController@insertdatakaryawan');
Route::get('manajemenkaryawan/hapus/{id}','KaryawanController@hapusdatakaryawan');
Route::get('manajemenkaryawan/edit/{id}','KaryawanController@tampiledit');
Route::post('manajemenkaryawan/edit/simpan','KaryawanController@simpan');

Route::get('manajemenkaryawan/datakelasbk','KaryawanController@kelasbk');
Route::post('manajemenkaryawan/datakelasbk/simpan','KaryawanController@simpanKelasBk');
Route::get('manajemenkaryawan/datakelasbk/hapus/{id}','KaryawanController@hapusKelasBk');
Route::get('manajemenkaryawan/datakelasbk/edit/{id}','KaryawanController@editKelasBk');
Route::post('manajemenkaryawan/datakelasbk/edit/simpan','KaryawanController@simpanEditKelasBk');


});


/*====================================THIS IS WALI GURU SECTION=====================================*/
Route::get('identitaskd/pengetahuan','KdPengetahuanController@datakdpengetahuan');
Route::post('identitaskd/proseskdpengetahuan','KdPengetahuanController@simpankdpengetahuan');
Route::post('kdpengetahuantrigger','KdPengetahuanController@ajax');
Route::get('identitaskd/pengetahuan/filter','KdPengetahuanController@filter');

Route::get('identitaskd/keterampilan','KdKeterampilanController@datakdketerampilan');
Route::post('identitaskd/proseskdketerampilan','KdKeterampilanController@simpankdketerampilan');
Route::get('identitaskd/keterampilan/filter','KdKeterampilanController@filter');
Route::post('kdketerampilantrigger','KdKeterampilanController@ajax');

Route::get('identitaskd/spiritual','KdSpiritualController@datakdspiritual');
Route::get('identitaskd/spiritual/filter','KdSpiritualController@filter');
Route::post('identitaskd/proseskdspiritual','KdSpiritualController@simpankdspiritual');
Route::post('kdspiritualtrigger','KdSpiritualController@ajax');

Route::get('identitaskd/sosial','KdSosialController@datakdsosial');
Route::get('identitaskd/sosial/filter','KdSosialController@filter');
Route::post('identitaskd/proseskdsosial','KdSosialController@simpankdsosial');
Route::post('kdsosialtrigger','KdSosialController@ajax');

Route::get('kompentensi/aspekpengetahuan','AspekPengetahuanController@dataaspekpengetahuan');
Route::post('kompentensi/aspekpengetahuan/simpan','AspekPengetahuanController@simpanaspekpengetahuan');
Route::post('kompentensi/aspekpengetahuan/upload','AspekPengetahuanController@upload');

Route::get('kompentensi/aspekketerampilan','AspekKeterampilanController@dataaspekketerampilann');
Route::post('kompentensi/aspekketerampilan/simpan','AspekKeterampilanController@simpanaspekketerampilan');
Route::post('kompentensi/aspekketerampilan/upload','AspekKeterampilanController@upload');

Route::get('kompentensi/aspeksikap/spiritual','AspekSikapSpiritualController@dataaspeksikapspiritual');
Route::post('kompentensi/aspeksikap/spiritual/simpan','AspekSikapSpiritualController@simpanaspeksikapspiritual');
Route::post('kompentensi/aspeksikap/spiritual/upload','AspekSikapSpiritualController@upload');

Route::get('kompentensi/aspeksikap/sosial','AspekSikapSosialController@dataaspeksikapsosial');
Route::post('kompentensi/aspeksikap/sosial/simpan','AspekSikapSosialController@simpanaspeksikapsosial');
Route::post('kompentensi/aspeksikap/sosial/upload','AspekSikapSosialController@upload');

Route::get('manajemenguru/guru/datamengajar','DataMengajarController@datamengajarguru');
Route::post('/manajemenguru/guru/datamengajar/prosestambahdatamengajar','DataMengajarController@inputdatamengajarguru');
Route::get('manajemenguru/guru/datamengajar/edit/{id}','DataMengajarController@editguru');
Route::post('manajemenguru/guru/datamengajar/proseseditdatamengajar','DataMengajarController@editeksekutorguru');

Route::get('manajemenguru/guru/datamengajarkelas','DataMengajarKelasController@datamengajarkelasguru');
Route::post('manajemenguru/guru/datamengajarkelas/prosestambahdatamengajarkelas','DataMengajarKelasController@inputdatamengajarkelasguru');
Route::get('manajemenguru/guru/datamengajarkelas/edit/{id}','DataMengajarKelasController@editdatamengajarkelasguru');
Route::post('manajemenguru/guru/datamengajarkelas/proseseditdatamengajarkelas','DataMengajarKelasController@editeksekutorguru');

Route::post('wali/manajemensiswa/datasiswa/import','SiswaController@imporsiswa');
/*===================================================================================================*/

/*====================================THIS IS WALI KELAS SECTION=====================================*/
Route::get('identitas/daftarhadir&eksul','TidakHadirController@show');
Route::post('identitas/daftarhadir&eksul/simpan','TidakHadirController@simpan');

Route::get('identitas/cekdeskripsisikap','CekDeskripsiSikapController@show');
Route::post('identitas/cekdeskripsisikap/simpan','CekDeskripsiSikapController@simpan');

Route::get('hasil/cetakleger','CetakLegerController@show');
Route::post('hasil/cetakleger/cetak','CetakLegerController@cetak');
Route::get('hasil/cetakleger/show/{id}','CetakLegerController@showreport');

Route::get('hasil/cetakraportuts','CetakRaportUTSController@show');
Route::get('hasil/cetakraportuts/show/{mode}/{id}','CetakRaportUTSController@cetak');
Route::post('cetakraportutsajax','CetakRaportUTSController@ajax');

Route::get('hasil/cetakraportuas','CetakReportUasController@show');
Route::get('hasil/cetakraportuas/cetak/{id}','CetakReportUasController@cetak');
Route::get('hasil/cetakraportuas/analisis','AnalisisKenaikanController@analisis');
Route::get('hasil/cetakraportuas/hasilanalisis','AnalisisKenaikanController@show');
Route::post('cetakraportuasajax','CetakReportUasController@ajax');

Route::get('wali/manajemensiswa','SiswaController@datasiswawali');
Route::post('wali/manajemensiswa/bulk/hapus','SiswaController@hapusbulk');
Route::post('wali/manajemensiswa/bulk/findclass','SiswaController@findclass');
Route::post('wali/manajemensiswa/bulk/migrateupclass','SiswaController@naikkelas');
Route::post('wali/manajemensiswa/bulk/resetmigrateupclass','SiswaController@resetnaikkelas');
Route::post('wali/manajemensiswa/datasiswa/prosestambahsiswa','SiswaController@inputsiswa');
Route::post('wali/manajemensiswa/waitingconfirmation','SiswaController@daftarsiswa');
Route::post('wali/manajemensiswa/cancelconfirmation','SiswaController@cancelconfirmation');
Route::post('clean','SiswaController@clean');
Route::post('wali/manajemensiswa/okconfirmation','SiswaController@okconfirmation');
Route::get('wali/manajemensiswa/datasiswa/edit/{id}','SiswaController@editwali');
Route::post('wali/manajemensiswa/datasiswa/proseseditsiswa','SiswaController@editeksekutorwali');

Route::get('layout/tidakhadir','TidakHadirController@unduhLayout');
Route::post('identitas/daftarhadir&eksul/import','TidakHadirController@uploadExcel');
/*===================================================================================================*/

Route::post('buat','trycontroller@make');
Route::get('laporan/show/{id}','trycontroller@show');
Route::get('muncul',function(){

	return view('laporan');

});

/*KARYAWAN SECTION*/
/*TU*/
Route::get('dokumentasileger','DokumentasiLegerController@dokumentasileger');
Route::get('dokumentasisiswa','DokumentasiDataSiswaController@dokumentasisiswa');
Route::post('carikelas','DokumentasiLegerController@searching');
Route::post('dokumentasileger/preview','DokumentasiLegerController@show');
/*TU*/

/*BK*/
//==============================================SPIRITUAL=================================================
Route::get('kompentensi/spiritual','AspekSikapSpiritualControllerBk@dataaspeksikapspiritual');
Route::post('kompentensi/spiritual/simpan','AspekSikapSpiritualControllerBk@simpanaspeksikapspiritual');
Route::post('kompentensi/aspeksikap/spiritual/uploadbk','AspekSikapSpiritualControllerBk@upload');
//==============================================SPIRITUAL=================================================

//==============================================SOSIAL=================================================
Route::get('kompentensi/sosial','AspekSikapSosialControllerBk@dataaspeksikapsosial');
Route::post('kompentensi/sosial/simpan','AspekSikapSosialControllerBk@simpanaspeksikapsosial');
Route::post('kompentensi/aspeksikap/sosial/uploadbk','AspekSikapSosialControllerBk@upload');
//==============================================SOSIAL=================================================
/*----------------------------*/

/*SISWA SECTION*/
Route::get('nilai/pengetahuan','SiswaLoginController@nilai');
Route::post('nilai/pengetahuan/view','SiswaLoginController@nilaipreview');

Route::get('nilai/keterampilan','SiswaLoginController@nilai');
Route::post('nilai/keterampilan/view','SiswaLoginController@nilaipreview');

Route::get('nilai/spiritual','SiswaLoginController@nilai');
Route::post('nilai/spiritual/view','SiswaLoginController@nilaipreview');

Route::get('nilai/sosial','SiswaLoginController@nilai');
Route::post('nilai/sosial/view','SiswaLoginController@nilaipreview');
/*----------------------------*/


Route::post('jajal','trycontroller@mean');
Route::get('gen','trycontroller@gen');

Route::get('max','trycontroller@geng');

Route::post('kirim', function(Illuminate\Http\Request $request){
	Mail::to($request->input('email'))->send(new \App\Mail\SiswaKonfirmasi($request->input('isi')));

	return redirect()->back();

});

Route::get('resetpassword','ResetPasswordController@show');
Route::post('reset','ResetPasswordController@reset');
Route::get('resetpassword/{id}','ResetPasswordController@penetration');
Route::post('resetpassword/createnew','ResetPasswordController@eksekusi');

Route::get('siswadaftar','SiswaDaftarController@show');
Route::post('recognizing','SiswaDaftarController@recognizing');
Route::get('siswadaftar/{id}','SiswaDaftarController@register');
Route::post('siswadaftar/createnew','SiswaDaftarController@create');





Route::get('jajals',function(){
$pdf = new LynX39\LaraPdfMerger\PdfManage;
$pdf->addPDF('1.pdf', 'all');
$pdf->addPDF('2.pdf', 'all');
$iwaw = storage_path('5000.pdf');
$pdf->merge('file', $iwaw, 'L');


 $singket = Excel::selectSheets('PENGETAHUAN','Identitas Sis')->load('mom.xlsm')->get();


		

		foreach ($singket as $key) {
			foreach ($key as $man) {
				echo $man->nis." ";
			}
		}
	 	



});


Route::get('ex',function(){

Excel::filter('chunk')->selectSheets('Identitas KD','Sikap Spiritual','Identitas Sis')->load('mom.xlsm')->chunk(250 , function($reader) {

		$toggle = 0;
		$toggle2 = 0;
	 	foreach ($reader as $key) {
	 		foreach ($key as $man) {
	 			if ($man->kd1 != "") {
	 				if ($man->kd1 == "stop") {
	 					$toggle = 1;
	 				}
	 				if ($toggle == 0){
	 					$toggle2++;
	 					if ($toggle2 > 4) {
	 						$id_siswa = DB::table('datasiswa')->select('id')->where('nis','=',$man->nis)->first();
	 						echo " ".$man->nis." ".$man->kd1." ".$man->kd2." - ".$man->kd;
	 					}
	 					
	 				}

	 				
	 			}
	 			
	 		}
	 	}
});


});

Route::get('men',function(){
	Excel::filter('chunk')->selectSheets('Identitas KD','Sikap Spiritual','Identitas Sis')->load('mom.xlsm')->chunk(250 , function($reader) {

        $toggle = 0;
        $nomor = 0;
        $nomortoggle = 0;

 

        foreach ($reader as $key) {
            foreach ($key as $man) {
                if ($man->mm == "DESKRIPSI SINGKAT KOMPETENSI DASAR") {
                    $toggle++;
                }

                if ($toggle == 3 ) {
                    if ($man->mm != "DESKRIPSI SINGKAT KOMPETENSI DASAR" && $man->mm != "") {
                        $nomortoggle++;
                        if ($nomortoggle<11) {  
                            $nomor++; 
                            $charkd = "KD ".$nomor;
                            echo $man->mm." ".$charkd;
                        }
                    }
                }
            }
        }
        

        
});
});

Route::get('nyobo','AnalisisKenaikanController@mama');

Route::get('ohman',function(){

 $nilai = DB::table('nilai')->join('datasiswa', function($join) {
            $join->on('nilai.id_siswa','=','datasiswa.id')->where('nilai.id_kelas','=',session()->get('kelas'))->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'));
            })->join('kelompokpelajaran', function($join2) {
            $join2->on('nilai.id_pelajaran','=','kelompokpelajaran.id_pelajaran')->where('kelompokpelajaran.jurusan','=',session()->get('jurusankelas'))->where('kelompokpelajaran.jenjang','=',session()->get('golongankelas'));
            })->select('datasiswa.nis','nilai.kd_aspek','nilai.nilai','nilai.id_siswa')->orderBy('datasiswa.nis','asc')->orderBy('kelompokpelajaran.kelompok','asc')->orderBy('nilai.id_pelajaran','asc')->get();

foreach ($nilai as $key) {
	echo " ".$key->kd_aspek." ";
}
});










Route::get('relasi-5', function() {

		# Temukan hobi Mandi Hujan
		$mandi_hujan = App\GuruWali::get();

		# Tampilkan semua mahasiswa yang punya hobi mandi hujan
		foreach ($mandi_hujan as $temp)
			foreach ($temp->matapelajarans as $key) {
				echo '<li> Nama Pelajaran : ' . $key->namapelajaran . 'namaguru = '.$temp->namaguru .' <strong>' . $key->id . '</strong></li>';
			}
			

	});

Route::get('test/mantapjiwa',function() {
	return view('08_two_sheets');
});

Route::get('super', function() {
	return view('test');
});
