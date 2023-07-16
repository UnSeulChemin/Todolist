

// MODE SOMBRE

const lienSombre = document.querySelector("#lien-sombre");
const theme_css = document.querySelector("#theme_css");

lienSombre.addEventListener("click", function()
{

  // FICHIER CSS CHARGER

  if (theme_css.getAttribute("href") == "css/theme/empty.css")
  {
    theme_css.href = "css/theme/sombre.css";
  }

  else
  {
    theme_css.href = "css/theme/empty.css";
  }


  // COOKIE

  document.body.classList.toggle("sombre");
  
  let theme = "";

  if (document.body.classList.contains("sombre"))
  {
    document.body.classList.remove("empty");    
    theme = "sombre";
  }

  else
  {
    document.body.classList.add("empty");    
    theme = "empty";
  }  

  document.cookie = "theme=" + theme;

});


// INSCRIPTION OEIL

y = true;

function changeY()
{
  if (y)
  {
    document.getElementById("pass_y").setAttribute("type","text");
    document.getElementById("eye_y").src="images/outils/show.png";
    y = false;
  }

  else
  {
    document.getElementById("pass_y").setAttribute("type","password");
    document.getElementById("eye_y").src="images/outils/hide.png";
    y = true;
  }

}

x = true;

function changeX()
{
  if (x)
  {
    document.getElementById("pass_x").setAttribute("type","text");
    document.getElementById("eye_x").src="images/outils/show.png";
    x = false;
  }

  else
  {
    document.getElementById("pass_x").setAttribute("type","password");
    document.getElementById("eye_x").src="images/outils/hide.png";
    x = true;
  }

}


// CONNEXION OEIL

z = true;

function changeZ()
{
  if (z)
  {
    document.getElementById("pass_z").setAttribute("type","text");
    document.getElementById("eye_z").src="images/outils/show.png";
    z = false;
  }

  else
  {
    document.getElementById("pass_z").setAttribute("type","password");
    document.getElementById("eye_z").src="images/outils/hide.png";
    z = true;
  }

}


// JQUERY

$(document).ready(function()
{

  // RADIO

  $("#radio-un, #radio-deux").css("background-color", "#ebebeb");

  $("#sexe-homme, #sexe-femme").change(function()
  {

    // RADIO HOMME

    if ($("#sexe-homme").is(":checked"))
    {
      $("#radio-un").css("background-color", "#32CD32");
    }

    else
    {
      $("#radio-un").css("background-color", "#ebebeb");
    } 


    // RADIO FEMME

    if ($("#sexe-femme").is(":checked"))
    {
      $("#radio-deux").css("background-color", "#32CD32");
    }

    else
    {
      $("#radio-deux").css("background-color", "#ebebeb");
    } 

  });

});


// POST AJAX AJOUTER POUR TODOLIST

