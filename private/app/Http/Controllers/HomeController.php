<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;
use Auth;
use Input;
use App\GuruWali;
use Redirect;
use Crypt;

class HomeController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return 
     */
    public function index(Request $request)
    {
        $semestertahun = DB::table('pengaturan')->select('semester','tahunajaran','analisis','jumlah','formatKKM')->first();
        $request->session()->set('semester',$semestertahun->semester);
        $request->session()->set('tahunajaran',$semestertahun->tahunajaran);
        
        if (Auth::user()->hak_akses=="1") {
            $totalpelajaran = DB::table('datapelajaran')->where('namapelajaran','<>','-')->count();
            $daftarkelas = DB::table('datakelas')->select('id_guru','namakelas','id')->get();
            $daftarguru = DB::table('dataguru')->select('id','namaguru')->get();
            $totalguru = DB::table('dataguru')->count();
            $totalsiswa = DB::table('datasiswa')->count();
            $totalkelas = DB::table('datakelas')->count();

            $tahunTerakhir = date('Y') - 3;
            $loop = -1;
            $dataTahun[0] = "Tidak Tersedia :-(";
            for ($i=2017; $i <= $tahunTerakhir ; $i++) { 
                $loop++;
                $dataTahun[$loop] = $i;
            }
    
            $daftarPelajaran = DB::table('kelompokpelajaran')->join('datapelajaran',function($join){
                $join->on('kelompokpelajaran.id_pelajaran','=','datapelajaran.id')->where('datapelajaran.id','!=',34);
            })->orderBy('kelompokpelajaran.jurusan','asc')->orderBy('kelompokpelajaran.jenjang','asc')->orderBy('kelompokpelajaran.kelompok','asc')->orderBy('kelompokpelajaran.id_pelajaran','asc')->get();

            $transferNilai = DB::table('nilai')->join('dataguru', function($join){
                $join->on('nilai.id_guru','=','dataguru.id')->where('nilai.tahunajaran','=',session()->get('tahunajaran'));
            })->select('dataguru.namaguru','nilai.id_guru')->distinct()->get();

            $daftarpelajaran = DB::table('datapelajaran')->select('id','namapelajaran')->where('id','<>',34)->get();

            $request->session()->set('transferNilai', $transferNilai);
            $request->session()->set('daftarpelajaran',$daftarpelajaran);
            $request->session()->set('analisis',$semestertahun->analisis);
            $request->session()->set('formatKKM',$semestertahun->formatKKM);
            $request->session()->set('max',$semestertahun->jumlah);
            $request->session()->set('daftarkelas',$daftarkelas);
            $request->session()->set('daftarguru',$daftarguru);
            $request->session()->set('dataTahun',$dataTahun);
            $request->session()->set('daftarPelajaran',$daftarPelajaran);

            return View::make('dashboard')->with('pelajaran',$totalpelajaran)->with('guru',$totalguru)->with('siswa',$totalsiswa)->with('kelas',$totalkelas);
           
        } elseif(Auth::user()->hak_akses=="2" or Auth::user()->hak_akses=="3"){
            $pilihPelajaran = DB::table('datapelajaran')->join('datamengajar', function($join){
                $join->on('datapelajaran.id','datamengajar.id_pelajaran')->where('datamengajar.id_guru','=',Auth()->user()->id_guru);
            })->select('datapelajaran.id','datapelajaran.namapelajaran')->get();

            $pilihKelas = DB::table('datakelas')->join('datamengajarkelas', function($join){
                $join->on('datamengajarkelas.id_kelas','=','datakelas.id')->where('datamengajarkelas.id_guru','=',Auth()->user()->id_guru);
            })->select('datakelas.id','datakelas.namakelas')->get();

            $request->session()->set('pilihKelas',$pilihKelas);
            $request->session()->set('pilihPelajaran',$pilihPelajaran);

            $value = DB::table('dataguru')->select('foto')->where('id','=',Auth::user()->id_guru)->first();      
                $request->session()->set('photo',$value->foto);
            if(session()->has('toggle')){
                $s=-1;
                $totalcounter=0;
                $counter = DB::table('datamengajarkelas')->select('id_kelas')->where('id_guru','=',Auth::user()->id_guru)->get();
                foreach ($counter as $key) {
                    $s++;
                    $countergrab[] = DB::table('datasiswa')->where('id_kelas','=',$key->id_kelas)->count();
                    $totalcounter=$totalcounter+$countergrab[$s];
                }      
                $totalpelajaran = DB::table('datamengajar')->where('id_guru','=',Auth::user()->id_guru)->count();
                $totalguru = DB::table('dataguru')->count();
                $totalkelas = DB::table('datamengajarkelas')->where('id_guru','=',Auth::user()->id_guru)->count();
                          
                return View::make('formguru/dashboard')->with('pelajaran',$totalpelajaran)->with('guru',$totalguru)->with('siswa',$totalcounter)->with('kelas',$totalkelas);  

            } elseif(session()->has('togglewali')){
                

                $statusmigrasi = DB::table('migrasi')->where('kelaslama','=',session()->get('kelas'))->count();
                if ($statusmigrasi == 0) {
                    session()->set('statusmigrasi','Tidak ada');
                }else{
                    $statusmigrasi2 = DB::table('migrasi')->select('status')->where('kelaslama','=',session()->get('kelas'))->first();
                    session()->set('statusmigrasi',$statusmigrasi2->status);
                    if ($statusmigrasi2->status == "Sukses" or $statusmigrasi2->status == "Ditolak") {
                        DB::table('migrasi')->where('kelaslama','=',session()->get('kelas'))->delete();
                    }
                    
                }

                $migrasikonfirmasi = DB::table('migrasi')->join('datakelas', function($join){
                    $join->on('migrasi.kelaslama','=','datakelas.id')->where('migrasi.kelasbaru','=',session()->get('kelas'))->where('migrasi.status','=','Pending');
                })->join('dataguru',function($join2){
                    $join2->on('datakelas.id_guru','=','dataguru.id');
                })->select('migrasi.kelaslama','datakelas.namakelas','dataguru.namaguru')->groupBy('migrasi.kelaslama')->get();

                $no = 0;
                foreach ($migrasikonfirmasi as $key => $value) {
                    $no++;
                }
                session()->set('daftarmigrasikonfirmasi',$migrasikonfirmasi);
                session()->set('migrasikonfirmasi',$no);
           

                return View::make('formwali/dashboard');

            } elseif(session()->has('toggle') == false or session()->has('togglewali') == false){
                return View::make('welcome');
            }      
         
         }elseif (Auth::user()->hak_akses == 4) {
            $dataFoto = DB::table('datakaryawan')->select('foto')->where('id','=',Auth::user()->id_karyawan)->first();
            session()->set('photo',$dataFoto->foto);
             return View::make('formkaryawan/dashboard');
         }elseif(Auth::user()->hak_akses == 5){

            if (!session()->has('namasiswa') and !session()->has('namakelas') and !session()->has('namamadrasah')) {
                $datasiswa = DB::table('datasiswa')->join('datakelas', function($join){
                $join->on('datasiswa.id_kelas','=','datakelas.id')->where('datasiswa.id','=',Auth::user()->id_siswa);
                })->select('datasiswa.namasiswa','datakelas.namakelas','datasiswa.id','datasiswa.id_kelas','datakelas.golongankelas','datakelas.jurusankelas','datasiswa.foto')->first();
                
                $madrasah = DB::table('datamadrasah')->select('namamadrasah')->first();

                $pengaturan = DB::table('pengaturan')->select('semester','tahunajaran')->first();

                $request->session()->set('photo',$datasiswa->foto);
                $request->session()->set('golongankelas',$datasiswa->golongankelas);
                $request->session()->set('jurusankelas',$datasiswa->jurusankelas);
                $request->session()->set('semester',$pengaturan->semester);
                $request->session()->set('tahunajaran',$pengaturan->tahunajaran);

                $daftarpelajaran = DB::table('kelompokpelajaran')->join('datapelajaran', function($join2){
                    $join2->on('kelompokpelajaran.id_pelajaran','=','datapelajaran.id')->where('kelompokpelajaran.jenjang','=',session()->get('golongankelas'))->where('kelompokpelajaran.jurusan','=',session()->get('jurusankelas'))->where('kelompokpelajaran.kelompok','<>',5);
                })->select('datapelajaran.namapelajaran','kelompokpelajaran.id_pelajaran')->get();

                $request->session()->set('daftarpelajaran',$daftarpelajaran);
                $request->session()->set('namasiswa',$datasiswa->namasiswa);
                $request->session()->set('namakelas',$datasiswa->namakelas);
                $request->session()->set('id_kelas',$datasiswa->id_kelas);
                $request->session()->set('namamadrasah',$madrasah->namamadrasah);
            }
            return View::make('formsiswa/dashboard');

         }elseif (Auth::user()->hak_akses == 6) {
             if (!session()->has('toggleBK')) {
                $kelasBk = DB::table('datakelasbk')->join('datakelas', function($join){
                    $join->on('datakelasbk.id_kelas','=','datakelas.id')->where('datakelasbk.id_karyawan','=',Auth::user()->id_karyawan);
                })->select('datakelas.namakelas','datakelas.id')->get();

                session()->set('kelasBk',$kelasBk);

                 return View::make('welcome');
             }else{
                return View::make('formkaryawanbk/dashboard');
             }
         }
           
        } 
        
    public function homelander(Request $request){
        $charkelas = DB::table('datakelas')->select('namakelas','jurusankelas','golongankelas')->where('id','=',Input::get('pilihkelas'))->first();
        $charpelajaran = DB::table('datapelajaran')->select('namapelajaran')->where('id','=',Input::get('pilihpelajaran'))->first();


        $request->session()->set('id_guru',Auth::user()->id_guru);
        $request->session()->set('toggle','yes');
        $request->session()->set('kelas',Input::get('pilihkelas'));
        $request->session()->set('pelajaran',Input::get('pilihpelajaran'));
        $request->session()->set('charkelas',$charkelas->namakelas);
        $request->session()->set('charpelajaran',$charpelajaran->namapelajaran);
        $request->session()->set('golongankelas',$charkelas->golongankelas);
        $request->session()->set('jurusankelas',$charkelas->jurusankelas);

        if (!Input::get('urlnow')) {
            return Redirect::to('home');
        }else{
            return Redirect::to(Input::get('urlnow'));
        }
    }

    public function homelanderwali(Request $request){
        $walikelas = GuruWali::where('id','=',Auth::user()->id_guru)->first();
        $totalsiswa = DB::table('datasiswa')->select('id')->where('id_kelas','=',$walikelas->kelaswali->id)->count();
        $request->session()->set('togglewali','yes'); 
        $request->session()->set('charkelas',$walikelas->kelaswali->namakelas);
        $request->session()->set('golongankelas',$walikelas->kelaswali->golongankelas);
        $request->session()->set('jurusankelas',$walikelas->kelaswali->jurusankelas);
        $request->session()->set('kelas',$walikelas->kelaswali->id);
        $request->session()->set('totalsiswa',$totalsiswa);
        $request->session()->forget('toggle');
        $request->session()->forget('pelajaran');
        $request->session()->forget('charpelajaran');
        return Redirect::to('home');
    }
