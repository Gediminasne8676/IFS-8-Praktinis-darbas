$(".checkbox").change(function(){

  if ($('.checkbox:checked').length == $('.checkbox').length) {//jeigu visi checkboxai yra checked
    $('#cShowAll').prop("checked", true);//padarome jog virustinis (showall) checkboxas butu automatiskai uzchekintas
  }

  var ischecked = $(this).is(':checked');//tikrinam ar nuspaustas checkboxas yra uzcheckintas
  if(!ischecked){//jeigu yra atcheckintas
    $('#cShowAll').prop("checked", false);//reiskias kazkuris is checkboxu yra atcheckintas taip atcheckinam virsutini(showall) checkboxa
    switch($(this).attr("id")){//einam pro kiekviena checkboxa ir jeigu jis yra atspaustas , tuomet paslepiam butent ta kolona
      case "ccol_A" ://kolonos id
        toggleExactColDisplay("false",1)//funckija kuri paslepia kolona
      break;
      case "ccol_B" :
        toggleExactColDisplay("false",2)
      break;
      case "ccol_C" :
        toggleExactColDisplay("false",3)
      break;
      case "ccol_D" :
        toggleExactColDisplay("false",4)
      break;
      case "ccol_E" :
        toggleExactColDisplay("false",5)
      break;
      case "ccol_F" :
        toggleExactColDisplay("false",6)
      break;
      case "ccol_G" :
        toggleExactColDisplay("false",7)
      break;
    }
  }
  else{
    switch($(this).attr("id")){//kita jeigu checkboxas buvo nuspaustas, tuomet su funkcija showinam kolona
      case "ccol_A" :
        toggleExactColDisplay("true",1)
      break;
      case "ccol_B" :
        toggleExactColDisplay("true",2)
      break;
      case "ccol_C" :
        toggleExactColDisplay("true",3)
      break;
      case "ccol_D" :
        toggleExactColDisplay("true",4)
      break;
      case "ccol_E" :
        toggleExactColDisplay("true",5)
      break;
      case "ccol_F" :
        toggleExactColDisplay("true",6)
      break;
      case "ccol_G" :
        toggleExactColDisplay("true",7)
      break;
  }

  }

});


$("#hidebtn").click(function(){//paspaudus mygtuka select hide, togglinas divas kuriame yra checkboxai
    $('#checkboxes').fadeToggle(200);
});

$("#cShowAll").change(function() {//jei nuspaudziamas showall checkboxas, tuomet nuspaudziam kartu visus kitus checkboxus, ir atvirksciai
    var ischecked= $(this).is(':checked');//paemam ar checkboxas showall yra nuspaustas
    if(!ischecked){//jeigu nenuspaustas
        $("#ccol_A").prop("checked", false);//atspaudziam visus kitus mygtukus
        $("#ccol_B").prop("checked", false);
        $("#ccol_C").prop("checked", false);
        $("#ccol_D").prop("checked", false);
        $("#ccol_E").prop("checked", false);
        $("#ccol_F").prop("checked", false);
        $("#ccol_G").prop("checked", false);
        toggleColDisplay("false");//funckija kuri jeigu false paslepia visas kolonas
    }
    else if(ischecked){//jeigu checkboxas showall nera nuspaustas
        $("#ccol_A").prop("checked", true);//nuspaudziam visus kitus mygtukus
        $("#ccol_B").prop("checked", true);
        $("#ccol_C").prop("checked", true);
        $("#ccol_D").prop("checked", true);
        $("#ccol_E").prop("checked", true);
        $("#ccol_F").prop("checked", true);
        $("#ccol_G").prop("checked", true);
        toggleColDisplay("true");//kadangi mygtukas showall yra nuspaustas tuomet parodom visas kolonas
    }
}); 

function toggleExactColDisplay(boolean,col){//funkcija kuri paema (boolean)true arba false(parodyti ar paslepti) ir kelinta kolona yra nurodyta(col)
  var table = document.getElementById("table");//paemama lentele kaip kintamasis

  var row_lenght = table.rows.length-1;//paemama eiluciu kiekis minus vienas, kadangi headeris irgi prisiskaiciuoja kaip eilute(o jo mes nekeiciam)

  var cell_lenght = document.getElementById('table').rows[0].cells.length-3;//paemame kolonu skaiciu, atimame tris kadangi pirmos dvi kolonos bei paskutine yra ne input field'ai

  for(var i = 0; i <= row_lenght; i++){//sukam cikla pro eilutes nuo 0 iki 4 (5 eilutes) kadangi jeigu reiks paslepsim ir headeri
    for(var j = 1; j <= cell_lenght; j++){//sukam cikla pro kolonas nuo 1 iki 7, kadangi yra nuo A iki G tai 7 kolonos
      var cell = "#cell"+i+j;//paemam esancia kolonos id
        if(col == j){//tikrinam ar ji atitinka norima paslepti arba parodyti kolona
          switch(boolean){
            case "true"://jeigu norima parodyti norima kolona
              $(cell).show();
            break;
            case "false"://jeigu norime paslepti norima kolona
              $(cell).hide();
            break;
        }
      }
    }
  }
}

