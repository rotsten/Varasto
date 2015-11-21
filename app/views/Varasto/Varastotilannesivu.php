
{% extends "base.html" %}
{% block content %}

<H2>Varastotilanteen esittelysivu</H2>

    <form action="handle_form.php">
      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Tuote_id</th>
            <th>Tuotteen nimi</th>
            <th>Lukumäärä</th>
            <th>Inventoinut</th>   
            <th>Koska</th> 
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
           <tr>
             <td>{{Varastotilanne.tuote_id}}</td> <!--Jostain syystä tämä ei tulostu, eikä siis myös välity Muokkaa-sivulle -->
             <td></td>
             <td>{{Varastotilanne.lukumaara}}</td>
             <td></td>
             <td></td>
             <th><a class="btn btn-default btn-sm" href="{{base_path}}/Tuote/Tuotesivu/{{Tuote.tuote_id}}">Katso tarkemmat tuotetiedot</a></th>
             <th><a class="btn btn-default btn-sm" href="{{base_path}}/Varasto/Varastotilanteenmuutos/{{Varasto.tuote_id}}">Muokkaa</a></th>> 
          </tr>
         </tbody>    
      </table>
    </form>    

    <button class="btn btn-default"><A href="{{base_path}}/Paasivu"> Pääsivulle</A></button>

{% endblock %}