//====================================================FUNCTION UNTUK ADMIN MASUK WALI KELAS==================================================
    public function homelander_AdminAsWali(Request $request, $id){
        $semestertahun = DB::table('pengaturan')->select('semester','tahunajaran','analisis','jumlah')->first();
        $request->session()->set('semester',$semestertahun->semester);
        $request->session()->set('tahunajaran',$semestertahun->tahunajaran);

        $id = Crypt::decrypt($id);

        //GRAB FOTO USER
        $value = DB::table('dataguru')->select('foto')->where('id','=',$id)->first();      
        $request->session()->set('photo',$value->foto);
        //GRAB FOTO USER

        $walikelas = GuruWali::where('id','=',$id)->first();
        $totalsiswa = DB::table('datasiswa')->select('id')->where('id_kelas','=',$walikelas->kelaswali->id)->count();
        $request->session()->set('togglewali','yes'); 
        $request->session()->set('charkelas',$walikelas->kelaswali->namakelas);
        $request->session()->set('golongankelas',$walikelas->kelaswali->golongankelas);
        $request->session()->set('jurusankelas',$walikelas->kelaswali->jurusankelas);
        $request->session()->set('kelas',$walikelas->kelaswali->id);
        $request->session()->set('totalsiswa',$totalsiswa);
        $request->session()->forget('toggle');
        $request->session()->forget('pelajaran');
        $request->session()->forget('charpelajaran');

        $statusmigrasi = DB::table('migrasi')->where('kelaslama','=',session()->get('kelas'))->count();
                if ($statusmigrasi == 0) {
                    session()->set('statusmigrasi','Tidak ada');
                }else{
                    $statusmigrasi2 = DB::table('migrasi')->select('status')->where('kelaslama','=',session()->get('kelas'))->first();
                    session()->set('statusmigrasi',$statusmigrasi2->status);
                    if ($statusmigrasi2->status == "Sukses" or $statusmigrasi2->status == "Ditolak") {
                        DB::table('migrasi')->where('kelaslama','=',session()->get('kelas'))->delete();
                    }
                    
                }

                $migrasikonfirmasi = DB::table('migrasi')->join('datakelas', function($join){
                    $join->on('migrasi.kelaslama','=','datakelas.id')->where('migrasi.kelasbaru','=',session()->get('kelas'))->where('migrasi.status','=','Pending');
                })->join('dataguru',function($join2){
                    $join2->on('datakelas.id_guru','=','dataguru.id');
                })->select('migrasi.kelaslama','datakelas.namakelas','dataguru.namaguru')->groupBy('migrasi.kelaslama')->get();

                $no = 0;
                foreach ($migrasikonfirmasi as $key => $value) {
                    $no++;
                }
                session()->set('daftarmigrasikonfirmasi',$migrasikonfirmasi);
                session()->set('migrasikonfirmasi',$no);

        return Redirect::to('admin/home');
    }

    public function dashboard(){
        return View::make('formwali/dashboard');
    }