$("#ajouter-todolist").click(function()
{
    var titre = $("#titre-ajouter-todolist").val();
    var contenu = $("#contenu-ajouter-todolist").val();
    var experience = $("#experience-ajouter-todolist").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (titre == '' || contenu == '' || experience == '')
    {
      $('.erreur').html('Veuillez remplir les champs.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (!experience.match(regex) || experience == 0)
    {
      $('.erreur').html('Veuillez entrer un chiffre entre 1 et 5.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (experience > 5)
    {
      $('.erreur').html('Veuillez entrer un chiffre entre 1 et 5.');
      $('.erreur').css('display', 'block');

      return false;
    }    

    $.ajax({
      type: "POST",
      url: "script/prendre.php?ajouter=Y&contenu=Todolist",
      data: {
          titre: titre,
          contenu: contenu,
          experience: experience
      },
      cache: false
    }).done(function()
    {
        var nouveauChemin = 'index';
        window.location.replace(nouveauChemin);
    });
});


// POST AJAX MODIFIER POUR TODOLIST

$("#modifier-todolist").click(function()
{
    var id = $("#id-modifier-todolist").val();  
    var titre = $("#titre-modifier-todolist").val();
    var contenu = $("#contenu-modifier-todolist").val();
    var experience = $("#experience-modifier-todolist").val();

    $.ajax({
      type: "POST",
      url: "script/prendre.php?modifier=Y&contenu=Todolist",
      data: {
          id: id,        
          titre: titre,
          contenu: contenu,
          experience: experience
      },
      cache: false
    }).done(function()
    {
        var newPatch = 'index';
        window.location.replace(newPatch);
    });
});


// POST AJAX AJOUTER POUR MOT FR

$("#ajouter-mot-fr").click(function()
{
    var mot = $("#mot").val();
    var definition = $("#definition").val();
    var exemple = $("#exemple").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;    

    if (mot == '' || definition == '' || exemple == '')
    {
      $('.erreur').html('Veuillez remplir les champs.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (mot.match(regex) || definition.match(regex) || exemple.match(regex))
    {
      $('.erreur').html('Veuillez ne pas écrire de chiffre.');
      $('.erreur').css('display', 'block');

      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?ajouter=Y&lang=FR",
      data: {
          mot: mot,
          definition: definition,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        var nouveauChemin = 'mot?mot=fr&p=1';
        window.location.replace(nouveauChemin);
    });
});


// POST AJAX MODIFIER POUR MOT FR

$("#modifier-mot-fr").click(function()
{
    var id = $("#id-modifier-mot-fr").val();  
    var mot = $("#mot-modifier-mot-fr").val();
    var definition = $("#definition-modifier-mot-fr").val();
    var exemple = $("#exemple-modifier-mot-fr").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || definition == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || definition.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotFR",
      data: {
          id: id,        
          mot: mot,
          definition: definition,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT FR : FAVORIS

$("#modifier-mot-fr-favoris").click(function()
{
    var id = $("#id-modifier-mot-fr").val();  
    var mot = $("#mot-modifier-mot-fr").val();
    var definition = $("#definition-modifier-mot-fr").val();
    var exemple = $("#exemple-modifier-mot-fr").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || definition == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || definition.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotFR",
      data: {
          id: id,        
          mot: mot,
          definition: definition,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX AJOUTER POUR MOT EN

$("#ajouter-mot-en").click(function()
{
    var mot = $("#mot").val();
    var traduction = $("#traduction").val();
    var exemple = $("#exemple").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traduction == '' || exemple == '')
    {
      $('.erreur').html('Veuillez remplir les champs.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (mot.match(regex) || traduction.match(regex) || exemple.match(regex))
    {
      $('.erreur').html('Veuillez ne pas écrire de chiffre.');
      $('.erreur').css('display', 'block');

      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?ajouter=Y&lang=EN",
      data: {
          mot: mot,
          traduction: traduction,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        var nouveauChemin = 'mot?mot=en&p=1';
        window.location.replace(nouveauChemin);
    });
});


// POST AJAX MODIFIER POUR MOT EN

$("#modifier-mot-en").click(function()
{
    var id = $("#id-modifier-mot-en").val();  
    var mot = $("#mot-modifier-mot-en").val();
    var traduction = $("#traduction-modifier-mot-en").val();
    var exemple = $("#exemple-modifier-mot-en").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traduction == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traduction.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotEN",
      data: {
          id: id,        
          mot: mot,
          traduction: traduction,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT EN : FAVORIS

$("#modifier-mot-en-favoris").click(function()
{
    var id = $("#id-modifier-mot-en").val();  
    var mot = $("#mot-modifier-mot-en").val();
    var traduction = $("#traduction-modifier-mot-en").val();
    var exemple = $("#exemple-modifier-mot-en").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traduction == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traduction.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotEN",
      data: {
          id: id,        
          mot: mot,
          traduction: traduction,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX AJOUTER POUR MOT CH

$("#ajouter-mot-ch").click(function()
{
    var mot = $("#mot").val();
    var traductionFR = $("#traduction-fr").val();
    var traductionEN = $("#traduction-en").val();
    var exemple = $("#exemple").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traductionFR == '' || traductionEN == '' || exemple == '')
    {
      $('.erreur').html('Veuillez remplir les champs.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (mot.match(regex) || traductionFR.match(regex) || traductionEN.match(regex) ||  exemple.match(regex))
    {
      $('.erreur').html('Veuillez ne pas écrire de chiffre.');
      $('.erreur').css('display', 'block');

      return false;
    }    

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?ajouter=Y&lang=CH",
      data: {
          mot: mot,
          traductionFR: traductionFR,
          traductionEN: traductionEN,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        var nouveauChemin = 'mot?mot=ch&p=1';
        window.location.replace(nouveauChemin);
    });
});


// POST AJAX MODIFIER POUR MOT CH

$("#modifier-mot-ch").click(function()
{
    var id = $("#id-modifier-mot-ch").val();  
    var mot = $("#mot-modifier-mot-ch").val();
    var traductionFR = $("#traductionFR-modifier-mot-ch").val();
    var traductionEN = $("#traductionEN-modifier-mot-ch").val();
    var exemple = $("#exemple-modifier-mot-ch").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traductionFR == '' || traductionEN == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traductionFR.match(regex) || traductionEN.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotCH",
      data: {
          id: id,        
          mot: mot,
          traductionFR: traductionFR,
          traductionEN: traductionEN,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT CH : FAVORIS

$("#modifier-mot-ch-favoris").click(function()
{
    var id = $("#id-modifier-mot-ch").val();  
    var mot = $("#mot-modifier-mot-ch").val();
    var traductionFR = $("#traductionFR-modifier-mot-ch").val();
    var traductionEN = $("#traductionEN-modifier-mot-ch").val();
    var exemple = $("#exemple-modifier-mot-ch").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traductionFR == '' || traductionEN == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traductionFR.match(regex) || traductionEN.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotCH",
      data: {
          id: id,        
          mot: mot,
          traductionFR: traductionFR,
          traductionEN: traductionEN,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX AJOUTER POUR MOT INF

$("#ajouter-mot-inf").click(function()
{
    var language = $("#language").val();
    var sujet = $("#sujet").val();
    var contenu = $("#contenu").val();
    var note = $("#note").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      $('.erreur').html('Veuillez remplir les champs.');
      $('.erreur').css('display', 'block');

      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) ||  note.match(regex))
    {
      $('.erreur').html('Veuillez ne pas écrire de chiffre.');
      $('.erreur').css('display', 'block');

      return false;
    }    

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?ajouter=Y&lang=INF",
      data: {
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        var nouveauChemin = 'mot?mot=inf&p=1';
        window.location.replace(nouveauChemin);
    });
});


// POST AJAX MODIFIER POUR MOT INF

$("#modifier-mot-inf").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT INF : FAVORIS

$("#modifier-mot-inf-favoris").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT INF : SYMFONY

$("#modifier-mot-inf-symfony").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT INF : PHP

$("#modifier-mot-inf-php").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR MOT INF : GIT

$("#modifier-mot-inf-git").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR COMPLETER MOT FR

$("#modifier-mot-completer-fr").click(function()
{
    var id = $("#id-modifier-mot-fr").val();  
    var mot = $("#mot-modifier-mot-fr").val();
    var definition = $("#definition-modifier-mot-fr").val();
    var exemple = $("#exemple-modifier-mot-fr").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || definition == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || definition.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=completer-MotFR",
      data: {
          id: id,        
          mot: mot,
          definition: definition,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR COMPLETER MOT EN

$("#modifier-mot-completer-en").click(function()
{
    var id = $("#id-modifier-mot-en").val();  
    var mot = $("#mot-modifier-mot-en").val();
    var traduction = $("#traduction-modifier-mot-en").val();
    var exemple = $("#exemple-modifier-mot-en").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traduction == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traduction.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=completer-MotEN",
      data: {
          id: id,        
          mot: mot,
          traduction: traduction,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR COMPLETER MOT CH

$("#modifier-mot-completer-ch").click(function()
{
    var id = $("#id-modifier-mot-ch").val();  
    var mot = $("#mot-modifier-mot-ch").val();
    var traductionFR = $("#traductionFR-modifier-mot-ch").val();
    var traductionEN = $("#traductionEN-modifier-mot-ch").val();
    var exemple = $("#exemple-modifier-mot-ch").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (mot == '' || traductionFR == '' || traductionEN == '' || exemple == '')
    {
      return false;
    }

    else if (mot.match(regex) || traductionFR.match(regex) || traductionEN.match(regex) || exemple.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=completer-MotCH",
      data: {
          id: id,        
          mot: mot,
          traductionFR: traductionFR,
          traductionEN: traductionEN,
          exemple: exemple
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// POST AJAX MODIFIER POUR COMPLETER MOT INF

$("#modifier-mot-completer-inf").click(function()
{
    var id = $("#id-modifier-mot-inf").val();  
    var language = $("#language-modifier-mot-inf").val();
    var sujet = $("#sujet-modifier-mot-inf").val();
    var contenu = $("#contenu-modifier-mot-inf").val();
    var note = $("#note-modifier-mot-inf").val();

    // REGEX FOR INT

    var regex = /^-?[0-9]+$/;

    if (language == '' || sujet == '' || contenu == '' || note == '')
    {
      return false;
    }

    else if (language.match(regex) || sujet.match(regex) || contenu.match(regex) || note.match(regex))
    {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "../../script/prendre.php?modifier=Y&contenu=completer-MotINF",
      data: {
          id: id,        
          language: language,
          sujet: sujet,
          contenu: contenu,
          note: note
      },
      cache: false
    }).done(function()
    {
        history.back();
    });
});


// GET AJAX COMPLETER TODOLIST

function completerTodolist(id)
{
  let text = "Compléter?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "script/prendre.php?id=" + id + "&completer=Y&todolist=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX SUPPRIMER LE COMPTE

function supprimerCompte(id)
{
  let text = "Voulez-vous vraiment supprimer votre compte?";

  if (confirm(text) === true)
  {
    $.ajax({
        type: "GET",
        url: "script/supprimer.php?id=" + id + "&supprimerCompte=Y"
    }).done(function()
    {
        alert('Votre compte a bien été supprimer.');
        var nouveauChemin = 'index';
        window.location.replace(nouveauChemin);
    });
  }
}


// GET AJAX COMPLETER MOT FR

function completerMotFR(id)
{
  let text = "Compléter?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&completer=Y&motFR=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX REVOIR MOT FR

function revoirMotFR(id)
{
  let text = "Revoir?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&revoir=Y&motFR=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX SUPPRIMER MOT FR

function supprimerMotFR(id)
{
  let text = "Supprimer?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&supprimer=Y&motFR=Y"
    }).done(function()
    {
    window.location.reload();
    });
  }
}


// GET AJAX TITLE FA MOT FR

function titleFaFR(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=Y&motFR=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX TITLE DESACTIVE FA MOT FR

function titleDesactiveFaFR(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=N&motFR=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX COMPLETER MOT EN

function completerMotEN(id)
{
  let text = "Compléter?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&completer=Y&motEN=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX REVOIR MOT EN

function revoirMotEN(id)
{
  let text = "Revoir?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&revoir=Y&motEN=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX SUPPRIMER MOT EN

function supprimerMotEN(id)
{
  let text = "Supprimer?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&supprimer=Y&motEN=Y"
    }).done(function()
    {
    window.location.reload();
    });
  }
}


// GET AJAX TITLE FA MOT EN

function titleFaEN(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=Y&motEN=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX TITLE DESACTIVE FA MOT EN

function titleDesactiveFaEN(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=N&motEN=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX COMPLETER MOT CH

function completerMotCH(id)
{
  let text = "Compléter?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&completer=Y&motCH=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX REVOIR MOT CH

function revoirMotCH(id)
{
  let text = "Revoir?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&revoir=Y&motCH=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX SUPPRIMER MOT CH

function supprimerMotCH(id)
{
  let text = "Supprimer?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&supprimer=Y&motCH=Y"
    }).done(function()
    {
    window.location.reload();
    });
  }
}


// GET AJAX TITLE FA MOT CH

function titleFaCH(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=Y&motCH=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX TITLE DESACTIVE FA MOT CH

function titleDesactiveFaCH(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=N&motCH=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX TITLE FA MOT INF

function titleFaINF(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=Y&motINF=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX TITLE DESACTIVE FA MOT INF

function titleDesactiveFaINF(id)
{
  $.ajax({
    type: "GET",
    url: "../../script/prendre.php?id=" + id + "&favoris=N&motINF=Y"
  }).done(function()
  {
    window.location.reload();
  });
}


// GET AJAX COMPLETER MOT INF

function completerMotINF(id)
{
  let text = "Compléter?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&completer=Y&motINF=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX REVOIR MOT INF

function revoirMotINF(id)
{
  let text = "Revoir?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&revoir=Y&motINF=Y"
    }).done(function()
    {
      window.location.reload();
    });
  }
}


// GET AJAX SUPPRIMER MOT INF

function supprimerMotINF(id)
{
  let text = "Supprimer?";

  if (confirm(text) === true)
  {
    $.ajax({
      type: "GET",
      url: "../../script/prendre.php?id=" + id + "&supprimer=Y&motINF=Y"
    }).done(function()
    {
    window.location.reload();
    });
  }
}
