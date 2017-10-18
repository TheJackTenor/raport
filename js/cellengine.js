var dataiterate, averageraw, average, averagerawfinal, dataiteratefinal, averagefinal;
var catch_kkm = "{{$infonilai->kkm}}";
var catch_ckm = "{{$infonilai->ckmpengetahuan}}";
var range_2, range_3, nilaihuruf, tortt, deskripsi, temp, temp_value_kd,max,min,pass_ckm;
var catch_kd = [], max_temp = [];
var cache = 0;

<?php foreach ($kontenkd as $datakd): ?>
    cache++;
    catch_kd[cache] = "{{$datakd -> kd}}";
<?php endforeach ?>


range_2 = (100 - parseInt(catch_kkm))/3 + parseInt(catch_kkm);
range_3 = 100 - (100 - parseInt(catch_kkm))/3;

for (var i = 1; i <= {{$a}}; i++) {
  for (var s = 1; s <= 14; s++) {
    $("#kd"+s+i).inputmask("9[99]",{autoUnmask:true}); 
  }
}

function mantap(){
  averagerawfinal = 0;
  dataiteratefinal = 0;
  max_temp[0] = 0;
  passkkm = 0;
for (var i = 1; i <= {{$a}}; i++) {
  dataiterate=0;
  averageraw=0;
  deskripsi = "";
  for (var s = 1; s <=14; s++) {           
      if (document.getElementById('kd'+s+i).value >100) {
        alert("Nilai tidak boleh melebihi dari 100 !");
        document.getElementById('kd'+s+i).value = "";
      }
      if (document.getElementById('kd'+s+i).value  != "" && document.getElementById('kd'+s+i).value  != "0") { 
          dataiterate++;
          temp_value_kd = parseFloat(document.getElementById('kd'+s+i).value);         
          averageraw = temp_value_kd + parseFloat(averageraw);


            if (temp_value_kd<catch_kkm) {
              nilaihuruf = "D";
            }
            else if (catch_kkm<=temp_value_kd && temp_value_kd<range_2) {
              nilaihuruf = "C";
            }
            else if (range_2<=temp_value_kd && temp_value_kd<range_3) {
              nilaihuruf = "B";
            }
            else if (temp_value_kd>=range_3) {
              nilaihuruf = "A";
            }


            if (s==1 || dataiterate==1 && s>1) {
              temp = nilaihuruf;
              if (nilaihuruf == "D") {
                deskripsi = "Perlu belajar lebih baik lagi untuk "+catch_kd[s];
              }
              else if(nilaihuruf == "C") {
                deskripsi = "Cukup mampu "+catch_kd[s];
              }
              else if(nilaihuruf=="B") {
                deskripsi = "Sudah mampu "+catch_kd[s];
              }
              else if(nilaihuruf=="A") {
                deskripsi = "Sangat mampu "+catch_kd[s];
              }   
            }
            else if(temp != nilaihuruf && s>1) {
              temp = nilaihuruf;
              if (nilaihuruf == "D") {
                deskripsi = deskripsi + ". Perlu belajar lebih baik lagi untuk "+catch_kd[s];
              }
              else if(nilaihuruf == "C") {
                deskripsi = deskripsi + ". Cukup mampu "+catch_kd[s];
              }
              else if(nilaihuruf=="B") {
                deskripsi = deskripsi + ". Sudah mampu "+catch_kd[s];
              }
              else if(nilaihuruf=="A") {
                deskripsi = deskripsi + ". Sangat mampu "+catch_kd[s];
              }   
            }
            else if(temp == nilaihuruf) {
              deskripsi = deskripsi + ", " + catch_kd[s];
            }
           }  
      }


      if (averageraw == 0) {
        dataiterate = 1;
      }

  average = averageraw / dataiterate;

  if (average<catch_kkm) {
    nilaihuruf = "D";
  }
  else if (catch_kkm<=average && average<range_2) {
    nilaihuruf = "C";
  }
  else if (range_2<=average && average<range_3) {
    nilaihuruf = "B";
  }
  else if (average>=range_3) {
    nilaihuruf = "A";
  }

  if (average>=catch_ckm){
    tortt = "T";
  }else{
    tortt = "TT";
  }

  if(isNaN(average) == false && average != 0){
    document.getElementById('rerata'+i).value = average;
    document.getElementById('predikat'+i).value = nilaihuruf;
    document.getElementById('tt'+i).value = tortt;
    document.getElementById('deskripsi'+i).value = deskripsi;
    
  }else if(average == 0){
    document.getElementById('rerata'+i).value = "";
    document.getElementById('predikat'+i).value = "";
    document.getElementById('tt'+i).value = "";
    document.getElementById('deskripsi'+i).value = "";
    document.getElementById('averata').value = "";
  }

if (document.getElementById('rerata'+i).value != "") {
    dataiteratefinal++;
    temp_value_kd = document.getElementById('rerata'+i).value;
    averagerawfinal = parseInt(averagerawfinal) + parseInt(temp_value_kd);
    max_temp[dataiteratefinal] = temp_value_kd;
    if (max_temp[dataiteratefinal]>max_temp[dataiteratefinal-1]) {
      max = max_temp[dataiteratefinal];
    }

    if (dataiteratefinal == 1) {
      min = max_temp[dataiteratefinal];
    }
    else if(max_temp[dataiteratefinal]<max_temp[dataiteratefinal-1]){
      min = max_temp[dataiteratefinal];
    }

    if(temp_value_kd>=catch_ckm){
      passkkm++;
    }

}

  if(i == {{$a}} && dataiteratefinal != 0){
    averagefinal = averagerawfinal / dataiteratefinal;
    document.getElementById('averata').innerHTML = averagefinal;
    document.getElementById('avemax').innerHTML = max;
    document.getElementById('avemin').innerHTML = min;
    document.getElementById('avepass').innerHTML = passkkm;
    
  }else{
    document.getElementById('averata').innerHTML = "";
    document.getElementById('avemax').innerHTML = "";
    document.getElementById('avemin').innerHTML = "";
     document.getElementById('avepass').innerHTML = "";
  }
}
/* ------------------------ UNTUK MENGHITUNG RATA-RATA KD ------------------------- */
for (var s = 1; s <= 14; s++) {
  averageraw = 0;
  dataiterate = 0;
  max_temp[0] = 0;
  pass_ckm = 0;
  for (var i = 1; i <= {{$a}}; i++) {
    if (document.getElementById('kd'+s+i).value  != "") {
      dataiterate++;
      temp_value_kd = parseFloat(document.getElementById('kd'+s+i).value);
      averageraw = temp_value_kd + parseFloat(averageraw);

      max_temp[dataiterate] = document.getElementById('kd'+s+i).value;

      if (max_temp[dataiterate]>max_temp[dataiterate-1]) {
          max = max_temp[dataiterate];
      }

      if (dataiterate == 1) {
          min = max_temp[dataiterate];
      }
      else if(max_temp[dataiterate]<max_temp[dataiterate-1]){
          min = max_temp[dataiterate];
      }

      if (temp_value_kd >= catch_ckm) {
        pass_ckm++;
      }

    }
  }
  if (averageraw == 0) {
    dataiterate = 1;
  }
  average = parseFloat(averageraw) / dataiterate;

  if (average == 0) {
    document.getElementById('kdrata'+s).innerHTML = "";
    document.getElementById('kdmax'+s).innerHTML = "";
    document.getElementById('kdmin'+s).innerHTML = "";
    document.getElementById('passkkm'+s).innerHTML = "";
  }else{
    document.getElementById('kdrata'+s).innerHTML = average;
    document.getElementById('kdmax'+s).innerHTML = max;
    document.getElementById('kdmin'+s).innerHTML = min;
    document.getElementById('passkkm'+s).innerHTML = pass_ckm;
  }  
}
}