//====================================================FUNCTION UNTUK ADMIN MASUK WALI KELAS==================================================

//====================================================FUNCTION UNTUK ADMIN MASUK GURU==================================================

    public function checkguru(Request $request){
        $setting = DB::table('pengaturan')->select('semester','tahunajaran','analisis','jumlah')->first();
        $request->session()->set('semester',$setting->semester);
        $request->session()->set('tahunajaran',$setting->tahunajaran);

        $check = DB::table('nilai')->whereNotNull('id_guru')->where('id_pelajaran','=',$request->daftarpelajaran)->where('id_kelas','=',$request->daftarkelas)->where('tahunajaran','=',$setting->tahunajaran)->count();

        if ($check != 0) {
            $dataguru = DB::table('nilai')->select('id_guru')->whereNotNull('id_guru')->where('id_pelajaran','=',$request->daftarpelajaran)->where('id_kelas','=',$request->daftarkelas)->where('tahunajaran','=',$setting->tahunajaran)->first();

            session()->set('id_guru',$dataguru->id_guru);
            session()->set('kelas',$request->daftarkelas);
            session()->set('pelajaran',$request->daftarpelajaran);

        }

        return Response()->json(array('results'=>$check,'namapelajaran'=>$request->pelajaranchar,'namakelas'=>$request->kelaschar));

    }

    public function homelander_AdminAsGuru(Request $request){

        $value = DB::table('dataguru')->select('foto')->where('id','=',session()->get('id_guru'))->first();      
        $request->session()->set('photo',$value->foto);

        $charkelas = DB::table('datakelas')->select('namakelas','jurusankelas','golongankelas')->where('id','=',session()->get('kelas'))->first();
        $charpelajaran = DB::table('datapelajaran')->select('namapelajaran')->where('id','=',session()->get('pelajaran'))->first();

        $request->session()->set('toggle','yes');

        $request->session()->set('charkelas',$charkelas->namakelas);
        $request->session()->set('charpelajaran',$charpelajaran->namapelajaran);
        $request->session()->set('golongankelas',$charkelas->golongankelas);
        $request->session()->set('jurusankelas',$charkelas->jurusankelas);

         $s=-1;
                $totalcounter=0;
                $counter = DB::table('datamengajarkelas')->select('id_kelas')->where('id_guru','=',session()->get('id_guru'))->get();
                foreach ($counter as $key) {
                    $s++;
                    $countergrab[] = DB::table('datasiswa')->where('id_kelas','=',$key->id_kelas)->count();
                    $totalcounter=$totalcounter+$countergrab[$s];
                }      
                $totalpelajaran = DB::table('datamengajar')->where('id_guru','=',session()->get('id_guru'))->count();
                $totalguru = DB::table('dataguru')->count();
                $totalkelas = DB::table('datamengajarkelas')->where('id_guru','=',session()->get('id_guru'))->count();
                          
                return View::make('formguru/dashboard')->with('pelajaran',$totalpelajaran)->with('guru',$totalguru)->with('siswa',$totalcounter)->with('kelas',$totalkelas);  


    }

    public function setguru(){
        session()->set('id_guru',Input::get('daftarguru'));
        session()->set('kelas',Input::get('pilihkelas'));
        session()->set('pelajaran',Input::get('pilihpelajaran'));
        return Redirect::to('admin/guru/home');
    }

    public function findproperguru(Request $request){
        session()->flash('id_pelajaran',$request->daftarpelajaran);
        session()->flash('id_kelas',$request->daftarkelas);

        $data = DB::table('dataguru')->join('datamengajar', function($join){
            $join->on('dataguru.id','=','datamengajar.id_guru')->where('datamengajar.id_pelajaran','=',session()->get('id_pelajaran'));
        })->join('datamengajarkelas', function($join2){
            $join2->on('dataguru.id','=','datamengajarkelas.id_guru')->where('datamengajarkelas.id_kelas','=',session()->get('id_kelas'));
        })->select('dataguru.id','dataguru.namaguru')->get();

        foreach ($data as $key) {
            $value[] = array("value"=>$key->id, "text"=>$key->namaguru);
        }

        return Response()->json(array("options"=>$value));
    }

