$(window).on('load', function(){
  // Instantiate the Bloodhound suggestion engine
  var gares = new Bloodhound({
    datumTokenizer: function(datum) {
      return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: 'https://api.sncf.com/v1/coverage/sncf/pt_objects?type%5B%5D=stop_area&',
      prepare: function(query, settings){
        settings.url += 'q=' + query;
        settings.headers = {
          'Authorization': 'f6ca878c-116d-461d-a5cf-33d41adf5854'
        };
        return settings;
      },
      filter: function(gares) {
        return $.map(gares.pt_objects, function(gare) {
          return {
            value: gare.stop_area.name,
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

      document.location.href=("recherche.php?station_start="+gare_dep.id+"&station_stop="+gare_arr.id+"&datetime="+ time_start+"&nom_dep="+gare_dep.value+"&nom_arr="+gare_arr.value);
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


class SectionLocal {
  constructor( rawSection ) {
    var date_start      = strDateTimetoJSObj(rawSection.departure_date_time);
    var date_stop       = strDateTimetoJSObj(rawSection.arrival_date_time);
    var duration        = date_stop - date_start;
    this.num_train      = rawSection.display_informations.headsign;
    this.type_train     = rawSection.display_informations.commercial_mode;
    this.time_start     = strftimeFR("%H:%M", date_start );
    this.time_stop      = strftimeFR("%H:%M", date_stop );
    this.duration       = millisToStr( duration );
    this.station_start  = rawSection.from.stop_point.name;
    this.station_stop   = rawSection.to.stop_point.name;
    var direction       = rawSection.display_informations.direction.replace(/( \(.*)/, "");
    if( this.station_stop == direction )
      this.station_direction    = "Terminus";
    else
      this.station_direction    = "Dir. "+direction;
  }
}

class JourneyLocal {
  constructor( rawJourney ) {
    var date_start      = strDateTimetoJSObj(rawJourney.departure_date_time);
    var date_stop       = strDateTimetoJSObj(rawJourney.arrival_date_time);
    var duration        = date_stop - date_start;
    var nb_sections     = rawJourney.sections.length;
    this.date_start     = strftimeFR("%a %e %B", date_start );
    this.time_start     = strftimeFR("%H:%M", date_start );
    this.time_stop      = strftimeFR("%H:%M", date_stop );
    this.duration       = millisToStr( duration );
    if( rawJourney.sections[0] ){
      if( rawJourney.sections[0].from.stop_area )
        this.station_start  = rawJourney.sections[0].from.stop_area.name;
      else if ( rawJourney.sections[0].from.stop_point )
        this.station_start  = rawJourney.sections[0].from.stop_point.name;
    }
    else
      this.station_start  = "";

    if( rawJourney.sections[nb_sections-1] ){
      if( rawJourney.sections[nb_sections-1].to.stop_area )
        this.station_stop  = rawJourney.sections[nb_sections-1].to.stop_area.name;
      else if ( rawJourney.sections[nb_sections-1].to.stop_point )
        this.station_stop  = rawJourney.sections[nb_sections-1].to.stop_point.name;
    }else
      this.station_stop = "";

    this.sections = [];
    rawJourney.sections.forEach( function(rawSection){
      if( rawSection.display_informations ){
        this.sections.push( new SectionLocal( rawSection ) );
      }
    }, this);
  }
}

function journeysToContext( journeys ) {
  var contextToReturn = {};
  contextToReturn.journeys = [];
  for (var index in journeys) {
    if (journeys.hasOwnProperty(index)) {
      var contextJourney = {};
      contextJourney.journey_date_start    = journeys[index].date_start;
      contextJourney.journey_time_start    = journeys[index].time_start;
      contextJourney.journey_time_stop     = journeys[index].time_stop;
      contextJourney.journey_duration      = journeys[index].duration;
      contextJourney.journey_station_start = journeys[index].station_start;
      contextJourney.journey_station_stop  = journeys[index].station_stop;
      contextJourney.sections              = [];
      var i=0;
      for (var index2 in journeys[index].sections) {
        if (journeys[index].sections.hasOwnProperty(index2)) {
          var contextSection = {};
          contextSection.section_num = ++i;
          contextSection.section_num_train         = journeys[index].sections[index2].num_train;
          contextSection.section_type_train        = journeys[index].sections[index2].type_train;
          contextSection.section_time_start        = journeys[index].sections[index2].time_start;
          contextSection.section_time_stop         = journeys[index].sections[index2].time_stop;
          contextSection.section_duration          = journeys[index].sections[index2].duration;
          contextSection.section_station_start     = journeys[index].sections[index2].station_start;
          contextSection.section_station_stop      = journeys[index].sections[index2].station_stop;
          contextSection.section_station_direction = journeys[index].sections[index2].station_direction;

          contextJourney.sections.push( contextSection );
        }
      }
      contextToReturn.journeys.push(contextJourney);
    }
  }
  return contextToReturn;
}
/*
  var source = $("#result_train_template").html();
  var template = Handlebars.compile(source);
  var context = {title: "Testo"}
  var html_compiled = template(context);
  $("#result_train table").append( html_compiled );
*/
});
