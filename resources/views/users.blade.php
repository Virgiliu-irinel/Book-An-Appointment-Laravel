<h1>Book an appointment</h1>

@if($errors->any())
    @foreach($errors->all() as $err)
        <li>{{$err}}</li>
    @endforeach
@endif

<form action ="users" method="POST">
    
    @csrf
 <input type ="text" name="nume" id="nume" placeholder="Nume" /> <br><br>
 <input type="date" name="date" id="date"/> <br><br>
 <input type="time" name="time" id="time" onblur="checktimeval()"/> <span id="timespan"></span> <br><br>
 <button type="submit" id="submit">submit </button>
 
</form>

<div id="appointment"></div>
<button type="button" onclick="loadDoc()">Vezi programarile</button>

<script>
    function loadDoc() {
      var xhttp;    
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("appointment").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "appointment", true);
      xhttp.send();
    }
    </script>

<script type="text/javascript">
    function checktimeval(){
      var timeval=document.getElementById("time").value;
      if((!(timeval > "09:00" && timeval < "13:00")) && (!(timeval > "15:30" && timeval < "21:00"))){
        document.getElementById("timespan").innerHTML="Orele de program sunt 09:00 - 13:00 si 15:30 - 21:00";
        document.getElementById("submit").disabled = true;
      }
      else{
        document.getElementById("timespan").innerHTML="";
        document.getElementById("submit").disabled = false;
      }
    }
</script>
<script type="text/javascript">
    const picker = document.getElementById('date');
    picker.addEventListener('input', function(e){
        var day = new Date(this.value).getUTCDay();
        if([6,0].includes(day)){
        e.preventDefault();
        this.value = '';
        alert('In weekend nu se fac programari!');
  }
});
</script>
