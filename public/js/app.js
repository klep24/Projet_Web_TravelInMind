$(window).on('load', function(){
  // Instantiate the Bloodhound suggestion engine
  var gares = new Bloodhound({
    datumTokenizer: function(datum) {
      return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: 'api.php?type=station&',
      prepare: function(query, settings){
        settings.url += 'q=' + query;
        return settings;
      },
      filter: function(gares) {
        return $.map(gares, function(gare) {
          return {
            value: gare.name,
            id: gare.id
          };
        });
      },
    },
    limit: 3
  });

  $("input#gare_dep").val("");
  $("input#gare_arr").val("");
  $( function() {
      $( "#jour_dep" ).datepicker({
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy'
      }).datepicker("setDate", '+0');
    });

  $(function(){
    $('input[type="time"][value="now"]').each(function(){
      var d = new Date();
      h = d.getHours();
      m = d.getMinutes();
      if(h < 10) h = '0' + h;
      if(m < 10) m = '0' + m;
      $(this).attr({
        'value': h + ':' + m
      });
    });
  });

jQuery(document).ready(function(){
    $( "#myform" ).validate({
    rules: {
      nom: {
        required: true
      },
      prenom: {
        required: true
      },
      mail: {
        required: true,
        email: true
      },
      mdp: {
        required: true,
        minlength: 8
      },
      confirmermdp: {
        required: true,
        equalTo: "#password"
      },
      telephone: {
        number: true,
        minlength: 10,
        maxlength: 10
      },
    },
     messages: {
      nom: "Champ obligatoire",
      prenom: "Champ obligatoire",
      mail: {
        required: "Champ obligatoire",
        email: "Mail invalide"
      },
      mdp: {
        required: "Champ obligatoire",
        minlength: "Minimum 8 caractères"
      },
      confirmermdp: {
         required: "Champ obligatoire",
         equalTo: "Mot de passe différent"
     },
     telephone: {
       number: "N° invalide",
       minlength: "Minimum 10 caractères",
       maxlength: "Maximum 10 caractères"
     }
   }
  });
  $( ".form-horizontal" ).validate({
    rules: {
      mdpoublie: {
        required: true,
        email: true
      }
    },
    messages : {
      mdpoublie: {
        required: "Champ obligatoire",
        email: "Mail invalide"
      },
    }
  });
});


  // Initialize the Bloodhound suggestion engine
  gares.initialize();

  // Instantiate the Typeahead UI
  $('#scrollable-menu-dep .typeahead').typeahead(null, {
    displayKey: 'value',
    source: gares.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile("<p style='padding:6px'><b>{{value}}</b></p>"),
      header: Handlebars.compile("<b>Résultats pour '{{query}}'</b>")
    }
  });

  $('#scrollable-menu-arr .typeahead').typeahead(null, {
    displayKey: 'value',
    source: gares.ttAdapter(),
    templates: {
      suggestion: Handlebars.compile("<p style='padding:6px'><b>{{value}}</b></p>"),
      header: Handlebars.compile("<b>Résultats pour '{{query}}'</b>")
    }
  });

  var gare_dep = null, gare_arr = null, heure_dep = null, jour_dep = null, time_start=null;

  function updateValidBtnState() {
    if (gare_dep && gare_arr /* && heure_dep && jour_dep */)
      $("#valid_train").removeClass("disabled");
    else
      $("#valid_train").addClass("disabled");
  }

  $('#scrollable-menu-dep .typeahead').on('typeahead:selected', function(e, select) {
    if (e.data)
      console.log(e);
    else{
      gare_dep = select;
      updateValidBtnState();
    }
  });

  $('#scrollable-menu-arr .typeahead').on('typeahead:selected', function(e, select) {
    if (e.data)
      console.log(e);
    else{
      gare_arr = select;
      updateValidBtnState();
    }
  });


  $('#scrollable-menu-dep .typeahead').on('typeahead:change', function(e, select) {
    if (select != gare_dep.value){
      gare_dep = null;
      updateValidBtnState();
    }
  });

  $('#scrollable-menu-arr .typeahead').on('typeahead:change', function(e, select) {
    if (select != gare_arr.value){
      gare_arr = null;
      updateValidBtnState();
    }
  });

  $("#valid_train").on("click", function() {
    if (gare_dep && gare_arr) {
      var date = $( "#jour_dep" ).datepicker("getDate");
      year = String(date.getFullYear());
      month = String(date.getMonth() + 1);
      day = String(date.getDate());
      var time = $("#heure_dep").val();
      hours = time.substring(0,2);
      minute = time.substring (3,6);
      seconde = "00";
      if (month < 10) {
        month = "0"+month;
      }
      if (day < 10) {
        day = "0"+day;
      }
     time_start = year+month+day+"T"+hours+minute+seconde;
    }

      document.location.href=("recherche.php?station_start="+gare_dep.id+"&station_stop="+gare_arr.id+"&time_start="+ time_start+"&nom_dep="+gare_dep.value+"&nom_arr="+gare_arr.value);
  });

  $("#reset_train").on("click", function() {
    $("input#gare_dep").val("");
    $("input#gare_arr").val("");
    $( "input#jour_dep" ).datepicker("setDate", "+0");
    var d = new Date();
    h = d.getHours();
    m = d.getMinutes();
    if(h < 10) h = '0' + h;
    if(m < 10) m = '0' + m;
    $("input#heure_dep").val(h + ':' + m);
    gare_dep = null;
    gare_arr = null;
    updateValidBtnState();
    //  document.location.href=("index.php");
  });

});
