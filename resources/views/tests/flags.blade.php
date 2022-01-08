@extends('layouts.app')
    @section('content')
    <div class="flagsContent" style="text-align:center;margin-top:20px;">
      <button id="previousCountry" style="display:none"><</button>
    <img
  src=""
  srcset=""
  width="320"
  alt=""
  id="countryPic"
  style="display:none">
  <button id="nextCountry" style="display:none">></button>
<br>
<p id="regionLabel">Select the region:</p>
<select id="regionOptions">
  <option>World</option>
  <option>South America</option>
  <option>North America</option>
  <option>Europe</option>
  <option>Africa</option>
  <option>Asia and Pacific</option>
  <option>Midddle east</option>
  <option>Arab states</option>
</select>
<br>
<p id="timer" style="display:none">
<span id="minutes"></span>
:
<span id="seconds"></span>
</p>
<hr>
<p id="timeLimitLabel">Select the time limit:</p>
<select id="timeLimitOptions">
  <option value='0'>No time limit</option>
  <option value='1'>1min</option>
  <option value='2'>2min</option>
  <option value='5'>5min</option>
  <option value='10'>10min</option>
  <option value='20'>20min</option>
</select>
<br>
<button id="startQuiz">Start quiz</button>
<form action='/flags/update' type='submit' method='POST' id="countryForm">
  @csrf
  <input type='text' name='countryName' id="countryInput" style="display:none">
  <input type='hidden' name='nonGuessedCountries' id="nonGuessedCountries" value ="">
</form>
<br>
<p id="counter" style="display:none"><span id="guessed">0</span>/<span id="allCountries">0</span></p>
</div>
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css"/>
<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  var data = @json($data);
  var countryIndex = 0;
  var quizInProgress = false;
  var flagsGuessed = 0;
  var countries = data['countries'];
  shuffle(countries);
  var countryInput = document.getElementById("countryInput");
  var startButton = document.getElementById("startQuiz");
  // to prevent submit on enter
  $('#countryForm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
  });
  countryInput.addEventListener("keyup", (event) => {
    var countryIso = document.getElementById("countryPic").getAttribute("alt");
    if(countryIso == countries[countryIndex].code.toLowerCase() && document.getElementById("countryInput").value == countries[countryIndex].name){
      flagsGuessed++;
      document.getElementById("guessed").innerText = flagsGuessed;
      if(countryIndex < countries.length - 1){
        var nextCountryIso = countries[countryIndex+1].code.toLowerCase();
        var srcVal = "https://flagcdn.com/w320/"+nextCountryIso+".png";
        var srcSetVal = "https://flagcdn.com/w640/"+nextCountryIso+".png 2x";
        document.getElementById("countryPic").setAttribute("alt", nextCountryIso);
        document.getElementById("countryPic").setAttribute("src", srcVal);
        document.getElementById("countryPic").setAttribute("srcset", srcSetVal);
        document.getElementById("countryInput").value = "";
        countries.splice(countryIndex,1);
      }
      else if(countries.length == 1){
        document.getElementById("nonGuessedCountries").value = 0;
        $('#countryForm').trigger('submit');
      }
      
    }
      
  });
  startButton.addEventListener("click", (event) => {
    var regionOptions = document.getElementById("regionOptions");
    sortCountriesByRegion(countries, regionOptions.value);
    var countryIso = countries[countryIndex].code.toLowerCase();
    var srcVal = "https://flagcdn.com/w320/"+countryIso+".png";
    var srcSetVal = "https://flagcdn.com/w640/"+countryIso+".png 2x";
    document.getElementById("allCountries").innerText = countries.length;
    document.getElementById("countryPic").setAttribute("alt", countryIso);
    document.getElementById("countryPic").setAttribute("src", srcVal);
    document.getElementById("countryPic").setAttribute("srcset", srcSetVal);
    document.getElementById("countryInput").value = "";
    quizInProgress = true;
    var timeLimitOption = document.getElementById("timeLimitOptions");
    var totalSeconds = (timeLimitOption.value != 0 && timeLimitOption.value != '0') ? parseInt(timeLimitOption.value)*60 : 0;

    document.getElementById("counter").setAttribute("style", "");
    document.getElementById("countryInput").setAttribute("style", "");
    document.getElementById("countryPic").setAttribute("style", "");
    document.getElementById("previousCountry").setAttribute("style", "");
    document.getElementById("nextCountry").setAttribute("style", "");

    document.getElementById("timeLimitOptions").setAttribute("style", "display:none");
    document.getElementById("timeLimitLabel").setAttribute("style", "display:none");
    document.getElementById("startQuiz").setAttribute("style", "display:none");
    document.getElementById("regionOptions").setAttribute("style", "display:none");
    document.getElementById("regionLabel").setAttribute("style", "display:none");
    if(totalSeconds != 0){
    // only show timer if minutes are selected
    document.getElementById("timer").setAttribute("style", "");
    var x = setInterval(() => {
    //clears countdown when all seconds are counted
    if (totalSeconds <= 0 || countries.length == 0) {
        clearInterval(x);
        var countryIsos = [];
        for(var i = 0; i<countries.length; i++){
          countryIsos.push(countries[i].code);
        }
        var countryIsosJson = JSON.stringify(countryIsos);
        document.getElementById("nonGuessedCountries").value = countryIsosJson;
        $('#countryForm').trigger('submit');
    }
    var minutes = Math.floor(totalSeconds / 60) ;
    var seconds = totalSeconds % 60;
    if(seconds < 10)seconds = "0"+seconds;
    if(minutes < 10)minutes = "0"+minutes;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("seconds").innerText = seconds;
    totalSeconds--;
    }, 1000);
    }
   });

  var nextCountryButton =  document.getElementById("nextCountry");
  nextCountryButton.addEventListener("click", (event) => {
    if(countries.length >= countryIndex+2){
    var nextCountryIso = countries[++countryIndex].code.toLowerCase();
    var srcVal = "https://flagcdn.com/w320/"+nextCountryIso+".png";
    var srcSetVal = "https://flagcdn.com/w640/"+nextCountryIso+".png 2x";
    document.getElementById("countryPic").setAttribute("alt", nextCountryIso);
    document.getElementById("countryPic").setAttribute("src", srcVal);
    document.getElementById("countryPic").setAttribute("srcset", srcSetVal);
    }
  });
  var previousCountryButton =  document.getElementById("previousCountry");
  previousCountryButton.addEventListener("click", (event) => {
    if(countryIndex > 0){
    var nextCountryIso = countries[--countryIndex].code.toLowerCase();
    var srcVal = "https://flagcdn.com/w320/"+nextCountryIso+".png";
    var srcSetVal = "https://flagcdn.com/w640/"+nextCountryIso+".png 2x";
    document.getElementById("countryPic").setAttribute("alt", nextCountryIso);
    document.getElementById("countryPic").setAttribute("src", srcVal);
    document.getElementById("countryPic").setAttribute("srcset", srcSetVal);
    }
  });
  console.log(countries);

  function sortCountriesByRegion(countries, region){
    var countriesRemoved = 0;
    for(var i=countries.length-1; i >= 0; i--){
        if(region != 'World' && region != countries[i].region){
            countries.splice(i, 1);
        }
    }
  }

  function shuffle(array) {
  let currentIndex = array.length,  randomIndex;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return array;
}
</script>
    @endsection
    