//====================================================FUNCTION UNTUK CARI KELAS BK==================================================

    public function cariPelajaranBk(Request $request){
        $info = DB::table('datakelas')->select('golongankelas','jurusankelas')->where('id','=',$request->kelasTerpilih)->first();
        $daftarPelajaran = DB::table('kelompokpelajaran')->join('datapelajaran', function($join) use($info){
            $join->on('kelompokpelajaran.id_pelajaran','=','datapelajaran.id')->where('kelompokpelajaran.jenjang','=',$info->golongankelas)->where('kelompokpelajaran.jurusan','=',$info->jurusankelas)->where('kelompokpelajaran.id_pelajaran','<>',34);
        })->select('datapelajaran.namapelajaran','datapelajaran.id')->get();

         foreach ($daftarPelajaran as $key) {
            $value[] = array("value"=>$key->id, "text"=>$key->namapelajaran);
        }

        return Response()->json(array("options"=>$value));
    }

    public function homelanderbk(){
        $dataKelas = DB::table('datakelas')->select('namakelas','jurusankelas','golongankelas')->where('id','=',Input::get('pilihKelas'))->first();

        $dataPelajaran = DB::table('datapelajaran')->join('datadasarnilai', function($join) use($dataKelas){
            $join->on('datapelajaran.id','=','datadasarnilai.id_pelajaran')->where('datapelajaran.id','=',Input::get('pilihPelajaran'))->where('datadasarnilai.jurusan','=',$dataKelas->jurusankelas)->where('datadasarnilai.gol_kelas','=',$dataKelas->golongankelas);
        })->select('datapelajaran.namapelajaran','datadasarnilai.ckmsikap')->first();

        $setting = DB::table('pengaturan')->select('semester','tahunajaran','analisis','jumlah')->first();

        $dataFoto = DB::table('datakaryawan')->select('foto')->where('id','=',Auth::user()->id_karyawan)->first();
       

        //INSERTING DATA TO SESSION
        session()->set('semester',$setting->semester);
        session()->set('tahunajaran',$setting->tahunajaran);

        session()->set('kelas', Input::get('pilihKelas'));
        session()->set('pelajaran', Input::get('pilihPelajaran'));
        session()->set('charkelas', $dataKelas->namakelas);
        session()->set('charpelajaran', $dataPelajaran->namapelajaran);
        session()->set('ckmsikap',$dataPelajaran->ckmsikap);
        session()->set('id_karyawan',Auth::user()->id_karyawan);
        session()->set('photo',$dataFoto->foto);

        session()->set('toggleBK', 'true');

        if (!Input::get('urlnow')) {
            return Redirect::to('home');
        }else{
            return Redirect::to(Input::get('urlnow'));
        }
    }

    public function adminAsBk(){
        $id_karyawan = DB::table('datakelasbk')->join('datakaryawan', function($join){
            $join->on('datakelasbk.id_karyawan','=','datakaryawan.id')->where('datakelasbk.id_kelas','=',Input::get('pilihKelas'));
        })->select('datakelasbk.id_karyawan','datakaryawan.foto')->first();

        $dataKelas = DB::table('datakelas')->select('namakelas','jurusankelas','golongankelas')->where('id','=',Input::get('pilihKelas'))->first();

        $dataPelajaran = DB::table('datapelajaran')->join('datadasarnilai', function($join) use($dataKelas){
            $join->on('datapelajaran.id','=','datadasarnilai.id_pelajaran')->where('datapelajaran.id','=',Input::get('pilihPelajaran'))->where('datadasarnilai.jurusan','=',$dataKelas->jurusankelas)->where('datadasarnilai.gol_kelas','=',$dataKelas->golongankelas);
        })->select('datapelajaran.namapelajaran','datadasarnilai.ckmsikap')->first();

        session()->set('kelas', Input::get('pilihKelas'));
        session()->set('pelajaran', Input::get('pilihPelajaran'));
        session()->set('charkelas', $dataKelas->namakelas);
        session()->set('charpelajaran', $dataPelajaran->namapelajaran);
        session()->set('ckmsikap',$dataPelajaran->ckmsikap);
        session()->set('id_karyawan',$id_karyawan->id_karyawan);
        session()->set('photo',$id_karyawan->foto);

        return Redirect::to('admin/bk/home');

    }

    public function dashboardBk(){
        return View::make('formkaryawanbk/dashboard');
    }

}



