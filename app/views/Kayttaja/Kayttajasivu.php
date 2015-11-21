{% extends "base.html" %}
{% block content %}

<H2>Kayttajan {Kayttaja.kayttajatunnus}} esittelysivu</H2>

    <form action="handle_form.php">
      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Kayttajatunnus</th>
            <th>Etunimi</th>
            <th>Sukunimi</th>
            <th>Käyttöoikeudet</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
           <tr>
             <td>{{kayttaja.kayttajatunnus}}</td> <!--Jostain syystä tämä ei tulostu, eikä siis myös välity Muokkaa-sivulle -->
             <td>{{kayttaja.etunimi}}</td>  
             <td>{{kayttaja.sukunimi}}</td>
             <td>{{kayttaja.käyttooikeudet}}</td>
              <th><a class="btn btn-default btn-sm" href="{{base_path}}/Kayttaja/Kayttajatietojenmuutos/{{kayttaja.kayttajatunnus}}">Muokkaa</a></th>
             <th><a class="btn btn-default btn-sm" href="{{base_path}}/Paasivu">Poista</a></th> 
          </tr>
         </tbody>    
      </table>
    </form>    

    <button class="btn btn-default"><A href="{{base_path}}/Paasivu"> Pääsivulle</A></button>

{% endblock %}