function toggleColDisplay(boolean){//paslepiam arba parodome visas kolonas
  var table = document.getElementById("table");//paemama lentele kaip kintamasis
    
  var row_lenght = table.rows.length-1;//paemama eiluciu kiekis minus vienas, kadangi headeris irgi prisiskaiciuoja kaip eilute(o jo mes nekeiciam)
  
  var cell_lenght = document.getElementById('table').rows[0].cells.length-3;//paemame kolonu skaiciu, atimame tris kadangi pirmos dvi kolonos bei paskutine yra ne input field'ai

  for(var i = 0; i <= row_lenght; i++){//sukam cikla pro eilutes nuo 0 iki 4 (5 eilutes) kadangi jeigu reiks paslepsim ir headeri
    for(var j = 1; j <= cell_lenght; j++){//sukam cikla pro kolonas nuo 1 iki 7, kadangi yra nuo A iki G tai 7 kolonos
      var cell = "#cell"+i+j;//paemam esancia kolonos id

      switch(boolean){
        case "true"://jeigu norima parodyti norima kolona
          $(cell).show();
        break;
        case "false"://jeigu norime paslepti norima kolona
          $(cell).hide();
        break;
      }
    }
  }
}

function toggleEditRow(row_number){//si funkcija kuomet paspaudziama mygtukas edit kazkelintoj eilutej, visa eilute leidzia readaguot bei keicia mygutko value ir spalva

    var table = document.getElementById("table");//paemama lentele kaip kintamasis
    
    var row_lenght = table.rows.length-1;//paemama eiluciu kiekis minus vienas, kadangi headeris irgi prisiskaiciuoja kaip eilute(o jo mes nekeiciam)
    console.log(row_lenght + " = row lenght");//atspausdinam i console
    
    var cell_lenght = document.getElementById('table').rows[0].cells.length-3;//paemame kolonu skaiciu, atimame tris kadangi pirmos dvi kolonos bei paskutine yra ne input field'ai
    console.log(cell_lenght+" = cell lenght");//atspausdinam i console
    
    
    function turnTableWriteable(trueOrFalse, row_number){//funkcija kuri paema true arba false(leisti readaguot lentele ar ne) ir kelinta eilute norit readaguot, leidzia jums readaguot ta eilute
        for(var i = 1; i <= cell_lenght; i++){//sukamas ciklas nuo 1(pirmos eilutes) iki kiek yra eiluciu is viso
        var cell = document.getElementById(row_number+String.fromCharCode(i+64));//paemama irasai (input id='[1A,1B,1C...2A,2B,2C...3A,3B,3C... IR T.T.]') ir pakeiciama i arba true readonly arba false readonly
        cell.readOnly = !trueOrFalse;//pakeicama input fieldo readonly true arba false
        }
    }
    
    var buttonValue = document.getElementById("editrow"+row_number).value;//paemama button reiksme (pvz Edit arba Done)
    var button = document.getElementById("editrow"+row_number);//paemamas pats mygtukas
    
      switch(buttonValue) {//imame paimto mygtuko reiksme ir tikrinam 
    
        case "Edit"://jeigu reiksme lygi Edit (reiskia zmogus nori editint ta eilute)
          for(var i = 0; i < row_lenght; i++){//nustatome visas eilutes kad butu Edit bei klase mygtuko btn-primary(melyna)
            document.getElementById("editrow"+i).value = "Edit";//pritaikome mygtukams edit
            document.getElementById("editrow"+i).classList.remove("btn-primary");//atimam jeigu turi btn-primary klase
            document.getElementById("editrow"+i).classList.remove("btn-success");//atimam jeigu turi btn-success klase
            document.getElementById("editrow"+i).classList.add("btn-primary");//pridedam btn-primary klase kad pavirstu visi mygtukai y melyna spalva
            turnTableWriteable(false, i);//visu eiluciu input field'us nustatome kad butu tik onlyread tipo
          }
    
          button.value = "Done";//tuomet ta mygtuka kuri nuspaudeme verciame jo reiksme y Done
          button.classList.remove("btn-primary");//atimame melyna spalva(klase btn-primary)
          button.classList.add("btn-success");//nustatome jog butu zalios spalvos mygutkas(klase btn-success)
          turnTableWriteable(true, row_number);//eilute kurioje yra nuspaustas mygutkas padarome input field'us readonly=false
          break;
        
        case "Done"://jeigu nuspaustas mygtukas yra  Done tuomet visi mygutkai virsta y Edit bei jokia eilute negali but editinama
          for(var i = 0; i < row_lenght; i++){
            document.getElementById("editrow"+i).value = "Edit";//pritaikome mygtukams edit
            document.getElementById("editrow"+i).classList.remove("btn-primary");//atimam jeigu turi btn-primary klase
            document.getElementById("editrow"+i).classList.remove("btn-success");//atimam jeigu turi btn-success klase
            document.getElementById("editrow"+i).classList.add("btn-primary");//pridedam btn-primary klase kad pavirstu visi mygtukai y melyna spalva
            turnTableWriteable(false, i);//visu eiluciu input field'us nustatome kad butu tik onlyread tipo
          }
          break;
    
      }
    }